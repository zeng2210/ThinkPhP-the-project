<?php
/**
 * Created by PhpStorm.
 * User: chendongdong
 * Date: 2018/8/1
 * Time: 下午3:44
 */
namespace Dwin\Model;


use think\Exception;
use Think\Model;

class StockOutOtherApplyModel extends Model{

    static protected $successStatus = 200;
    static protected $failStatus = 400;

    const TYPE_NOT_AUDIT = 0;       // 未审核
    const TYPE_UNQUALIFIED = 1;     // 审核不通过
    const TYPE_QUALIFIED = 2;       // 审核通过

    const IS_DEL = 1; // 已被删除
    const NO_DEL = 0; // 有效

    const TYPE_UNTREATED = 0;  // 未处理
    const TYPE_OUT_OF_REP = 1; // 出库中
    const TYPE_OUT_ALL = 2;    // 出库完成

    public static $stockOutMap = [
        self::TYPE_UNTREATED => "未处理",
        self::TYPE_OUT_OF_REP => "出库中",
        self::TYPE_OUT_ALL => "出库完成",
    ];

    /* 出库类别 */
    const CUSTOMER_SERVICE = 201; // 非标售后线
    const COMPANY_MANAGEMENT = 202; // 公司管理出库
    const REPLACE_MATERIAL = 203; // 替代料领料
    const RESEARCH_DEVELOPMENT = 204; // 研发领料
    const MODIFICATION_MATERIAL = 205; // 改件领料
    const PRODUCTION_MANAGEMENT = 206; // 生产管理出库
    const AFTER_SALE_MAINTENANCE = 207; // 售后维修领料
    const PRODUCTION_MAINTENANCE = 208; // 生产维修领料

    /* 领料类型 */
    const SAMPLE_PURCHASE = 201; // 样机线请购
    const PROTOTYPE = 202; // 样机
    const SUBSTITUTE_MATERIAL = 203; // 替代料
    const DEVELOPMENT_MATERIAL = 204; // 研发请购
    const PRODUCTION_MODIFICATION = 205; // 生产改件
    const PARTS_MATERIAL = 206; // 配件
    const SUPER_COLLAR = 207; // 超领
    const AFTER_SALE_PICKING = 208; // 售后领料
    const MAINTENANCE_MATERIAL = 209; // 维修

    // 领料类型map
    public static $pickingType = [
        self::SAMPLE_PURCHASE => '样机线请购',
        self::PROTOTYPE => '样机',
        self::SUBSTITUTE_MATERIAL => '替代料',
        self::DEVELOPMENT_MATERIAL => '研发请购',
        self::PRODUCTION_MODIFICATION => '生产改件',
        self::PARTS_MATERIAL => '配件',
        self::SUPER_COLLAR => '超领',
        self::AFTER_SALE_PICKING => '售后领料',
        self::MAINTENANCE_MATERIAL => '维修',
    ];

    // 出库类别map
    public static $outOfTreasuryType = [
        self::CUSTOMER_SERVICE => '非标售后线',
        self::COMPANY_MANAGEMENT => '公司管理出库',
        self::REPLACE_MATERIAL => '替代料领料',
        self::RESEARCH_DEVELOPMENT => '研发领料',
        self::MODIFICATION_MATERIAL => '改件领料',
        self::PRODUCTION_MANAGEMENT => '生产管理出库',
        self::AFTER_SALE_MAINTENANCE => '售后维修领料',
        self::PRODUCTION_MAINTENANCE => '生产维修领料',
    ];

    public static $auditTypeMap = [
        self::TYPE_NOT_AUDIT   => '未审核',
        self::TYPE_UNQUALIFIED => '不合格',
        self::TYPE_QUALIFIED   => '合格',
    ];

    /**
     * 去除非此表的字段数据
     * @param $params
     * @return array
     */
    public function getNewField($params){
        $fieldData = $this->getDbFields();
        $data = [];
        foreach ($fieldData as $key => $field){
            if(isset($params[$field])){
                $data[$field] = $params[$field];
            }
        }
        return $data;
    }

    /**
     * 比较前后数据是否发生改变
     * @param $oldData
     * @param $editedData
     * @return bool
     */
    private function compareData($oldData, $editedData)
    {
        // 然后在与原先的数据做对比
        foreach ($editedData as $key => $val) {
            if ($val == $oldData[$key]) {
                unset($editedData[$key]);
            } else {
                continue;
            }
        }

        if(empty($editedData)){
            return false;
        }

        $editedData['id'] = $oldData['id'];
        $editedData['update_time']  = time();
        $editedData['update_id']    = session('staffId');
        return $editedData;
    }

