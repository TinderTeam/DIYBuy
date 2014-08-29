<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class IndexAction extends Action {
    public function index(){
        $db = M('product');
        import("ORG.Util.Page"); 
        $count = $db->count();
        //$count = $user->where($condition)->count();
        $Page = new Page($count,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); 
                                                               
        $list = $db->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('productinfo',$list); // 赋值数据集
        $this->assign('page',$show); // 赋值分页输出
	    $this->show();
    }
}
?>