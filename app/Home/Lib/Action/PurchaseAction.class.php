<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class PurchaseAction extends Action {
    public function productDetails()
	{
		require './home/Lib/Action/Public.php';
		$db = M('product');
		$select=$db->where('id='.$_GET['id'])->select();
		$this->assign('purchaseInfo',$select); 
		$this->display();
	}

    public function orderPay(){

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