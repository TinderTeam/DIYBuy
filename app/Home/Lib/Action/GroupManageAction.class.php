<?php
header("Content-Tyoe:text/html;charset=utf-8");

class GroupManageAction extends Action{
	//显示组团产品列表
    public function groupManage($group_filter=0){
        if($_SESSION['name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $group = M('product');
            import("ORG.Util.Page");
			
			if($group_filter=='toApprove')
			{
				$groupCount = $group->where('status="待审核"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$groupList = $group->order('id')->where('status="待审核"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($group_filter=="Rejected")
			{
				$groupCount = $group->where('status="已驳回"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$groupList = $group->order('id')->where('status="已驳回"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($group_filter=="inGroup")
			{
				$groupCount = $group->where('status="组团中"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$groupList = $group->order('id')->where('status="组团中"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($group_filter=='groupFail')
			{
				$groupCount = $group->where('status="组团失败"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$groupList = $group->order('id')->where('status="组团失败"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($group_filter=='inBargain')
			{
				$groupCount = $group->where('status="议价中"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$groupList = $group->order('id')->where('status="议价中"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($group_filter=='bargainOK')
			{
				$groupCount = $group->where('status="议价成功"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$groupList = $group->order('id')->where('status="议价成功"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($group_filter=='bargainNG')
			{
				$groupCount = $group->where('status="议价失败"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$groupList = $group->order('id')->where('status="议价失败"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($group_filter=='all')
			{
				$groupCount = $group->where('status="待审核" OR status="不通过" OR status="组团中" OR status="组团成功" OR status="组团失败" OR status="议价中" OR status="议价成功" OR status="议价失败"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$groupList = $group->order('id')->where('status="待审核" OR status="不通过" OR status="组团中" OR status="组团成功" OR status="组团失败" OR status="议价中" OR status="议价成功" OR status="议价失败"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			else
			{
				$groupCount = $group->where('status="待审核"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$groupList = $group->order('id')->where('status="待审核"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
	
			$user_filter='toApprove';		//设置初始值，如果重新点击商家中心，刷新页面，显示所有订单
			
			$this->assign('productlist',$groupList); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
			
            $this->display();
        }
    }
	//编辑组团信息，进入编辑页面
	public function editGroup(){
        		
        if($_SESSION['name']!=""){
			$productRelease = M('product');
			$condition['id']=$_POST['button'];
			$releaseProduct=$productRelease->where($condition)->find();
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
                //$this->error($upload->getErrorMsg());  
            }else{
                //上传成功，获取上传信息  
            $info = $upload->getUploadFileInfo();
            } 

			$product = M('product');
			$condition['id']=$_POST['button'];
			
			if($info[0]['savename']!=""){
				$data['pic1'] = $info[0]['savename'];
				
			}
			if($info[1]['savename']!=""){
				$data['pic2'] = $info[1]['savename'];
			}
			if($info[2]['savename']!=""){
				$data['pic3'] = $info[2]['savename'];
			}
			if($info[3]['savename']!=""){
				$data['pic4'] = $info[3]['savename'];
			}
			if($info[4]['savename']!=""){
				$data['pic5'] = $info[4]['savename'];
			}
			if($info[5]['savename']!=""){
				$data['pic6'] = $info[5]['savename'];
			}
			
			$data['status']=$_POST['status'];
			$data['name']=$_POST['name'];
			$data['total_num']=$_POST['total_num'];
			$data['price_orginal']=$_POST['price_orginal'];
			$data['price_high']=$_POST['price_high'];
			$data['link_add']=$_POST['link_add'];
			$data['time_end']=$_POST['time_end'];
			$data['describ']=$_POST['describ'];
			$data['comment']=$_POST['comment'];
			$result=$product->where($condition)->save($data);
			if($result!==false)
			{
				$this->assign("jumpUrl","__APP__/GroupManage/groupManage");
				$this->success("操作成功");
			} 
			else
			{
				$this->assign("jumpUrl","__APP__/GroupManage/groupManage");
				$this->error("操作失败，请重新提交");
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
	 public function releaseToGroup($groupID=""){
        		
        if($_SESSION['name']!=""){
			$productRelease = M('product');
			$condition['id']=$groupID;
			$releaseProduct=$productRelease->where($condition)->select();
			$this->assign('releaseProduct',$releaseProduct); // 赋值数据集
            $this->display();
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }      
    }
	//组团审核提交
	public function groupSubmit(){
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
            //上传成功，获取上传信息  
            if (!$upload->upload()){
                //$this->error($upload->getErrorMsg());  
            }else{
				$info = $upload->getUploadFileInfo();
			}
			$group = M('product');
			$condition['id']=$_POST['id'];
			
			if($info[0]['savename']!=""){
				$data['pic1'] = $info[0]['savename'];
				
			}
			if($info[1]['savename']!=""){
				$data['pic2'] = $info[1]['savename'];
			}
			if($info[2]['savename']!=""){
				$data['pic3'] = $info[2]['savename'];
			}
			if($info[3]['savename']!=""){
				$data['pic4'] = $info[3]['savename'];
			}
			if($info[4]['savename']!=""){
				$data['pic5'] = $info[4]['savename'];
			}
			if($info[5]['savename']!=""){
				$data['pic6'] = $info[5]['savename'];
			}
			if(isset($_POST['Pass'])){
				$data['status']="组团中";
				$data['note']="";
			}
			if(isset($_POST['Reject'])){
				$data['status']="已驳回";
				$data['note']=$_POST['note'];
			}
			$data['name']=$_POST['name'];
			$data['total_num']=$_POST['total_num'];
			$data['price_orginal']=$_POST['price_orginal'];
			$data['price_high']=$_POST['price_high'];
			$data['link_add']=$_POST['link_add'];
			$data['time_end']=$_POST['time_end'];
			$data['describ']=$_POST['describ'];
			$data['comment']=$_POST['comment'];

			if($group->create()){
				if($group->where($condition)->save($data)){
				$this->assign("jumpUrl","__APP__/GroupManage/groupManage");
				$this->success("操作成功");
				} else{
					$this->assign("jumpUrl","__APP__/GroupManage/groupManage");
					$this->error("操作失败，请重新提交");
				}
			}else{
				$this->assign("jumpUrl","__APP__/GroupManage/groupManage");
				$this->error("操作失败，请重新提交");
			}
			
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        } 
	}
	//进入产品发布页面
	public function releaseToProduct($groupID=0){
        
        if($_SESSION['name']!=""){
			$group = M('product');
			$condition['id']=$groupID;
			$productRelease=$group->where($condition)->find();
			$this->assign('productRelease',$productRelease); // 赋值数据集
            $this->display();
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }      
    }
	//提交将要发布的产品信息到数据库
    public function submitProduct(){
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
                //$this->error($upload->getErrorMsg());  
            }else{  
                //上传成功，获取上传信息  
                $info = $upload->getUploadFileInfo();  
            }  
	
            $product = M('product');
			$condition['id']=$_POST['productID'];
			
			if($info[0]['savename']!=""){
				$data['pic1'] = $info[0]['savename'];
				
			}
			$data['current_num']=0;
            $data['name'] = $_POST['name'];
			$data['total_num'] = $_POST['total_num'];
			$data['price_original'] = $_POST['price_original'];
			$data['price_high'] = $_POST['price_high'];
			$data['price_low'] = $_POST['price_low'];
			$data['time_end'] = $_POST['time_end'];
			$data['status'] = "团购中";
			$data['link_add'] = $_POST['link_add'];
			$data['describ'] = $_POST['describ'];
			
			//处理综合描述
			$text = $_POST['htmltext'];
			$text = str_replace('\"', '"',$text);
			$data['html_info']=$text;

			if($product->create())
			{
				if($product->where($condition)->save($data))
				{
					$this->assign("jumpUrl","__APP__/ProductManage/productManage");
					$this->success("修改成功");
				} 
				else{
				
						$this->assign("jumpUrl","__APP__/ProductManage/productManage");
						$this->error("修改失败,请重新修改");

					}
				
			}else{
				$this->assign("jumpUrl","__APP__/ProductManage/productManage");
				$this->error("修改失败,请重新修改");
			}     

    }
	//显示组团订单列表
	public function groupOrder($groupID=0){
		
		import("ORG.Util.Page");
		$IDcondition['productID'] = $groupID;
		$groupOrderView = M('group_order_view');
		$grouporderCount = $groupOrderView->where($IDcondition)->count();
		$Page = new Page($grouporderCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();
		$groupOrderList = $groupOrderView->where($IDcondition)->select();
		$this->assign('groupOrderList',$groupOrderList); // 赋值数据集
        $this->assign('page',$show); // 赋值分页输出
		$this->display();
    }
	

}  
?>
