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
        if($_SESSION['name']!=""){
            if($admin->create()){
                
                if($pwd==$password){
                    //$this->success($_POST['admin_name']);
                    $this->redirect('Admin/manage','',0,'登录成功');//页面重定向
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
	
	public function login(){
		$this->display();
	}
    public function accountModify(){
		$this->display();
	}
	public function modifyPassword(){
	
		$pwd=$_POST['pwd'];
		$oldpwd = $_POST['oldpwd'];
		$condition['name']=$_POST['name'];
		$admin   =   M('admin');
		$password = $admin->where($condition)->getField('pwd');
        $data['pwd']=$pwd;
		if($oldpwd==$password)
		{
			if($admin->create())
			{
				if($admin->where($condition)->save($data))
				{
					unset($_SESSION['name']);
					session_destroy();
					$this->assign("jumpUrl","__APP__/Admin/login");
					$this->success("修改成功，请重新登录");
					
					//$this->redirect("__APP__/Index/login","",0,"修改成功"); 
				} 
				else{
				
						$this->assign("jumpUrl","accountModify");
						$this->error("修改失败,请重新修改");

					}
				
			}else{
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
    public function accountIncrease(){

		$user = M('user');
		$condition['id']=$_POST['button'];
		$userInfo = $user->where($condition)->find();
		$this->assign('userInfo',$userInfo);
		$this->display();
    }
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
				//SendMail("market@fuego.cn","又来个账户咯","http://59.39.216.90:7000/DIYBuy/app/index.php/Purchase/productDetails?id=18 $name----华丽的分割线-----$pwd");
				$this->assign("jumpUrl","manage");
				$this->success("注册成功");
            }else{
                $this->assign("jumpUrl","newUser");
                $this->error("注册失败，请重试");
            }
        }else
		{
            $this->assign("jumpUrl","newUser");
            $this->error("注册失败，请重试");
        }
	}
	public function deleteUser($userID=""){

		$user = M('user');
		$condition['id']=$userID;
		if($user->where($condition)->delete()){
		
			$this->assign("jumpUrl","__APP__/Admin/manage");
			$this->success("删除成功");
			//$this->redirect('User/myOrder','',0,'删除成功');
		}else{
			$this->assign("jumpUrl","__APP__/Admin/manage");
			$this->error("删除失败，请重新操作");
		}
    }
	
    public function productInfo(){
        
        if($_SESSION['name']!=""){
			$db = M('product');
			$condition['id']=$_POST['button1'];
			$audit=$db->where($condition)->select();
			$this->assign('audit',$audit); // 赋值数据集
			$this->assign('pass',"pass");
			$this->assign('reject',"reject");
            $this->display();
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }      
    }
	
	public function audit($num=3){
		if($_SESSION['name']!=""){
            $db = M('product');
            if($num==1){
				$condition['id']=$_POST['button1'];
				$data['status']="组团中";
				$data['total_num']=$_POST['total_num'];
				if($db->create()){
					if($db->where($condition)->save($data)){
					$this->assign("jumpUrl","__APP__/Admin/product");
					$this->success("审核成功");
					//$this->redirect('Admin/product','',0,'成功');//页面重定向
					//$this->redirect("Admin/administrater","",1,"OK");
					} else{
						$this->assign("jumpUrl","__APP__/Admin/product");
						$this->error("审核失败，请重新提交");
						//$this->error('写入错误！');
					}
				}else{
					$this->assign("jumpUrl","__APP__/Admin/product");
					$this->error("审核失败，请重新提交");
					//$this->error('写入错误！');
				}
			}/* else if($num==2){
				$condition['id']=$_POST['button2'];
				$data['status']="不通过";
				if($db->create()){
					if($db->where($condition)->save($data)){
					$this->assign("jumpUrl","__APP__/Admin/product");
					$this->success("成功驳回");
					//$this->redirect('Admin/product','',0,'成功');//页面重定向
					//$this->redirect("Admin/administrater","",1,"OK");
					} else{
						$this->error('写入2B错误！');
					}
				}else{
					$this->error('写入错误！');
					//$this->error("保存错误！");
				}
            $this->display();
			} */
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        } 
	}
	
    
    // 用分页类 实现分页查询
    public function manage(){
        if($_SESSION['name']!=""){
            
			$db = M('user');
            import("ORG.Util.Page");
            $count = $db->count();
            //$count = $user->where($condition)->count();
            $Page = new Page($count,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show(); 
                                                           
            $list = $db->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('b',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
            $this->display();
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }       
    }
	public function accountChange(){
	
		if($_SESSION['name']!=""){
				
			$user = M('user');
			$condition['id']=$_POST['userID'];
			$nowAccount=$user->where($condition)->getField('account');
			$data['account']=$_POST['accountIncrease']+$nowAccount;
			if($user->where($condition)->save($data))
			{
				$this->redirect("__APP__/Admin/manage","",0,"修改成功"); 
				//$this->success('操作成功！');
				//$this->redirect("Admin/administrater","",1,"OK");
			} 
			else
			{
				$this->display('manage');
			}
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        } 

	}
    
    //退出登陆，清session
    public function logout(){
        session_start();
        unset($_SESSION['name']);
        session_destroy();
        $this->redirect('Admin/login','',0,'退出登陆成功！');
    }
    
    public function groupManage(){
        if($_SESSION['name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $db = M('product');
            import("ORG.Util.Page");

			// 产品管理页面数据读取
			$count = $db->where('status="待审核" OR status="不通过" OR status="组团中" OR status="组团失败" OR status="议价中" OR status="议价成功" OR status="议价失败"')->count();
			$Page = new Page($count,8);                     
            $show = $Page->show(); 
			$list = $db->where('status="待审核" OR status="不通过" OR status="组团中" OR status="组团失败" OR status="议价中" OR status="议价成功" OR status="议价失败"')->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('productlist',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
			
            $this->display();
        }
    }
	public function productManage(){
        if($_SESSION['name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $db = M('product');
            import("ORG.Util.Page");

			// 产品管理页面数据读取
			$count = $db->where('status="团购中" OR status="团购成功" OR status="团购失败"')->count();
			$Page = new Page($count,8);                     
            $show = $Page->show(); 
			$list = $db->where('status="团购中" OR status="团购成功" OR status="团购失败"')->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('productlist',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
			
            $this->display();
        }
    }
    
    public function ad(){
        if($_SESSION['name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $db = M('ad');
            import("ORG.Util.Page"); 
            $count = $db->count();
            //$count = $user->where($condition)->count();
            $Page = new Page($count,6);                     // 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show(); 
                                                           
            $list = $db->order('Id')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('adlist',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
            $this->display();
        }
    }
	
    public function upload(){
        if($_SESSION['name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $this->display();
        }
    }
	public function productRelease(){
		if($_SESSION['name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $db = M('product');
            import("ORG.Util.Page");

			// 产品管理页面数据读取
			$count = $db->where('status="议价成功"')->count();
			$Page = new Page($count,4);                     
            $show = $Page->show(); 
			$list = $db->where('status="议价成功"')->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('productlist',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
			
			// 产品审核页面数据读取
			$condition2['status']="待审核";
			$count2= $db->where($condition2)->count();
            $Page2 = new Page($count2,4);                     // 实例化分页类 传入总记录数和每页显示的记录数
            $show2 = $Page2->show(); 
			$list2 = $db->order('id')->where($condition2)->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('productlist2',$list2); // 赋值数据集
            $this->assign('page2',$show2); // 赋值分页输出
			
            $this->display();
        }
    }
	 public function releaseToGroup(){
        		
        if($_SESSION['name']!=""){
			$productRelease = M('product');
			$condition['id']=$_POST['button'];
			$releaseProduct=$productRelease->where($condition)->select();
			$this->assign('releaseProduct',$releaseProduct); // 赋值数据集
            $this->display();
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }      
    }
    public function releaseSubmit(){
	
		if($_SESSION['name']!=""){
				
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
                $this->error($upload->getErrorMsg());  
            }else{
                //上传成功，获取上传信息  
            $info = $upload->getUploadFileInfo();
            } 

			$product = M('product');
			$condition['id']=$_POST['button'];
			
			$data['name']=$_POST['name'];
			$data['total_num']=$_POST['total_num'];
			$data['price_orginal']=$_POST['price_orginal'];
			$data['price_high']=$_POST['price_high'];
			$data['price_low']=$_POST['price_low'];
			$data['time_end']=$_POST['time_end'];
			$data['status']=$_POST['status'];
			$data['pic1'] = $info[0]['savename'];
			$data['pic2'] = $info[1]['savename'];
			$data['pic3'] = $info[2]['savename'];
			$data['pic4'] = $info[3]['savename'];
			$data['pic5'] = $info[4]['savename'];
			$data['pic6'] = $info[5]['savename'];
			$data['time_start']=date('Y-m-d H:i:s',time());	//获取当前时间作为发起团购开始时间

			if($product->where($condition)->save($data))
			{
				$this->redirect("__APP__/Admin/productRelease","",0,"修改成功"); 
				//$this->success('操作成功！');
				//$this->redirect("Admin/administrater","",1,"OK");
			} 
			else
			{
				$this->display('productRelease');
			}
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        } 

	}
    public function addChk(){  
            //导入图片上传类  
            import("ORG.Net.UploadFile");  
            //实例化上传类  
            $upload = new UploadFile();  
            $upload->maxSize = 4145728;  
            //设置文件上传类型  
            $upload->allowExts = array('jpg','gif','png','jpeg');  
            //设置文件上传位置  
            $upload->savePath = "./Public/Uploads/";//这里说明一下，由于ThinkPHP是有入口文件的，所以这里的./Public是指网站根目录下的Public文件夹  
            //设置文件上传名(按照时间)  
            //$upload->saveRule = "time";  
            if (!$upload->upload()){  
                $this->error($upload->getErrorMsg());  
            }else{  
                //上传成功，获取上传信息  
                $info = $upload->getUploadFileInfo();  
            }  
  
            $product = M('product');
			$product->create();  
            $data['name'] = $_POST['name'];
			$data['total_num'] = $_POST['total_num'];
			$data['price_original'] = $_POST['price_original'];
			$data['price_high'] = $_POST['price_high'];
			$data['price_low'] = $_POST['price_low'];
			$data['time_end'] = $_POST['time_end'];
			$data['status'] = $_POST['status'];
			$data['link_add'] = $_POST['link_add'];
			$data['describ'] = $_POST['describ'];
			$data['pic1'] = $info[0]['savename']; 
			$data['time_start'] = date('Y-m-d H:i:s',time());	//获取当前时间作为发起团购开始时间
            $res = $product->add($data);//写入数据库      
            if ($res){  
                $this->redirect("Admin/productManage","",0,"OK");  
            }else{  
                $this->redirect("Admin/login","",2,"error");  
            } 
    }
    
    
    public function editChk(){  
            //导入图片上传类  
            import("ORG.Net.UploadFile");  
            //实例化上传类  
            $upload = new UploadFile();  
            $upload->maxSize = 4145728;  
            //设置文件上传类型  
            $upload->allowExts = array('jpg','gif','png','jpeg');  
            //设置文件上传位置  
            $upload->savePath = "./Public/Uploads/";//这里说明一下，由于ThinkPHP是有入口文件的，所以这里的./Public是指网站根目录下的Public文件夹  
            //设置文件上传名(按照时间)  
            //$upload->saveRule = "time";  
            if (!$upload->upload()){  
                $this->error($upload->getErrorMsg());  
            }else{  
                //上传成功，获取上传信息  
                $info = $upload->getUploadFileInfo();  
            }  
  
            //保存表单数据，包括上传的图片  
            //保存表单数据，包括上传的图片  
            $ad   =   M('ad');
            $condition['Id']=$_POST['Id'];
            $data['imgname']=$info[0]['savename'];
             
            
            if($ad->create()){
                $result =   $ad->save();
                if($result) {
					if($ad->where($condition)->save($data)){
                    $this->success('操作成功！');
                    //$this->redirect("Admin/administrater","",1,"OK");
					} else{
						$this->error('写入2B错误！');
					}
                }else{
                    $this->error('写入错误！');
                    //$this->error("保存错误！"); 
                }
            }else{
                $this->error($ad->getError());
            }      
    }
	
    public function read($id=0){
        $Form   =   M('erp');
        // 读取数据
        $data =   $Form->find($id);
        if($data){
            $this->data =   $data;// 模板变量赋值
        }else{
            $this->error('数据错误');
        }
        $this->display(editinfo);
    }
    
    public function deletUser(){
        $User = M("user"); // 实例化User对象
        $User->where('id=5')->delete(); // 删除id为5的用户数据
        $User->delete('1,2,5'); // 删除主键为1,2和5的用户数据
        $User->where('status=0')->delete(); // 删除所有状态为0的用户数据
    }
    
    public function deletAdmin(){
        $User = M("admin"); // 实例化admin对象
        $User->where('id=5')->delete(); // 删除id为5的用户数据
        $User->delete('1,2,5'); // 删除主键为1,2和5的用户数据
        $User->where('status=0')->delete(); //删除所有状态为0的用户数据
    }
    
    public function deletProduct(){
        $product = M("product"); // 实例化product对象
		$condition['id']=$_POST['button'];
		if($product->where($condition)->delete()){// 删除id为5的用户数据
			$this->success("删除成功！");
		}else{
			$this->error("删除失败！");
		}
        //$product->delete('1,2,5'); // 删除主键为1,2和5的用户数据
        //$product->where('status=0')->delete(); //删除所有状态为0的用户数据
    }
    
    public function update(){
        $Form   =   D('erp');
        if($Form->create()) {
            $result =   $Form->save();
            if($result) {
                $this->success('操作成功！');
            }else{
                $this->error('写入错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }
    
    public function insert(){        
        $Erp   =   M('erp');
        if($Erp->create()) {
            $result =   $Erp->add();
            if($result) {
                $this->success('保存成功！');
            }else{
                $this->error('写入错误！');
            }
        }else{
            $this->error($Erp->getError());
        }
    }
    
    public function edit($id=0){
        $Form   =   M('erp');
        $this->vo   =   $Form->find($id);
        $this->display();
    }
    
}  
?>