    public function getAddData($params){
        $data = $this->getNewField($params);
        if (empty($data)) {
            return [-1, [], '没有提交新增数据'];
        }

        // 判空处理
        if(empty($data['id']) || empty($data['apply_id']) || empty($data['picking_kind']) || empty($data['apply_dept_id']) || empty($data['apply_dept_name']) || empty($data['apply_time'])){
            return [-2, [], '请将数据填写完整'];
        }

        if($data['apply_time'] == 'NaN'){
            return [-2, [], "制单时间填写不规范或则未填写"];
        }

//        if(!empty($data['total_amount'])){
//            list($code, $msg, $amount) = get_amount($data['total_amount']);
//            if($code != self::$successStatus){
//                $this->error = $msg;
//                return false;
//            }else {
//                $data['capital_amount'] = $amount;
//            }
//        }else {
//            $data['total_amount'] = 0;
//            $data['total_amount'] = "零元";
//        }

        $data['create_time']  = time();
        $data['create_id']    = session('staffId');
        $data['update_time']  = time();
        $data = $this->create($data);
        if ($data) {
            return [0, $data, '数据实例化成功'];
        } else {
            return [-2, [], $this->getError()];
        }
    }

    /**
     * 添加其他出库申请书基本信息
     * @param $data
     * @return array
     */
    public function addApply($data)
    {
        list($code, $addData, $msg) = $this->getAddData($data);
        if ($code != 0) {
            return [$msg, self::$failStatus];
        } else {
            $rst = $this->add($addData);
            if ($rst === false) {
                return [$this->getError(), self::$failStatus];
            } else {
                session('applyId', $data['id']);
                return ["新增成功", self::$successStatus];
            }
        }
    }

    /**
     * 生成申请单
     * @param $applyBaseMsg
     * @param $materialMsg
     * @return array
     */
    public function createApply($applyBaseMsg, $materialMsg){
        $this->startTrans();
        list($msg, $status) = self::addApply($applyBaseMsg);
        if ($status == self::$failStatus) {
            $this->rollback();
            return dataReturn($msg, self::$failStatus);
        }

        // 检查是否有重复选择物料
        $materialArr = array_unique(array_column($materialMsg, "product_no"));
        if(count($materialArr) != count($materialMsg)){
            $this->rollback();
            return dataReturn("物料有重复的，请检查合并后提交",self::$failStatus);
        }

        $applyMaterialModel = new StockOutOtherApplyMaterialModel();
        list($msg, $status) = $applyMaterialModel->addApplyMaterial($materialMsg);
        if ($status == self::$failStatus) {
            $this->rollback();
            return dataReturn($msg, $status);
        }

        $this->commit();
        return dataReturn('添加申请单成功', self::$successStatus);
    }

    /**
     * 处理申请单提交的修改数据
     * @param $params
     * @return array
     */
    public function getEditData($params)
    {
        $data =self::getNewField($params);
        if (empty($data)) {
            return [-1, [], '无修改数据提交'];
        }

        if(isset($data['apply_time']) && ($data['apply_time'] == 'NaN' || empty($data['apply_time']))){
            return [-2, [], "制单时间填写不规范或则未填写"];
        }


//        if(isset($data['total_amount'])){
//            if(empty($data['total_amount'])){
//                return [-2, [], "订单总金额可能为零，请添加物料"];
//            }
//            list($code, $msg, $amount) = get_amount($data['total_amount']);
//            if($code != self::$successStatus){
//                $this->error = $msg;
//                return false;
//            }
//            $data['capital_amount'] = $amount;
//        }

        $oldData = $this->field("*")->find($data['id']);

        if($oldData['audit_status'] == self::TYPE_QUALIFIED){
            return [-2, [], '当前申请单已审核通过，不可修改'];
        }

        $editData = $this->compareData($oldData, $data);
        if (!$editData) {
            return [-1, [], '无数据修改'];
        } else {
            $data = $this->create($editData);
            if(!$data){
                return [-2, [], $this->getError()];
            }
            return [0, $data, '无修改数据提交'];
        }
    }

    /**
     * 修改申请单基本信息
     * @param $data
     * @return array
     */
    public function editApply($data)
    {
        try {
            list($code, $editData, $msg) = $this->getEditData($data);

            if ($code != 0) {
                return [$msg, -1];
            }

            $editRst = $this->save($editData);
            if ($editRst === false) {
                return [$this->getError(), -2];
            }

            return ['修改订单基本信息成功', 0];
        } catch (\Exception $exception) {
            return dataReturn($exception->getMessage(), self::$failStatus);
        }
    }

