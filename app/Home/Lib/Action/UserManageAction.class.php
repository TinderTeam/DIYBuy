<?php
header("Content-Tyoe:text/html;charset=utf-8");

class UserManageAction extends Action{
    
    // 显示用户管理页面
    public function userManage($user_filter=0){
        if($_SESSION['name']!=""){
            
			$user = M('user');
            import("ORG.Util.Page");
			
			if($user_filter=='Approved')
			{
				$userCount = $user->where('identity="已审核"')->count();
				$Page = new Page($userCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$userList = $user->order('id')->where('identity="已审核"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($user_filter=="toActivate")
			{
				$userCount = $user->where('identity="待激活"')->count();
				$Page = new Page($userCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$userList = $user->order('id')->where('identity="待激活"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($user_filter=="Activated")
			{
				$userCount = $user->where('identity="已激活"')->count();
				$Page = new Page($userCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$userList = $user->order('id')->where('identity="已激活"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($user_filter=='toApprove')
			{
				$userCount = $user->where('identity="待审核"')->count();
				$Page = new Page($userCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$userList = $user->order('id')->where('identity="待审核"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($user_filter=='Reject')
			{
				$userCount = $user->where('identity="已拒绝"')->count();
				$Page = new Page($userCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$userList = $user->order('id')->where('identity="已拒绝"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($user_filter=='all')
			{
				$userCount = $user->count();
				$Page = new Page($userCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$userList = $user->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			else
			{
				$userCount = $user->where('identity="已审核"')->count();
				$Page = new Page($userCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$userList = $user->order('id')->where('identity="已审核"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
	
			$user_filter='Approved';		//设置初始值，如果重新点击商家中心，刷新页面，显示所有订单

            $this->assign('b',$userList); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
            $this->display();
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }       
    }
	//用户搜索
	public function userSearch()
	{
        $db = M('user');
        import("ORG.Util.Page"); 
	
		if(isset($_POST['key'])){						//判断查询的关键字是否存在
			$key=$_POST['key'];
		}else if(isset($_GET['key'])){
			$key=$_GET['key'];
		}

		if($key!=''){
			$map="name like('%".$key."%') ";	
			$count = $db->where($map)->count(); 		// 查询满足要求的总记录数
			$Page = new Page($count,8,'key='.$key); 	// 实例化分页类 传入总记录数、每页显示的记录数和查询的关键字
			$show = $Page->show(); 						// 分页显示输出
			$list = $db->order('id')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('b',$list);				// 赋值数据集
			$this->assign('page',$show);   				// 赋值分页输出	
			$this->display('UserManage/userManage'); 			// 输出模板
		
		}else{	

			$this->redirect('UserManage/userManage','',0,'登陆成功');//页面重定向
			//echo "<script>alert('请输入关键信息!');history.back();</script>";
			
		}	
	}
	//新增用户
	public function newUser(){

		$this->display();
    }
	public function insertUser(){
		$User = M('user');
		$data['name']=$_POST['name'];
		$data['email'] = $_POST['email'];
		$data['pwd'] = md5($_POST['pwd']);
		$data['status']=$_POST['status'];
		$data['real_name'] = $_POST['real_name'];
		$data['account_type']=$_POST['account_type'];
		$data['account_name'] = $_POST['account_name'];
		
		$condition1['name'] = $_POST['name'];
		$condition2['email'] = $_POST['email'];
		$select1=$User->where($condition1)->count();
		$select2=$User->where($condition2)->count();
		if($select1!=0)
		{
			$this->assign("jumpUrl","newUser");
			$this->error("用户名已被注册，请重新输入用户名");
		}
		elseif($select2!=0)
		{
			$this->assign("jumpUrl","newUser");
			$this->error("邮箱已被注册，请重新输入邮箱");
		}
        elseif($User->create()) 
		{
			do
			{
				$userID = date('mdHis',time()).rand(10000,99999);
			}while($User->where('id='.$userID)->count());
			$data['id'] = $userID;
			$result =  $User->add($data);
            if($result) {
				$this->assign("jumpUrl","userManage");
				$this->success("操作成功");
            }else{
                $this->assign("jumpUrl","newUser");
                $this->error("操作失败，请重试");
            }
        }else
		{
            $this->assign("jumpUrl","newUser");
            $this->error("操作失败，请重试");
        }
	}
	//账户充值
	public function accountIncrease(){

		$user = M('user');
		$condition['id']=$_POST['button'];
		$userInfo = $user->where($condition)->find();
		$this->assign('userInfo',$userInfo);
		$this->display();
    }
	public function accountChange(){
	
		if($_SESSION['name']!=""){
				
			$user = M('user');
			$condition['id']=$_POST['userID'];
			$nowAccount=$user->where($condition)->getField('account');
			$data['account']=$_POST['accountIncrease']+$nowAccount;
			if($user->where($condition)->save($data))
			{
				$this->redirect("__APP__/UserManage/userManage","",0,"修改成功"); 
			} 
			else
			{
				$this->display('UserManage/userManage');
			}
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        } 

	}
	//删除用户
	public function deleteUser($userID=""){

		$user = M('user');
		$condition['id']=$userID;
		if($user->where($condition)->delete()){
		
			$this->assign("jumpUrl","__APP__/UserManage/userManage");
			$this->success("删除成功");
			//$this->redirect('User/myOrder','',0,'删除成功');
		}else{
			$this->assign("jumpUrl","__APP__/UserManage/userManage");
			$this->error("删除失败，请重新操作");
		}
    }
	//进入用户审核页面
	public function userApprove($userID=""){

		$user = M('user');
		$condition['id']=$userID;
		$userInfo = $user->where($condition)->find();
		$this->assign('userInfo',$userInfo);
		$this->display();
    }
	//审核通过
	public function approvePass($userID=""){

		$user = M('user');
		$condition['id']=$userID;
		$data['identity']="已审核";
		if($user->where($condition)->save($data))
		{
			$this->redirect("__APP__/UserManage/userManage","",0,"修改成功"); 
		} 
		else
		{
			$this->display('UserManage/userManage');
		}
    }
	//审核不通过
	public function approveReject(){

		$user = M('user');
		$condition['id']=$_POST['userID'];
		$data['note']=$_POST['note'];
		$data['identity']="已拒绝";
		if($user->where($condition)->save($data))
		{
			$this->redirect("__APP__/UserManage/userManage","",0,"修改成功"); 
		} 
		else
		{
			$this->display('UserManage/userManage');
		}
    }
    
}  
?>
