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
    
    
    public function productInfo(){
        
        if($_SESSION['name']!=""){
            $this->display();
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
  
            $product   =   M('product');

             $product->pic1 = $info[0]['savename'];   
            //$data['publishtime'] = date("Y-m-d H:i:s");  
            $res = $product->add();//写入数据库   
            if ($res){  
                $this->redirect("Admin/upload","",2,"OK");  
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
        $User = M("product"); // 实例化product对象
        $User->where('id=5')->delete(); // 删除id为5的用户数据
        $User->delete('1,2,5'); // 删除主键为1,2和5的用户数据
        $User->where('status=0')->delete(); //删除所有状态为0的用户数据
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
