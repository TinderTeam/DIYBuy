<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class PurchaseAction extends Action {
    public function productDetails($id=0){
	require './home/Lib/Action/Public.php';
		
		$db = M('product');
		if($_POST['buttonDetails']!="")
		{
			$_SESSION['productDetailID']=$_POST['buttonDetails'];	//今天团购跳转使用
		}
		elseif($id!=0)
		{
			$_SESSION['productDetailID']=$id;						//订单页面跳转使用
		}
		$select=$db->where('id='.$_SESSION['productDetailID'])->find();
		$this->assign('purchaseInfo',$select); 
		$this->display();
    }
    public function orderPay($Id=0){        
        
		if($_POST['productID']!=0)
		{
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
			
			$newOrder = M('order');
			$orderID = $newOrder->where('user='.$user AND 'productID='.$productID)->max('Id');
			$_SESSION['productPayID']=$orderID;
		}
		elseif($Id!=0)
		{
			$_SESSION['productPayID']=$Id;
			
		}
		$orderID=$_SESSION['productPayID'];
		$oldOrder = M('order');
		$productName = $oldOrder->where('Id='.$orderID)->getField('productName');
		$quantity = $oldOrder->where('Id='.$orderID)->getField('quantity');
		$totalPrices = $oldOrder->where('Id='.$orderID)->getField('totalPrices');
		
		$dbUser = M('user');
		$condition['name'] = $_SESSION['name'];
		$account=$dbUser->where($condition)->getField('account');
		
		//加载淘宝、拍拍充值地址、客服地址信息
		$SysDB = M('sys');
		$sysTaobaoCondition['key']='taobao';
		$taobao = $SysDB->where($sysTaobaoCondition)->find();
		$sysPaipaiCondition['key']='paipai';
		$paipai = $SysDB->where($sysPaipaiCondition)->find();
		$this->assign('taobao',$taobao['value']);
		$this->assign('paipai',$paipai['value']);
		
		$this->assign('account',$account);
		$this->assign('orderID',$orderID);
		$this->assign('productName',$productName);					
		$this->assign('amount',$quantity);
		$this->assign('sumMoney',$totalPrices);
		$this->display();

    }
    
    public function orderList(){
		
		$User = M('user');
		$condition['name']=$_SESSION['name'];
		$userIdentity=$User->where($condition)->getField('identity');
		
		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}		
		elseif($userIdentity=="已审核")
		{
			if($_POST['buttonBuy']!="")
			{
				$_SESSION['productPayID']=$_POST['buttonBuy'];
				
			}
			$db = M('product');
			$select=$db->where('id='.$_SESSION['productPayID'])->select();
			$this->assign('orderInfo',$select); 
			$this->display();			
		}
		else
		{
			$this->assign("jumpUrl","__APP__/User/userInfo");
			$this->error("请完善您的个人信息并提交审核，审核通过后方可参与抢团");
		}
		
    }
	public function payResult(){
		if($_POST['orderID']!="")
		{
			$_SESSION['orderPayID']=$_POST['orderID'];
			$dbOrder = M('order');
			$orderID = $_POST['orderID'];
			$condition['Id'] = $orderID;
			$orderData['status']="已付款";
			//产生随机优惠码
			do
			{
				$code = rand(1000,9999).date('mdHis',time());
			}while($dbOrder->where('code='.$code)->count());
			$orderData['code']=$code;
			$updateOrder=$dbOrder->where($condition)->save($orderData);		//更新订单状态
			$productID = $dbOrder->where($condition)->getField('productID');	//获取产品ID
			
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
			$productData['current_num'] = $currentNum+1;
			$updateProduct=$product->where($condition2)->save($productData);	//更新参团人数
			
		}
		else
		{
			$dbOrder = M('order');
			$condition['Id'] = $_SESSION['orderPayID'];
			$productName=$dbOrder->where($condition)->getField('productName');
			$sumMoney=$dbOrder->where($condition)->getField('totalPrices');
			$dbUser = M('user');
			$condition1['name'] = $_SESSION['name'];
			$finalAccount=$dbUser->where($condition1)->getField('account');
		}

		$this->assign('orderID',$_SESSION['orderPayID']); 
		$this->assign('productName',$productName);
		$this->assign('sumMoney',$sumMoney);
		$this->assign('finalAccount',$finalAccount);
		$this->display();
    }

}
?>