<?php
header("Content-Tyoe:text/html;charset=utf-8");

class GroupManageAction extends Action{
	//显示组团产品列表
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
	//编辑组团信息，进入编辑页面
	public function editGroup(){
        		
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
	//更新数据库组团信息
	public function updateGroup(){
	
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
			$data['link_add']=$_POST['link_add'];
			$data['time_end']=$_POST['time_end'];
			$data['describ']=$_POST['describ'];
			$data['comment']=$_POST['comment'];
			$data['pic1'] = $info[0]['savename'];
			$data['pic2'] = $info[1]['savename'];
			$data['pic3'] = $info[2]['savename'];
			$data['pic4'] = $info[3]['savename'];
			$data['pic5'] = $info[4]['savename'];
			$data['pic6'] = $info[5]['savename'];

			if($product->where($condition)->save($data))
			{
				$this->redirect("__APP__/GroupManage/groupManage","",0,"修改成功"); 
			} 
			else
			{
				$this->display('groupManage');
			}
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        } 

	}
	//删除组团产品信息
	public function deleteGroup($groupID=""){
        $product = M("product"); // 实例化product对象
		$condition['id']=$groupID;
		if($product->where($condition)->delete()){
			$this->success("删除成功！");
		}else{
			$this->error("删除失败！");
		}
    }
	//进入组团审核页面
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
	//组团审核提交
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
	//进入产品发布页面
	public function releaseToProduct(){
        
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
	//提交将要发布的产品信息到数据库
    public function submitProduct(){
	
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
				$this->redirect("__APP__/GroupManage/groupManage","",0,"修改成功"); 
			} 
			else
			{
				$this->display('GroupManage/groupManage');
			}
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        } 

	}
	

}  
?>
