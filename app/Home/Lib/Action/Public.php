<?php

	    $db = M('product');
        import("ORG.Util.Page"); 
        $count = $db->count();
		$Page2 = new Page($count,10);  // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page2->show(); 
		$list2 = $db->where('status='.'"组团中"')->order('total_num-current_num asc,id asc')->limit(10)->select();                                                      
        $this->assign('siderbarInfo',$list2); // 赋值数据集
		
		
		
		$dbAD = M('ad');
        import("ORG.Util.Page"); 
        $countAD = $dbAD->where('position="页尾"')->count();
        $PageAD = new Page($countAD,8);  // 实例化分页类 传入总记录数和每页显示的记录数                                                     
        $listAD = $dbAD->where('position="页尾"')->order('Id asc')->limit(5)->select();
		$listADhead = $dbAD->where('position="页首"')->order('Id asc')->limit(1)->select();
        $this->assign('adinfo',$listAD); // 赋值数据集
		$this->assign('adheadinfo',$listADhead);
		//$this->assign('adheadinfo',$listAD);
		$show = $PageAD->show(); 	
		
	  
?>