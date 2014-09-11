<?php
// 本类由系统自动生成，仅供测试用途
header("Content-Type:text/html; charset=UTF-8");
class PurchaseAction extends Action {
    public function productDetails(){

	    $this->display();
    }
    
    public function orderList(){


	    $this->display();
    }
    
    public function orderPay(){


	    $this->display();
    }
	
    public function generateOrder(){
		$db = M('product');
		$select=$db->where('id='.$_GET['id'])->select();
		$this->assign('orderInfo',$select); 
		$this->display('orderList');
    }

}
?>