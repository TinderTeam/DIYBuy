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
        if($_SESSION['name']!=""){
			$db = M('product');
			$Order = M('order');
			$productID=$_POST['productID'];
			$data['productID'] = $productID;
			$productName=$db->where('id='.$productID)->getField('name');
			$data['productName'] = $productName;
			$quantity=$_POST['amount'];
			$data['quantity'] = $quantity;
			$totalPrices=$quantity*$db->where('id='.$productID)->getField('price_low');
			$totalPrices = number_format($totalPrices, 2, '.','');
			$data['totalPrices'] = $totalPrices;
			$user=$_SESSION['name'];
			$data['user'] = $user;
			$Order->add($data);				//新建订单信息存入数据库
			
			$dbUser = M('user');
			$condition['name'] = $_SESSION['name'];
			$account=$dbUser->where($condition)->getField('account');
			
			$newOrder = M('order');
			$orderID = $newOrder->where('user='.$user AND 'productID='.$productID)->max('Id');
			$this->assign('account',$account);
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
	public function payResult(){
		$dbOrder = M('order');
		$orderID = $_POST['orderID'];
		$condition['Id'] = $orderID;
		$orderData['status']="已付款";
		$updateOrder=$dbOrder->where($condition)->save($orderData);	//更新订单状态
		$productID=$dbOrder->where($condition)->getField('productID');
		
		
		$dbUser = M('user');
		$condition1['name'] = $_SESSION['name'];
		$account = $_POST['account'];
		$sumMoney = $_POST['sumMoney'];
		$finalAccount = $account-$sumMoney;
		$finalAccount = number_format($finalAccount, 2, '.','');
		$userData['account'] = $finalAccount;
		$updateUser=$dbUser->where($condition1)->save($userData);	//更新用户帐户余额
		
		$product = M('product');
		$condition2['id'] = $productID;
		$productName = $product->where($condition2)->getField('name');
		$currentNum = $product->where($condition2)->getField('current_num');
		$productData['current_num'] = $currentNum+$_POST['amount'];
		$updateProduct=$product->where($condition2)->save($productData);	//更新参团人数
		
		$this->assign('orderID',$orderID); 
		$this->assign('productName',$productName);
		$this->assign('sumMoney',$sumMoney);
		$this->assign('finalAccount',$finalAccount);
		$this->display();
    }

}
?>