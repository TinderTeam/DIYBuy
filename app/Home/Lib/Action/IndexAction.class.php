<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");


class IndexAction extends Action { 
    
    public function index(){
        require './home/Lib/Action/Public.php';
        if($_SESSION['email']!=""){
            $this->assign('v1',"已登录"); 
            $this->assign('code1',"11"); 
            $this->assign('v2',"退出"); 
            $this->assign('code2',"12");
        }else{
            $this->assign('v1',"登录"); 
            $this->assign('code1',"21");
            $this->assign('v2',"注册"); 
            $this->assign('code2',"22");            
        } 
               
        //显示产品           
        $db = M('product');
        import("ORG.Util.Page"); 
        $count = $db->count();
        //$count = $user->where($condition)->count();
        $Page1 = new Page($count,8);  // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page1->show(); 
                                                               
        $list1 = $db->order('id')->limit($Page1->firstRow.','.$Page1->listRows)->select();
        $this->assign('productinfo',$list1); // 赋值数据集
        $this->assign('page',$show); // 赋值分页输出
		

				
		
		
		
		
	    $this->display();
    }
    

    
    public function aboutUs(){
		require './home/Lib/Action/Public.php';
        if($_SESSION['email']!=""){
            $this->assign('v1',"已登录"); 
            $this->assign('code1',"11"); 
            $this->assign('v2',"退出"); 
            $this->assign('code2',"12");
        }else{
            $this->assign('v1',"登录"); 
            $this->assign('code1',"21");
            $this->assign('v2',"注册"); 
            $this->assign('code2',"22");            
        } 
		
        $this->display();
    }
    
    public function purchaseHistory(){
		require './home/Lib/Action/Public.php';
        if($_SESSION['email']!=""){
            $this->assign('v1',"已登录"); 
            $this->assign('code1',"11"); 
            $this->assign('v2',"退出"); 
            $this->assign('code2',"12");
        }else{
            $this->assign('v1',"登录"); 
            $this->assign('code1',"21");
            $this->assign('v2',"注册"); 
            $this->assign('code2',"22");            
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
                $this->redirect('Index/index','',0,'登陆成功');//页面重定向
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
    
    public function insert(){        
        $User   =   M('user');
        if($User->create()) {
            $result =   $User->add();
            if($result) {
                $this->redirect('Index/login','',3,'注册成功');//页面重定向
            }else{
                //$this->error('写入错误！');
                $this->show(cao);
            }
        }else{
            $this->error($User->getError());
            //$this->show();
        }
    }
    	public function search()
	{
		require './home/Lib/Action/Public.php';
        $db = M('product');
        import("ORG.Util.Page"); 
	
		//mysql_query("set names utf8");

		if(isset($_POST['key'])){						//判断查询的关键字是否存在
			$key=$_POST['key'];
		}else if(isset($_GET['key'])){
			$key=$_GET['key'];
		}

		if($key!=''){
			$map="name like('%".$key."%') ";	
			$list = $db->where($map)->select();
			$this->assign('searchInfo',$list);				// 赋值数据集
			$count = $db->where($map)->count(); 		// 查询满足要求的总记录数
			$Page = new Page($count,8,'key='.$key); 	// 实例化分页类 传入总记录数、每页显示的记录数和查询的关键字
			$show = $Page->show(); 						// 分页显示输出
			$this->assign('page',$show);   				// 赋值分页输出	
			$this->display('search'); 			       // 输出模板
		
		}else{	

			echo "<script>alert('请输入关键信息!');history.back();</script>";
			
		}
										
		


		
	}

	public function productsDetails()
	{
		$db = M('product');
		$select=$db->where('id='.$_GET['id'])->select();
		$this->assign('purchaseInfo',$select); 
		$this->display('Purchase/productDetails');
	}


}
?>