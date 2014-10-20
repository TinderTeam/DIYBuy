<?php
header("Content-Tyoe:text/html;charset=utf-8");

class ADManageAction extends Action{
    
    // 显示广告管理页面
    public function adManage(){
        if($_SESSION['name']!="admin"){
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
	//上传广告
	public function updateAD(){  
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
            $ad   =   M('ad');
            $condition['Id']=$_POST['Id'];
            $data['imgname']=$info[0]['savename'];
			$data['name']=$_POST['name'];
			$data['url']=$_POST['url'];
			$data['price']=$_POST['price'];
			$data['note']=$_POST['note'];
            $result=$ad->where($condition)->save($data);
			if($result!==false)
			{
				$this->assign("jumpUrl","__APP__/ADManage/adManage");
				$this->success("操作成功");
			} 
			else
			{
				$this->assign("jumpUrl","__APP__/ADManage/adManage");
				$this->error("操作失败，请重新提交");
			}     
    }
}  
?>
