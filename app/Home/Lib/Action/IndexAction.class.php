<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class IndexAction extends Action {
    public function index(){
        if($_SESSION['email']!=""){
            $this->assign('v1',"已登录"); 
            $this->assign('v2',"退出"); 
        }else{
            $this->assign('v1',"登录"); 
            $this->assign('v2',"注册");             
        } 
               
        //显示产品           
        $db = M('product');
        import("ORG.Util.Page"); 
        $count = $db->count();
        //$count = $user->where($condition)->count();
        $Page = new Page($count,8);  // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); 
                                                               
        $list = $db->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('productinfo',$list); // 赋值数据集
        $this->assign('page',$show); // 赋值分页输出
	    $this->display();
    }
    
    // 登陆验证
    public function check(){
        session_start();
        $time=30*60; 
        setcookie(session_name(),session_id(),time()+$time,"/");
        $User = M('user');
        $_SESSION['email']= $_POST['email'];
        $condition['email']=$_POST['email'];
        $password=$_POST['pwd'];
        $pwd = $User->where($condition)->getField('pwd');
        if($_SESSION['email']!=""){
        if($User->create()){
            
            if($pwd==$password){
                //$this->success($_POST['admin_name']);
                $this->redirect('Index/index','',5,'登陆成功');//页面重定向
            }else{
                $this->error('密码错误');
            }
            
        }else{
            $this->error('输入错误');
        } 
        }else{
            $this->error('你还没有登陆呢！');
        }
    }
    
    
    

}
?>