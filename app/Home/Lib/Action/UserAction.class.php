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

	    $this->display();
    }    
    public function myGroup(){

	    $this->display();
    }   
    
} 
?>