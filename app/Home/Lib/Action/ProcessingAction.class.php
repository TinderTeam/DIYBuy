<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class ProcessingAction extends Action {
    
    public function startGroup(){


	    $this->display();
    }
    

   public function processing(){
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
            $savename = $info[0]['savename'];  
            //$savepath = $info[0]['savepath'];  
            //$aa = $savepath.$savename;  
            //dump($aa);  
            $img_name = $savename;//  
            //dump($imgurl);  
            $data['name'] = $_POST['name'];  
            $data['pic1'] = $img_name;   
            //$data['publishtime'] = date("Y-m-d H:i:s");  
            $res = $product->add($data);//写入数据库   
            if ($res){  
                $this->redirect("Admin/info","",2,"OK");  
            }else{  
                $this->redirect("Admin/login","",2,"Fuck");  
            } 
    }  

}
?>