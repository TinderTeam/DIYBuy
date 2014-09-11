<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class ProcessingAction extends Action {
    
    public function startGroup(){
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
    

   public function processing(){
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
        $Page = new Page($count,10);  // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); 
                                                               
        $list = $db->order("time_start desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('productinfo',$list); // 赋值数据集
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
            //$savepath = $info[0]['savepath'];  
            //$aa = $savepath.$savename;  
            //dump($aa);   
            //dump($imgurl);  
            $product->name = $_POST['name'];    
            //$data['publishtime'] = date("Y-m-d H:i:s");  
            $res = $product->add();//写入数据库   
            if ($res){  
                $this->redirect("Processing/startGroup","",2,"OK");  
            }else{  
                $this->redirect("Admin/login","",2,"Fuck");  
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
		public function groupDetails()
		{
			require './home/Lib/Action/Public.php';
			$db = M('product');
			$select=$db->where('id='.$_GET['id'])->select();
			$this->assign('groupInfo',$select); 
			$this->display(groupDetails);
			
		}
	    public function join()
		{
			$db = M('product');
			$presentNum = $db->where('id='.$_GET['id'])->getField('current_num');	

			$data['current_num']=$presentNum+1;
			$result=$db->where('id='.$_GET['id'])->save($data);
	
		if($result)
			{
				$this->redirect('Processing/processing','',0,'加入成功!');
			}
		}
}
?>