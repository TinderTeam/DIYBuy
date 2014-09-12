<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class PurchaseAction extends Action {
    public function productDetails(){
	require './home/Lib/Action/Public.php';
		$db = M('product');
		$select=$db->where('id='.$_GET['id'])->select();
		$this->assign('purchaseInfo',$select); 
		$this->display();
    }
    
    public function orderPay(){
        if($_SESSION['email']!=""){
			$db = M('user');
			$condition['email']=$_SESSION['email'];
			$name = $User->where($condition)->getField('name');
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

	    $orderID=$_POST['orderID'];
		$db = M('product');
		$select=$db->where('id='.$orderID)->select();
		$this->assign('payInfo',$select); 
		$amount=$_POST['amount'];
		$this->assign('amount',$amount);
		$sumMoney=$amount*$db->where('id='.$orderID)->getField('price_high');
		$this->assign('sumMoney',$sumMoney);
	    	$this->display();
    }
	
    public function orderList(){
		$db = M('product');
		$select=$db->where('id='.$_GET['id'])->select();
		$this->assign('orderInfo',$select); 
		$this->display();
    }

}
?>