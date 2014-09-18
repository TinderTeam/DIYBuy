<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class PurchaseAction extends Action {
    public function productDetails($id=0){
	require './home/Lib/Action/Public.php';
        	
		$db = M('product');
		if($_POST['buttonDetails']!="")
		{
			$select=$db->where('id='.$_POST['buttonDetails'])->select();	//今天团购跳转使用
		}
		else
		{
			$condition['id']=$id;
			$select=$db->where($condition)->select();	//订单页面跳转使用
		}
		$this->assign('purchaseInfo',$select); 
		$this->display();
    }
    public function orderPay(){        
        if($_SESSION['email']!=""){
			
			$db = M('product');
			$Order = M('order');
			$productID=$_POST['productID'];
			$data['productID'] = $productID;
			$productName=$db->where('id='.$productID)->getField('name');
			$data['productName'] = $productName;
			$quantity=$_POST['amount'];
			$data['quantity'] = $quantity;
			$totalPrices=$quantity*$db->where('id='.$productID)->getField('price_low');
			$data['totalPrices'] = $totalPrices;
			$user=$_SESSION['email'];
			$data['user'] = $user;
			$Order->add($data);				//新建订单信息存入数据库

			$newOrder = M('order');
			$orderID = $newOrder->where('user='.$user AND 'productID='.$productID)->max('Id');
			$this->assign('orderID',$orderID);
			$this->assign('productName',$productName);					
			$this->assign('amount',$quantity);
			$this->assign('sumMoney',$totalPrices);
			$this->display();

			
        }else{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
        }
		
    }
    
    public function orderList(){
    
		$db = M('product');
		$select=$db->where('id='.$_POST['buttonBuy'])->select();
		$this->assign('orderInfo',$select); 
		$this->display();
    }

}
?>