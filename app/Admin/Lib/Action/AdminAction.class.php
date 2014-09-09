<?php
header("Content-Tyoe:text/html;charset=utf-8");

class AdminAction extends Action{
    // 登陆验证
    public function check(){
        session_start();
        $time=30*60; 
        setcookie(session_name(),session_id(),time()+$time,"/");
        $admin = M('admin');
        $_SESSION['admin_name']= $_POST['admin_name'];
        $condition['name']=$_POST['admin_name'];
        $password=$_POST['admin_pwd'];
        $pwd = $admin->where($condition)->getField('pwd');
        if($_SESSION['admin_name']!=""){
        if($admin->create()){
            
            if($pwd==$password){
                //$this->success($_POST['admin_name']);
                $this->redirect('Admin/manage','',0,'为啥是乱码');//页面重定向
            }else{
                $this->error('密码错误');
            }
            
        }else{
            $this->error('输入错误');
        } 
        }else{
            echo error('你还没有登陆呢！');
        }
    }
    
    // 用分页类 实现分页查询
    public function manage(){
        if($_SESSION['admin_name']!=""){
            $db = M('user');
            import("ORG.Util.Page"); 
            $count = $db->count();
            //$count = $user->where($condition)->count();
            $Page = new Page($count,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show(); 
                                                           
            $list = $db->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('b',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
            $this->display(manage);
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }       
    }
    
    //退出登陆，清session
    public function logout(){
        session_start();
        unset($_SESSION['admin_name']);
        session_destroy();
        $this->redirect('Admin/login','',0,'退出登陆成功！');
    }
    
    public function product(){
        if($_SESSION['admin_name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $db = M('product');
            import("ORG.Util.Page"); 
            $count = $db->count();
            //$count = $user->where($condition)->count();
            $Page = new Page($count,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show(); 
                                                           
            $list = $db->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('productlist',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
            $this->display(product);
        }
    }
    
    public function administrater(){
        if($_SESSION['admin_name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $db = M('admin');
            import("ORG.Util.Page"); 
            $count = $db->count();
            //$count = $user->where($condition)->count();
            $Page = new Page($count,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show(); 
                                                           
            $list = $db->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('adminlist',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
            $this->display(administrater);
        }
    }

}  
?>
