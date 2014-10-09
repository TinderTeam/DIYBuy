<?php
header("Content-Tyoe:text/html;charset=utf-8");

class ProductManageAction extends Action{
    
	//显示团购产品列表
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
	//新建团购产品,进入新建团购产品页面
	public function newProduct(){
		$this->display();
    }
	//提交新建团购产品到数据库
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
			
			//处理综合描述
			$text = $_POST['htmltext'];
			$text = str_replace('\"', '"',$text);
			$data['html_info']=$text;
			$data['time_start'] = date('Y-m-d H:i:s',time());	//获取当前时间作为发起团购开始时间
            $res = $product->add($data);//写入数据库      
            if ($res){  
                $this->redirect("ProductManage/productManage","",0,"OK");  
            }else{  
                $this->redirect("Admin/login","",2,"error");  
            } 
    }
	//编辑团购信息，进入编辑页面
	public function editProduct(){
        		
        if($_SESSION['name']!=""){
			$editProduct = M('product');
			$condition['id']=$_POST['button'];
			$productEdit=$editProduct->where($condition)->find();
			$this->assign('productEdit',$productEdit); // 赋值数据集
            $this->display();
        }else{
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }      
    }
	//提交编辑后的团购产品到数据库
	public function updateProduct(){  
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
			$condition['id']=$_POST['productID'];
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
   
    
}  
?>
