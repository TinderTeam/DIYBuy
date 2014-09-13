<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class PurchaseAction extends Action {
    public function productDetails(){
	require './home/Lib/Action/Public.php';
        if($_SESSION['email']!=""){
			$db = M('user');
			$condition['email']=$_SESSION['email'];
			$name = $db->where($condition)->getField('name');
            $this->assign('v1',"$name"); 
            $this->assign('code1',"11"); 
            $this->assign('v2',"退出"); 
            $this->assign('code2',"12");
        }else{
            $this->assign('v1',"登录"); 
            $this->assign('code1',"21");
            $this->assign('v2',"注册"); 
            $this->assign('code2',"22");            
        }
		
		$db = M('product');
		$select=$db->where('id='.$_GET['id'])->select();
		$this->assign('purchaseInfo',$select); 
		$this->display();
    }
    
    public function orderPay(){
        if($_SESSION['email']!=""){
			$db = M('user');
			$condition['email']=$_SESSION['email'];
			$name = $db->where($condition)->getField('name');
            $this->assign('v1',"$name"); 
            $this->assign('code1',"11"); 
            $this->assign('v2',"退出"); 
            $this->assign('code2',"12");
			$db = M('product');
			$select=$db->where('id='.$_GET['id'])->select();
			$this->assign('orderInfo',$select); 
			$this->display('orderList');
        }else{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
        }


    }
	
    public function orderList(){
        if($_SESSION['email']!=""){
			$db = M('user');
			$condition['email']=$_SESSION['email'];
			$name = $db->where($condition)->getField('name');
            $this->assign('v1',"$name"); 
            $this->assign('code1',"11"); 
            $this->assign('v2',"退出"); 
            $this->assign('code2',"12");
        }else{
            $this->assign('v1',"登录"); 
            $this->assign('code1',"21");
            $this->assign('v2',"注册"); 
            $this->assign('code2',"22");            
        }
		$db = M('product');
		$select=$db->where('id='.$_GET['id'])->select();
		$this->assign('orderInfo',$select); 
		$this->display();
    }

}
?>