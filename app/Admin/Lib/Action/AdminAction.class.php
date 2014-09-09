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
    
    //退出登陆，清session
    public function logout(){
        session_start();
        unset($_SESSION['name']);
        session_destroy();
        $this->redirect('Admin/login','',0,'退出登陆成功！');
    }
    
    public function product(){
        if($_SESSION['name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $db = M('product');
            import("ORG.Util.Page"); 
            $count = $db->count();
            //$count = $user->where($condition)->count();
            $Page = new Page($count,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show(); 
                                                           
            $list = $db->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('productlist',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
            $this->display(product);
        }
    }
    
    public function administrater(){
        if($_SESSION['name']==""){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $db = M('admin');
            import("ORG.Util.Page"); 
            $count = $db->count();
            //$count = $user->where($condition)->count();
            $Page = new Page($count,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show(); 
                                                           
            $list = $db->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('adminlist',$list); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
            $this->display(administrater);
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
            $upload->saveRule = "time";  
            if (!$upload->upload()){  
                $this->error($upload->getErrorMsg());  
            }else{  
                //上传成功，获取上传信息  
                $info = $upload->getUploadFileInfo();  
            }  
  
            //保存表单数据，包括上传的图片  
            $product = M("product");  
            $product->create();    
            //$savepath = $info[0]['savepath'];  
            //$aa = $savepath.$savename;  
            //dump($aa);   
            //dump($imgurl);  
             $product->pic1 = $info[0]['savename'];   
            //$data['publishtime'] = date("Y-m-d H:i:s");  
            $res = $product->add();//写入数据库   
            if ($res){  
                $this->redirect("Admin/info","",2,"OK");  
            }else{  
                $this->redirect("Admin/login","",2,"error");  
            } 
    }
    
}  
?>
