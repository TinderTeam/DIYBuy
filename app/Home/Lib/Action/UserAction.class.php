<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class UserAction extends Action {
    public function accountModify(){
		$email=$_SESSION['email'];
		$this->assign('email',$email);
	    $this->display();
    }
	
	public function modifyPassword(){
	
		$email=$_SESSION['email'];
		$pwd=$_POST['pwd'];
		$pwd2=$_POST['pwd2'];
		$user   =   M('user');
        $condition['email']=$_POST['userName'];
		if($pwd==$pwd2)
		{
			$data['pwd']=$pwd;
			if($user->create())
			{
                if($user->where($condition)->save($data))
				{
                    $this->redirect("__APP__/Index/login","",0,"修改成功"); 
					//$this->success('操作成功！');
                    //$this->redirect("Admin/administrater","",1,"OK");
				} 
				else{
						$this->assign('email',$email);
						$this->display('accountModify');
					}
				
            }else{
                $this->error($user->getError());
            } 
		}
		else
		{
			$this->assign('email',$email);
			$this->display('accountModify');
		}
        
    }
	
    public function myOrder(){
	
		$email=$_SESSION['email'];
		$condition['user'] = $email;
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
        $orderDelete = M("order"); // 实例化product对象
		$condition['Id']=$_POST['button'];
		if($orderDelete->where($condition)->delete()){// 删除id为5的用户数据
			$this->redirect('User/myOrder','',0,'删除成功');//页面重定向
		}else{
			$this->error("删除失败！");
		}
    }
    public function myGroup(){

	    $email=$_SESSION['email'];
		$condition['sponsor'] = $email;
		$dbGroup = M('product');
        import("ORG.Util.Page");		
        $countGroup = $dbGroup->where($condition)->count();
        $PageGroup = new Page($countGroup,5);  // 实例化分页类 传入总记录数和每页显示的记录数
        $showGroup = $PageGroup->show();                                                        
        $listGroup = $dbGroup->where($condition)->order("time_start desc")->limit($PageGroup->firstRow.','.$PageGroup->listRows)->select();
        $this->assign('groupInfo',$listGroup); // 赋值数据集
        $this->assign('pageGroup',$showGroup); // 赋值分页输出
	    $this->display();
    }
	public function modifyGroupStatus(){
	
		$email=$_SESSION['email'];
		$status=$_POST['selectStatus'];
		$product = M('product');
        $condition['id']=$_POST['button'];
		//$this->show($status);
		
		$data['status']=$status;

		if($product->where($condition)->save($data))
		{
			$this->redirect("__APP__/User/myGroup","",0,"修改成功"); 
			//$this->success('操作成功！');
			//$this->redirect("Admin/administrater","",1,"OK");
		} 
		else
		{
			$this->assign('email',$email);
			$this->display('myGroup');
		}

	}
   
}
?>