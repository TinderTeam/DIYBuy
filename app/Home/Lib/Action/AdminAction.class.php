<?php
header("Content-Tyoe:text/html;charset=utf-8");

class AdminAction extends Action{
    // 登陆验证
    public function check(){
        session_start();
        $time=30*60; 
        setcookie(session_name(),session_id(),time()+$time,"/");
        $admin = M('admin');
        $_SESSION['name']= $_POST['name'];
        $condition['name']=$_POST['name'];
        $password=$_POST['pwd'];
        $pwd = $admin->where($condition)->getField('pwd');
        if($_SESSION['name']=="admin"){
            if($admin->create()){
                
                if($pwd==$password){
                    //$this->success($_POST['admin_name']);
                    $this->redirect('UserManage/userManage','',0,'登录成功');//页面重定向
                }else{
                    $this->error('密码错误');
                }
                
            }else{
                //$this->error('输入错误');
                $this->show($pwd);
            } 
        }else{
            echo error('你还没有登陆呢！');
        }
    }
	//登录页面
	public function login(){
		$this->display();
	}
	//退出登陆，清session
    public function logout(){
        session_start();
        unset($_SESSION['name']);
        session_destroy();
        $this->redirect('Admin/login','',0,'退出登陆成功！');
    }
	//进入修改密码页面
    public function accountModify(){
		$this->display();
	}
	//提交修改后的密码
	public function modifyPassword(){
	
		$pwd=$_POST['pwd'];
		$oldpwd = $_POST['oldpwd'];
		$condition['name']=$_POST['name'];
		$admin   =   M('admin');
		$password = $admin->where($condition)->getField('pwd');
        $data['pwd']=$pwd;
		if($oldpwd==$password)
		{

			$result=$admin->where($condition)->save($data);
			if($result!==false)
			{
				unset($_SESSION['name']);
				session_destroy();
				$this->assign("jumpUrl","__APP__/Admin/login");
				$this->success("修改成功，请重新登录");
				
				//$this->redirect("__APP__/Index/login","",0,"修改成功"); 
			} 
			else
			{
			
				$this->assign("jumpUrl","accountModify");
				$this->error("修改失败,请重新修改");

			}

		}
		else
		{
			$this->assign("jumpUrl","accountModify");
			$this->error("原密码输入有误,请重新输入");
		}
        
    }
    
    
}  
?>
