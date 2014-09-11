<?php
//require 'init.inc.php';
/* $c = M('config');	//网站配置
$l = M('cate');		//网站栏目
$a = M('link');		//友情链接
$gs = M('Company');	//公司配置
$q = M('qq');		//客服QQ

//公共查询
$config = checkTrip($c->find());
$cate = checkTrip($l->order('px asc')->select());
$link = checkTrip($a->where('l_status=1')->select());
$company = checkTrip($gs->find());
$qq = checkTrip($q->find());


//分配变量
$this->assign(array(
	'config' => $config,
	'cate' => $cate,
	'link' => $link,
	'company' => $company,
	'qq' => $qq
)); */
	    $db = M('product');
        import("ORG.Util.Page"); 
        $count = $db->count();
		
 		//mysql_query("set names utf-8");
		
		$Page2 = new Page($count,10);  // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page2->show(); 

		
		$list2 = $db->where('status='.'"组团中"')->order('total_num-current_num asc,id asc')->limit($Page2->firstRow.','.$Page2->listRows)->select();
                                                               
        //$list2 = $db->where('status='.'"组团中"')->order('id asc')->limit($Page2->firstRow.','.$Page2->listRows)->select();
        $this->assign('siderbarInfo',$list2); // 赋值数据集
        $this->assign('page2',$show); // 赋值分页输出
	   	
?>