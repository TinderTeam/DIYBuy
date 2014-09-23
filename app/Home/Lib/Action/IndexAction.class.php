<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");


class IndexAction extends Action { 
    
    public function index(){
        require './home/Lib/Action/Public.php';

        //显示产品           
        $db = M('product');
        import("ORG.Util.Page");
		$condition1['time_end']=array('GT',date('Y-m-d H:i:s',time()));	//判断截至时间大于当前时间的条件
		$condition2['time_end']=array('LT',date('Y-m-d H:i:s',time()));
		$dataSuccess['status']='团购成功';
		$dataFail['status']='团购失败';
		$db->where($condition2)->where('current_num>=total_num AND status="团购中"')->save($dataSuccess);
		$db->where($condition2)->where('current_num<total_num AND status="团购中"')->save($dataFail);
		
        $count = $db->where($condition1)->where('status="团购中"')->count();
        $Page1 = new Page($count,8);  // 实例化分页类 传入总记录数和每页显示的记录数                                                     
        $list1 = $db->where($condition1)->where('status="团购中"')->order('time_start desc')->limit($Page1->firstRow.','.$Page1->listRows)->select();
        $this->assign('productinfo',$list1); // 赋值数据集
		$show = $Page1->show(); 
        $this->assign('page',$show); // 赋值分页输出
		$this->display();
    }
	
	public function register(){	
		$this->display();
	}
	public function login(){	
		$this->display();
	}
    public function logout(){	
		session_destroy();
		$this->redirect('Index/index');
	}

    
    public function aboutUs(){
		require './home/Lib/Action/Public.php';
        $this->display();
    }
    
    public function purchaseHistory(){
		require './home/Lib/Action/Public.php';

		//显示产品           
		
		$db = M('product');
        import("ORG.Util.Page"); 
        $count = $db->where('status="团购成功" OR status="团购失败"')->count();
		$historyPage = new Page($count,8);  // 实例化分页类 传入总记录数和每页显示的记录数		
		$historyList = $db->where('status="团购成功" OR status="团购失败"')->order('time_end desc')->limit($historyPage->firstRow.','.$historyPage->listRows)->select();
        $this->assign('historyinfo',$historyList); // 赋值数据集
		$show = $historyPage->show(); 
		$this->assign('showPage',$show); // 赋值分页输出
        $this->display();
    }
    
    
    // 登陆验证
    public function check(){
        session_start();
        $time=30*60; 
        setcookie(session_name(),session_id(),time()+$time,"/");
        $User = M('user');
        $_SESSION['name']= $_POST['name'];
        $condition['name']=$_POST['name'];
		$password=$_POST['pwd'];

        $pwd = $User->where($condition)->getField('pwd');
        if($_SESSION['name']!=""){
			if($User->create()){
				
				if($pwd==$password){
					//$this->success($_POST['admin_name']);
					//$this->assign("jumpUrl","index");
					//$this->success("您已成功登录");
					$this->redirect('Index/index','',0,'登陆成功');//页面重定向
				}else{
					unset($_SESSION['name']);
					session_destroy();
					$this->assign("jumpUrl","login");
					$this->error("用户名或密码不正确！");
				}
				
			}else{
				$this->error('输入错误');
			} 
        }else{
            $this->error('你还没有登陆呢！');
        }
    }
    
    public function insert(){        
        $User = M('user');
		$name=$_POST['name'];
		$email = $_POST['email'];
		$pwd=$_POST['pwd'];
		$condition1['name'] = $name;
		$condition2['email'] = $email;
		$select1=$User->where($condition1)->count();
		$select2=$User->where($condition2)->count();
		if($select1!=0)
		{
			$this->assign("jumpUrl","register");
			$this->error("用户名已被注册，请重新输入用户名");
		}
		elseif($select2!=0)
		{
			$this->assign("jumpUrl","register");
			$this->error("邮箱已被注册，请重新输入邮箱");
		}
        elseif($User->create()) 
		{
            $result =  $User->add();
            if($result) {
				//SendMail("liyonglei@fuego.cn","又来个账户咯","$name----华丽的分割线-----$pwd");
				$this->assign("jumpUrl","login");
				$this->success("注册成功");
            }else{
                $this->assign("jumpUrl","register");
                $this->error("注册失败，请重试");
            }
        }else
		{
            $this->assign("jumpUrl","register");
            $this->error("注册失败，请重试");
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


}
?>