    /**
     * 修改申请单全部信息
     * @param $postData
     * @return array
     */
    public function editApplyTrans($postData)
    {
        try {
            $this->startTrans();
//            $money = 0;

            $editCode = 0;
            $applyMaterialModel = new StockOutOtherApplyMaterialModel();
            if(!empty($postData['edit_material'])){
//                $money += array_sum(array_column($postData['edit_material'], "total_price"));

                list($editMsg, $editCode) = $applyMaterialModel->editApplyMaterial($postData['edit_material']);
                if ($editCode == -2) {
                    $this->rollback();
                    return dataReturn($editMsg, self::$failStatus);
                }
            }

            if (!empty($postData['new_material'])){
//                $money += array_sum(array_column($postData['new_material'], "total_price"));

                // 修改后条数
                $idArr = array_unique(array_column($postData['new_material'], "product_no"));
                if(count($idArr) != count($postData['new_material'])){
                    $this->rollback();
                    return dataReturn("修改后当前申请单有重复物料,请再次修改", 400);
                }

                // 检查当前新增物料是否已存在数据库中
                $res = $applyMaterialModel->where(['product_id' => ['in', $idArr], 'apply_id' => $postData['apply']['id'], 'is_del' => StockOutOtherApplyMaterialModel::NO_DEL])->select();
                if(!empty($res)){
                    $this->rollback();
                    return dataReturn("修改后当前申请单有重复物料,请再次修改", 400);
                }

                session('applyId', $postData['apply']['id']);
                list($msg, $status) = $applyMaterialModel->addApplyMaterial($postData['new_material']);
                if ($status == self::$failStatus) {
                    $this->rollback();
                    return dataReturn($msg, self::$failStatus);
                }
            }

//            $postData['apply']['total_amount'] = $money;
            list($msg, $code) = $this->editApply($postData['apply']);
            if ($code == -2) {
                $this->rollback();
                return dataReturn($msg, self::$failStatus);
            }
            if($code == -1 && ($editCode == -1 || empty($postData['edit_material'])) && empty($postData['new_material'])){
                return dataReturn('数据未发生修改', 400);
            }

            $this->where(['id' => $postData['apply']['id']])->setField(["audit_status" => self::TYPE_NOT_AUDIT]);
            $this->commit();
            return dataReturn('ok', self::$successStatus);
        } catch (\Exception $exception) {
            return dataReturn($exception->getMessage(), self::$failStatus);
        }
    }

    /**
     * 删除申请单中一个物料
     * @param $applyId
     * @param $materialId
     * @return array
     */
    public function delapplyMaterial($applyId, $materialId){
        $applyData = $this->find($applyId);
//        if($applyData['audit_status'] == self::TYPE_QUALIFIED){
//            return dataReturn("当前申请单已审核，不能删除其物料信息", 400);
//        }

        $stockOutOtherModel = new StockOutOtherModel();
        $stockData = $stockOutOtherModel->where(['source_id' => $applyId, 'is_del' => StockOutOtherModel::NO_DEL])->find();
        if(!empty($stockData)){
            return dataReturn("当前申请单已下推出库单，不能进行删除操作", 400);
        }
        $this->startTrans();
        $applyMaterialModel = new StockOutOtherApplyMaterialModel();
        $res = $applyMaterialModel->where(['id' => $materialId])->setField(['is_del' => self::IS_DEL]);
        if($res === false){
            $this->rollback();
            return dataReturn($applyMaterialModel->getError(), 400);
        }
        $materialData = $applyMaterialModel->where(['id' => $materialId])->find();
        /*$totalAmount = $applyData['total_amount'] - $materialData['purchase_price'];
        if(!empty($totalAmount)){
            list($code, $msg, $amount) = get_amount($totalAmount);
            if($code != self::$successStatus){
                $this->rollback();
                return dataReturn($msg, 400);
            }else {
                $capitalAmount = $amount;
            }
        }else {
            $totalAmount = 0;
            $capitalAmount = "零元";
        }

        $this->where(['id' => $applyId])->setField(['total_amount' => $totalAmount, 'capital_amount' => $capitalAmount]);*/

        // 处理库存数据
        $stockModel = new StockModel();
        $num = 0 - $materialData['num'];
        list($code, $msg) = $stockModel->editStockNum($materialData['product_id'], $materialData['default_rep_id'], $num);
        if($code != 0){
            $this->rollback();
            return dataReturn($msg, 400);
        }

        $this->commit();
        return dataReturn("删除申请单中的物料成功", 200, [
//            'total_amount' => $totalAmount,
//            'capital_amount' => $capitalAmount
        ]);
    }

