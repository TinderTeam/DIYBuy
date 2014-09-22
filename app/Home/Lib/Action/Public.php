<?php

	    $dbSider = M('product');
        import("ORG.Util.Page"); 
        $countSider = $dbSider->count();
		$PageSider = new Page($countSider,10);  // 实例化分页类 传入总记录数和每页显示的记录数
        $showSider = $PageSider->show(); 
		$listSider = $dbSider->where('status="组团中" AND total_num>current_num')->order('total_num-current_num asc,id asc')->limit(10)->select();                                                      
        $this->assign('siderbarInfo',$listSider); // 赋值数据集
		
		
		
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