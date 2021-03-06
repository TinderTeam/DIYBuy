<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class ProcessingAction extends Action {
    
    public function startGroup(){
	require './home/Lib/Action/Public.php';
       
		$User = M('user');
		$condition['name']=$_SESSION['name'];
		$userIdentity=$User->where($condition)->getField('identity');
		if($_SESSION['name']=="")
		{
			$this->assign("jumpUrl","__APP__/Index/login");
			$this->error("您还未登录，请先登录");
        }
		elseif($userIdentity=="已审核")
		{
			$this->display();			
		}
		else
		{
			$this->assign("jumpUrl","__APP__/User/userInfo");
			$this->error("请完善您的个人信息并提交审核，审核通过后方可发起组团");
		}

    }
    

   public function processing(){
   require './home/Lib/Action/Public.php';
                 
        //显示产品           
        $db = M('product');
        import("ORG.Util.Page");
		$condition2['time_end']=array('LT',date('Y-m-d H:i:s',time()));
		$dataFail['status']='组团失败';
		$db->where($condition2)->where('current_num<total_num AND status="组团中"')->save($dataFail);
		
        $count = $db->where('status="组团中" OR status="组团失败" OR status="议价中" OR status="议价成功" OR status="议价失败"')->count();
        $Page = new Page($count,20);  // 实例化分页类 传入总记录数和每页显示的记录数                                         
        $list = $db->where('status="组团中" OR status="组团失败" OR status="议价中" OR status="议价成功" OR status="议价失败"')->order("status asc")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('productinfo',$list); // 赋值数据集
		$show = $Page->show();
		$this->assign('page',$show); // 赋值分页输出
        $this->display();

    }  
    
    public function addChk(){  
            //导入图片上传类  
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
  
            //保存表单数据，包括上传的图片  
            $product = M("product");  
            $product->create();  
            $product->pic1 = $info[0]['savename']; 
            $product->pic2 = $info[1]['savename']; 
            $product->pic3 = $info[2]['savename'];
            $product->pic4 = $info[3]['savename'];
            $product->pic5 = $info[4]['savename'];
            $product->pic6 = $info[5]['savename'];

			$product->time_start = date('Y-m-d H:i:s',time());	//获取当前时间作为发起团购开始时间
            $user = M('user');
			$nameCondition['name'] = $_SESSION['name'];
			$userID = $user->where($nameCondition)->getField('id');
			$product->sponsor = $userID;
			
            $res = $product->add();//写入数据库   
            if ($res){  
                $this->assign("jumpUrl","Processing/processing");
				$this->success("成功提交");
				
            }else{  
                $this->assign("jumpUrl","Processing/processing");
				$this->error("提交失败，请重新发起组团"); 
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
	public function groupDetails(){
	
		require './home/Lib/Action/Public.php';
			
		$db = M('product');
		$select=$db->where('id='.$_GET['id'])->select();
		$this->assign('groupInfo',$select); 
		$this->display();
	
	}
	public function join(){
		
		$User = M('user');
		$condition['name']=$_SESSION['name'];
		$userIdentity=$User->where($condition)->getField('identity');
		
		if($_SESSION['name']==""){
		
			$this->assign("jumpUrl","__APP__/Index/login");
			$this->error("您还未登录，请先登录");
		}
		elseif($userIdentity=="已审核")
		{
			$user = M('user');
			$nameCondition['name'] = $_SESSION['name'];
			$userID = $user->where($nameCondition)->getField('id');
			$userIDCondition['userID'] = $userID ;
			$group_order = M('group_order');
			$group_order_count = $group_order->where($userIDCondition)->where('productID='.$_GET['id'])->count();

			//新建组团订单
			if($group_order_count==0)
			{
				//更新参团人数
				$db = M('product');
				$presentNum = $db->where('id='.$_GET['id'])->getField('current_num');
				$totalNum = $db->where('id='.$_GET['id'])->getField('total_num');
				if($totalNum==($presentNum+1))
				{
					$data['status']="议价中";
				}
				$data['current_num']=$presentNum+1;
				$result=$db->where('id='.$_GET['id'])->save($data);
				
				//新建组团订单
				$groupData['productID'] = $_GET['id'];
				$groupData['userID'] = $userID;
				$groupData['datetime'] = date('Y-m-d H:i:s',time());
				$group_order->add($groupData);
				
				$this->assign("jumpUrl","processing");
				$this->success("加入成功");
			}
			else
			{
				$this->assign("jumpUrl","processing");
				$this->error("您已参与组团，不能重复参与组团");
			}
		}
		else
		{
			$this->assign("jumpUrl","__APP__/User/userInfo");
			$this->error("请完善您的个人信息并提交审核，审核通过后方可加入组团");
		}
	}
}
?>