    /**
     * 删除一个申请单
     * @param $applyId
     * @return array
     */
    public function delApply($applyId){
//        $applyData = $this->find($applyId);
//        if($applyData['audit_status'] == self::TYPE_QUALIFIED){
//            return dataReturn("当前申请单已审核通过，不能进行删除操作", 400);
//        }

        $stockOutOtherModel = new StockOutOtherModel();
        $stockData = $stockOutOtherModel->where(['source_id' => $applyId, 'is_del' => StockOutOtherModel::NO_DEL])->find();
        if(!empty($stockData)){
            return dataReturn("当前申请单已下推出库单，不能进行删除操作", 400);
        }

        $this->startTrans();
        $applyRes = $this->where(['id' => $applyId])->setField(['is_del' => self::IS_DEL]);
        if($applyRes === false){
            $this->rollback();
            return dataReturn($this->getError(), 400);
        }

        $applyMaterialModel = new StockOutOtherApplyMaterialModel();
        $applyMaterialModel->where(['apply_id' => $applyId, 'is_del' => self::NO_DEL])->setField(['is_del' => self::IS_DEL]);

        // 修改库存
        // 处理库存数据
        $stockModel = new StockModel();

        $materialData = $applyMaterialModel->getMsgByApplyId($applyId);
        foreach ($materialData as $key => $value){
            $num = 0 - $materialData['num'];
            list($code, $msg) = $stockModel->editStockNum($value['product_id'], $value['default_rep_id'], $num);
            if($code != 0){
                $this->rollback();
                return dataReturn($msg, 400);
            }
        }

        $this->commit();
        return dataReturn("删除申请单成功", 200);
    }

    /**
     * 获取申请单列表页信息
     */
    public function getList($condition, $start, $length, $order, $map = []){
        $map['r.is_del'] = ['eq', self::NO_DEL];
        $recordMap = $map;
        if(strlen($condition) != 0){
            $where['r.apply_dept_name'] = ['like', "%" . $condition . "%"];
            $where['r.apply_id'] = ['like', "%" . $condition . "%"];
            $where['r.create_name']=['like', "%" . $condition . "%"];
            $where['_logic'] = 'OR';
            $recordMap['_complex'] = $where;
        }

        $data =  $this->alias("r")
            ->field("r.*, 
                    (case 
                        when ifnull(p.stock_out_id,0) = '0' then '未下推'
                        else '已下推'
                        end
                    ) as stock_out_type
                   ")
            ->join("left join crm_stock_out_other p on r.id = p.source_id and p.is_del = " . StockOutOtherModel::NO_DEL)
            ->limit($start, $length)
            ->where($recordMap)
            ->order($order)
            ->select();
        /** 后台传输局到前台
        @param $count 总记录数 $recordsFiltered search 后数据总数 $info 传递的数据*/
        $count = $this->alias("r")
            ->join("left join crm_stock_out_other p on r.id = p.source_id and p.is_del = " . StockOutOtherModel::NO_DEL)
            ->limit($start, $length)
            ->where($map)
            ->count();

        $recordsFiltered = $this->alias("r")
            ->join("left join crm_stock_out_other p on r.id = p.source_id and p.is_del = " . StockOutOtherModel::NO_DEL)
            ->limit($start, $length)
            ->where($recordMap)
            ->count();

        return [$data,$count,$recordsFiltered];
    }

    /**
     * 对申请单进行审核
     * @param $id
     * @param $auditStatus
     * @return array
     */
    public function auditApply($id, $auditStatus){
        $applyData = $this->find($id);

        if($applyData['audit_status'] != self::TYPE_NOT_AUDIT){
            return dataReturn("当前申请单已审核，无需重复审核", 400);
        }
        $this->startTrans();
        // 修改申请单的审核状态
        $auditRes = $this->where(['id' => $id])->setField(['audit_name' => session("nickname"), 'audit_time' => time(), "audit_status" => $auditStatus, "update_time" => time()]);

        if($auditRes === false){
            $this->rollback();
            return dataReturn("审核失败", 400);
        }

        $this->commit();
        return dataReturn("审核完成，当前状态为：" . self::$auditTypeMap[$auditStatus] , 200);
    }
}