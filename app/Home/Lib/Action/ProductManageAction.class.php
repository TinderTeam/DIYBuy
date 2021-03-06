<?php
header("Content-Tyoe:text/html;charset=utf-8");

class ProductManageAction extends Action{
    
	//显示团购产品列表
    public function productManage($product_filter=0){
        if($_SESSION['name']!="admin"){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
            $product = M('product');
            import("ORG.Util.Page");
			
			if($product_filter=='ongoing')
			{
				$productCount = $product->where('status="团购中"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$productList = $product->order('id')->where('status="团购中"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($product_filter=="success")
			{
				$productCount = $product->where('status="团购成功"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$productList = $product->order('id')->where('status="团购成功"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($product_filter=="fail")
			{
				$productCount = $product->where('status="团购失败"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$productList = $product->order('id')->where('status="团购失败"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			elseif($product_filter=="all")
			{
				$productCount = $product->where('status="团购中" OR status="团购成功" OR status="团购失败"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$productList = $product->order('id')->where('status="团购中" OR status="团购成功" OR status="团购失败"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			else
			{
				$productCount = $product->where('status="团购中"')->count();
				$Page = new Page($groupCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
				$show = $Page->show();
				$productList = $product->order('id')->where('status="团购中"')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			$product_filter='ongoing';		//设置初始值，如果重新点击商家中心，刷新页面，显示团购中产品
			
			$this->assign('productlist',$productList); // 赋值数据集
            $this->assign('page',$show); // 赋值分页输出
			
            $this->display();
        }
    }
	//新建团购产品,进入新建团购产品页面
	public function newProduct(){
		if($_SESSION['name']!="admin"){
            $this->redirect('Admin/login','',0,'你还没登陆');//页面重定向
        }else{
			$this->display();
		}
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
        		
        if($_SESSION['name']=="admin"){
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
            $data['name'] = $_POST['name'];
			$data['total_num'] = $_POST['total_num'];
			$data['price_original'] = $_POST['price_original'];
			$data['price_high'] = $_POST['price_high'];
			$data['price_low'] = $_POST['price_low'];
			$data['time_end'] = $_POST['time_end'];
			$data['status'] = $_POST['status'];
			$data['link_add'] = $_POST['link_add'];
			$data['describ'] = $_POST['describ'];
			
			//处理综合描述
			$text = $_POST['htmltext'];
			$text = str_replace('\"', '"',$text);
			$data['html_info']=$text;
			$result=$product->where($condition)->save($data);
			if($result!==false)
			{
				$this->assign("jumpUrl","__APP__/ProductManage/productManage");
				$this->success("修改成功");
			} 
			else
			{
			
				$this->assign("jumpUrl","__APP__/ProductManage/productManage");
				$this->error("修改失败,请重新修改");

			}   

    }
	//显示团购订单列表
	public function productOrder($productID=0){
		
		import("ORG.Util.Page");
		$IDcondition['productID'] = $productID;
		$orderView = M('order_view');
		$orderCount = $orderView->where($IDcondition)->where('orderStatus="已付款"')->count();
		$Page = new Page($orderCount,8);                     // 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();
		$orderList = $orderView->where($IDcondition)->where('orderStatus="已付款"')->select();
		$this->assign('orderList',$orderList); // 赋值数据集
        $this->assign('page',$show); // 赋值分页输出
		$this->display();
    }
   
    
}  
?>
