<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class UserAction extends Action {
	public function userInfo(){
		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$name=$_SESSION['name'];
			$condition['name']=$_SESSION['name'];
			$user = M('user');
			$myuser = $user->where($condition)->find();
			$this->assign('myuser',$myuser);
			$this->display();
		}
		
    }
	public function userInfoSubmit(){
	
		$nameCondition['name']=$_SESSION['name'];

		$user = M('user');
		$data['account_type']=$_POST['account_type'];
		$data['account_name']=$_POST['account_name'];
		$data['real_name']=$_POST['real_name'];
		$data['identity']="待审核";
		$data['note']="";
		$myuser=$user->where($nameCondition)->find();
		$result=$user->where($nameCondition)->save($data);
		if($result!==false)
		{
			$this->assign('myuser',$myuser);
			$this->assign("jumpUrl","__APP__/User/userInfo");
			$this->success("提交成功，请重新登录");

		} 
		else
		{
			$this->assign('myuser',$myuser);
			$this->assign("jumpUrl","__APP__/User/userInfo");
			$this->error("提交失败，请重试");

		}
    }
	  public function passwordSetup(){
		$this->display();
	  }
	
    public function account(){
		$name=$_SESSION['name'];
		$condition['name']=$_SESSION['name'];
		//获取账户信息
		$user = M('user');
		$account = $user->where($condition)->getField('account');
		$this->assign('account',$account);
		//加载淘宝，拍拍充值地址
		$SysDB = M('sys');
		$sysTaobaoCondition['key']='taobao';
		$taobao = $SysDB->where($sysTaobaoCondition)->find();
		
		$sysPaipaiCondition['key']='paipai';
		$paipai = $SysDB->where($sysPaipaiCondition)->find();
		$this->assign('taobao',$taobao['value']);
		$this->assign('paipai',$paipai['value']);
	    $this->display();
    }	
	
	public function modifyPassword(){
		$name=$_SESSION['name'];
		$pwd=$_POST['pwd'];
		$oldpwd =md5($_POST['oldpwd']);
		$user   =   M('user');
        $condition['name']=$name;
		$password = $user->where($condition)->getField('pwd');
		$data['pwd']=md5($pwd);
		if($oldpwd==$password)
		{
			$result=$user->where($condition)->save($data);
			if($result!==false)
			{
				unset($_SESSION['name']);
				session_destroy();
				$this->assign("jumpUrl","__APP__/Index/login");
				$this->success("修改成功，请重新登录");
				
				//$this->redirect("__APP__/Index/login","",0,"修改成功"); 
			} 
			else
			{
				$this->assign('name',$name);
				$this->assign("jumpUrl","passwordSetup");
				$this->error("修改失败，请重试");

			}
		}
		else
		{
			$this->assign('name',$name);
			$this->assign("jumpUrl","passwordSetup");
			$this->error("原密码输入错误，请重新输入");
		}
        
    }
	
	 public function myAttend(){
		
		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$nameCondition['username']=$_SESSION['name'];
			$groupOrderView = M('group_order_view');
			import("ORG.Util.Page");
			$groupOrderCount = $groupOrderView->where($nameCondition)->count();
			$PageOrder = new Page($groupOrderCount,8);  // 实例化分页类 传入总记录数和每页显示的记录数
			$showOrder = $PageOrder->show();
			$groupOrderList = $groupOrderView->where($nameCondition)->order("Id desc")->limit($PageOrder->firstRow.','.$PageOrder->listRows)->select();
			$this->assign('countOrder',$groupOrderCount);
			$this->assign('groupOrderList',$groupOrderList);
			$this->assign('pageOrder',$showOrder); // 赋值分页输出
			$this->display();
		}
		
	 }
	 public function ongoingAttend(){
		
		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$nameCondition['username']=$_SESSION['name'];
			$groupOrderView = M('group_order_view');
			import("ORG.Util.Page");
			$groupOrderCount = $groupOrderView->where($nameCondition)->where('status="组团中"')->count();
			$PageOrder = new Page($groupOrderCount,8);  // 实例化分页类 传入总记录数和每页显示的记录数
			$showOrder = $PageOrder->show();
			$groupOrderList = $groupOrderView->where($nameCondition)->where('status="组团中"')->order("Id desc")->limit($PageOrder->firstRow.','.$PageOrder->listRows)->select();
			$this->assign('countOrder',$groupOrderCount);
			$this->assign('groupOrderList',$groupOrderList);
			$this->assign('pageOrder',$showOrder); // 赋值分页输出
			$this->display();
		}
		
	 }
	 public function endAttend(){
		
		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$nameCondition['username']=$_SESSION['name'];
			$groupOrderView = M('group_order_view');
			import("ORG.Util.Page");
			$groupOrderCount = $groupOrderView->where($nameCondition)->where('status="组团成功" or status="组团失败" or status="议价中" or status="议价成功" or status="议价失败"')->count();
			$PageOrder = new Page($groupOrderCount,8);  // 实例化分页类 传入总记录数和每页显示的记录数
			$showOrder = $PageOrder->show();
			$groupOrderList = $groupOrderView->where($nameCondition)->where('status="组团成功" or status="组团失败" or status="议价中" or status="议价成功" or status="议价失败"')->order("Id desc")->limit($PageOrder->firstRow.','.$PageOrder->listRows)->select();
			$this->assign('countOrder',$groupOrderCount);
			$this->assign('groupOrderList',$groupOrderList);
			$this->assign('pageOrder',$showOrder); // 赋值分页输出
			$this->display();
		}
		
	 }
	
    public function myOrder(){
	
		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$name=$_SESSION['name'];
			$condition['userName'] = $name;
			$dbOrder = M('order_view');
			import("ORG.Util.Page");		
			$countOrder = $dbOrder->where($condition)->count();
			$PageOrder = new Page($countOrder,10);  // 实例化分页类 传入总记录数和每页显示的记录数
			$showOrder = $PageOrder->show();
			$listOrder = $dbOrder->where($condition)->order("Id desc")->limit($PageOrder->firstRow.','.$PageOrder->listRows)->select();

			$this->assign('countOrder',$countOrder);
			$this->assign('orderInfo',$listOrder); // 赋值数据集
			$this->assign('pageOrder',$showOrder); // 赋值分页输出
			$this->display();
		}
		
    }
	public function ongoingOrder(){
	
		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$name=$_SESSION['name'];
			$condition['userName'] = $name;
			$dbOrder = M('order_view');
			import("ORG.Util.Page");

			$countOrder = $dbOrder->where($condition)->where('productStatus="团购中"')->count();
			$PageOrder = new Page($countOrder,10);  // 实例化分页类 传入总记录数和每页显示的记录数
			$showOrder = $PageOrder->show();
			$listOrder = $dbOrder->where($condition)->where('productStatus="团购中"')->order("Id desc")->limit($PageOrder->firstRow.','.$PageOrder->listRows)->select();
			$this->assign('countOrder',$countOrder);
			$this->assign('orderInfo',$listOrder); // 赋值数据集
			$this->assign('pageOrder',$showOrder); // 赋值分页输出
			$this->display();
		}
		
    }
	public function endOrder(){
	
		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$name=$_SESSION['name'];
			$condition['userName'] = $name;
			$dbOrder = M('order_view');
			import("ORG.Util.Page");
			$countOrder = $dbOrder->where($condition)->where('productStatus="团购成功" or productStatus="团购失败"')->count();
			$PageOrder = new Page($countOrder,10);  // 实例化分页类 传入总记录数和每页显示的记录数
			$showOrder = $PageOrder->show();
			$listOrder = $dbOrder->where($condition)->where('productStatus="团购成功" or productStatus="团购失败"')->order("Id desc")->limit($PageOrder->firstRow.','.$PageOrder->listRows)->select();
			$this->assign('countOrder',$countOrder);
			$this->assign('orderInfo',$listOrder); // 赋值数据集
			$this->assign('pageOrder',$showOrder); // 赋值分页输出
			$this->display();
		}
		
    }
	public function deleteOrder(){
		$name=$_SESSION['name'];
        $orderDelete = M("order"); // 实例化product对象
		$condition['Id']=$_POST['button'];
		if($orderDelete->where($condition)->delete()){// 删除id为5的用户数据
			$this->assign('name',$name);
			$this->assign("jumpUrl","__APP__/User/myOrder");
			$this->success("删除成功");
			//$this->redirect('User/myOrder','',0,'删除成功');
		}else{
			$this->assign('name',$name);
			$this->assign("jumpUrl","__APP__/User/myOrder");
			$this->error("删除失败，请重新操作");
			//$this->error("删除失败！");
		}
    }
	//显示我们的组团列表
    public function myGroup(){

		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$name=$_SESSION['name'];
			$user = M('user');
			$nameCondition['name'] =$name;
			$userID=$user->where($nameCondition)->getField('id');
			$condition['sponsor'] = $userID;
			$dbGroup = M('product');
			import("ORG.Util.Page");
			$condition2['time_end']=array('LT',date('Y-m-d H:i:s',time()));
			$dataFail['status']='组团失败';
			$dbGroup->where($condition2)->where('current_num<total_num AND status="组团中"')->save($dataFail);		//时间截止时，如果参与人数小于总人数，则团购失败
			
			$countGroup = $dbGroup->where($condition)->count();
			$PageGroup = new Page($countGroup,5);  // 实例化分页类 传入总记录数和每页显示的记录数
			$showGroup = $PageGroup->show();                                                        
			$listGroup = $dbGroup->where($condition)->order("time_start desc")->limit($PageGroup->firstRow.','.$PageGroup->listRows)->select();
			$this->assign('countGroup',$countGroup);
			$this->assign('groupInfo',$listGroup); // 赋值数据集
			$this->assign('pageGroup',$showGroup); // 赋值分页输出
			$this->display();
		}
	    
    }
	//显示我们的组团列表
    public function ongoingGroup(){

		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$name=$_SESSION['name'];
			$user = M('user');
			$nameCondition['name'] =$name;
			$userID=$user->where($nameCondition)->getField('id');
			$condition['sponsor'] = $userID;
			$dbGroup = M('product');
			import("ORG.Util.Page");
		
			$countGroup = $dbGroup->where($condition)->where('status="待审核" or status="已驳回" or status="组团中" or status="组团失败" or status="议价中"')->count();
			$PageGroup = new Page($countGroup,5);  // 实例化分页类 传入总记录数和每页显示的记录数
			$showGroup = $PageGroup->show();                                                        
			$listGroup = $dbGroup->where($condition)->where('status="待审核" or status="已驳回" or status="组团中" or status="组团失败" or status="议价中"')->order("time_start desc")->limit($PageGroup->firstRow.','.$PageGroup->listRows)->select();
			$this->assign('countGroup',$countGroup);
			$this->assign('groupInfo',$listGroup); // 赋值数据集
			$this->assign('pageGroup',$showGroup); // 赋值分页输出
			$this->display();
		}
	    
    }
	//显示我们的组团列表
    public function endGroup(){

		if($_SESSION['name']=="")
		{
			$this->redirect("__APP__/Index/login","",0,"你还没登陆"); 
			
		}
		else
		{
			$name=$_SESSION['name'];
			$user = M('user');
			$nameCondition['name'] =$name;
			$userID=$user->where($nameCondition)->getField('id');
			$condition['sponsor'] = $userID;
			$dbGroup = M('product');
			import("ORG.Util.Page");
		
			$countGroup = $dbGroup->where($condition)->where('status="议价成功" or status="议价失败" or status="团购中" or status="团购成功" or status="团购失败"')->count();
			$PageGroup = new Page($countGroup,5);  // 实例化分页类 传入总记录数和每页显示的记录数
			$showGroup = $PageGroup->show();                                                        
			$listGroup = $dbGroup->where($condition)->where('status="议价成功" or status="议价失败" or status="团购中" or status="团购成功" or status="团购失败"')->order("time_start desc")->limit($PageGroup->firstRow.','.$PageGroup->listRows)->select();
			$this->assign('countGroup',$countGroup);
			$this->assign('groupInfo',$listGroup); // 赋值数据集
			$this->assign('pageGroup',$showGroup); // 赋值分页输出
			$this->display();
		}
	    
    }
	//显示编辑组团列表
	public function editGroup($groupID=0){
		$groupIDCondition['id'] = $groupID;
		$dbGroup = M('product');
		$myGroup = $dbGroup->where($groupIDCondition)->find();
		$this->assign('myGroup',$myGroup);
		$this->display();
	}
	//更新组团信息
	public function updateGroup(){
		
		import("ORG.Net.UploadFile");  
		//实例化上传类  
		$upload = new UploadFile();  
		$upload->maxSize = 4145728; 
		//$upload->saveRule=time; 
		//设置文件上传类型  
		$upload->allowExts = array('jpg','gif','png','jpeg');  
		//设置文件上传位置  
		$upload->savePath = "./Public/Uploads/";//这里说明一下，由于ThinkPHP是有入口文件的，所以这里的./Public是指网站根目录下的Public文件夹  
		//设置文件上传名(按照时间)  
		//$upload->saveRule = "time";  
		if (!$upload->upload()){
			//$this->error($upload->getErrorMsg());  
		}else{
			//上传成功，获取上传信息  
		$info = $upload->getUploadFileInfo();
		} 

		$product = M('product');
		$IDCondition['id']=$_POST['productID'];
		if($info[0]['savename']!=""){
			$data['pic1'] = $info[0]['savename'];
			
		}
		if($info[1]['savename']!=""){
			$data['pic2'] = $info[1]['savename'];
		}
		if($info[2]['savename']!=""){
			$data['pic3'] = $info[2]['savename'];
		}
		if($info[3]['savename']!=""){
			$data['pic4'] = $info[3]['savename'];
		}
		if($info[4]['savename']!=""){
			$data['pic5'] = $info[4]['savename'];
		}
		if($info[5]['savename']!=""){
			$data['pic6'] = $info[5]['savename'];
		}
		$data['name']=$_POST['name'];
		$data['price_orginal']=$_POST['price_orginal'];
		$data['price_high']=$_POST['price_high'];
		$data['link_add']=$_POST['link_add'];
		$data['time_end']=$_POST['time_end'];
		$data['describ']=$_POST['describ'];
		$data['comment']=$_POST['comment'];
		$data['status']="待审核";
		$data['note']="";
		$result=$product->where($IDCondition)->save($data);
		if($result!==false)
		{
			$this->assign("jumpUrl","__APP__/User/myGroup");
			$this->success("操作成功");
		} 
		else
		{
			$this->assign("jumpUrl","__APP__/User/myGroup");
			$this->error("操作失败，请重新提交");
		}
	}
   
}
?>