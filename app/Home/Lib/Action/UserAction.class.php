<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class UserAction extends Action {
    public function accountModify(){
		$name=$_SESSION['name'];
		$this->assign('name',$name);
	    $this->display();
    }
	
	public function modifyPassword(){
	
		$name=$_SESSION['name'];
		$pwd=$_POST['pwd'];
		$pwd2=$_POST['pwd2'];
		$user   =   M('user');
        $condition['name']=$_POST['userName'];
		$data['pwd']=$pwd;
		if($user->create())
		{
			if($user->where($condition)->save($data))
			{
				unset($_SESSION['name']);
				session_destroy();
				$this->assign("jumpUrl","__APP__/Index/login");
				$this->success("修改成功，请重新登录");
				
				//$this->redirect("__APP__/Index/login","",0,"修改成功"); 
			} 
			else{
					$this->assign('name',$name);
					$this->assign("jumpUrl","accountModify");
					$this->error("修改失败");

				}
			
		}else{
			$this->error($user->getError());
		} 

        
    }
	
    public function myOrder(){
	
		$name=$_SESSION['name'];
		$condition['user'] = $name;
		$dbOrder = M('order');
        import("ORG.Util.Page");		
        $countOrder = $dbOrder->where($condition)->count();
        $PageOrder = new Page($countOrder,10);  // 实例化分页类 传入总记录数和每页显示的记录数
        $showOrder = $PageOrder->show();
        $listOrder = $dbOrder->where($condition)->order("Id desc")->limit($PageOrder->firstRow.','.$PageOrder->listRows)->select();
        $this->assign('orderInfo',$listOrder); // 赋值数据集
        $this->assign('pageOrder',$showOrder); // 赋值分页输出
	    $this->display();
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
    public function myGroup(){

	    $name=$_SESSION['name'];
		$condition['sponsor'] = $name;
		$dbGroup = M('product');
        import("ORG.Util.Page");
		$condition2['time_end']=array('LT',date('Y-m-d H:i:s',time()));
		$dataSuccess['status']='组团成功';
		$dataFail['status']='组团失败';
		$dbGroup->where($condition2)->where('current_num>=total_num AND status="组团中"')->save($dataSuccess);	//时间截止时，如果参与人数大于总人数，则团购成功
		$dbGroup->where($condition2)->where('current_num<total_num AND status="组团中"')->save($dataFail);		//时间截止时，如果参与人数小于总人数，则团购失败
        
		$countGroup = $dbGroup->where($condition)->count();
        $PageGroup = new Page($countGroup,5);  // 实例化分页类 传入总记录数和每页显示的记录数
        $showGroup = $PageGroup->show();                                                        
        $listGroup = $dbGroup->where($condition)->order("time_start desc")->limit($PageGroup->firstRow.','.$PageGroup->listRows)->select();
        $this->assign('groupInfo',$listGroup); // 赋值数据集
        $this->assign('pageGroup',$showGroup); // 赋值分页输出
	    $this->display();
    }
	public function modifyGroupStatus(){
	
		$name=$_SESSION['name'];
		$status=$_POST['selectStatus'];
		$product = M('product');
        $condition['id']=$_POST['button'];
		//$this->show($status);
		
		$data['status']=$status;

		if($product->where($condition)->save($data))
		{
			$this->assign('name',$name);
			$this->assign("jumpUrl","__APP__/User/myGroup");
			$this->success("修改成功");
			//$this->redirect("__APP__/User/myGroup","",0,"修改成功"); 
			//$this->success('操作成功！');
			//$this->redirect("Admin/administrater","",1,"OK");
		} 
		else
		{
			$this->assign('name',$name);
			$this->assign("jumpUrl","__APP__/User/myGroup");
			$this->error("操作失败，请重新修改");
			//$this->display('myGroup');
		}

	}
   
}
?>