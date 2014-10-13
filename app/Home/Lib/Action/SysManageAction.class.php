<?php
header("Content-Tyoe:text/html;charset=utf-8");

class sysManageAction extends Action{
    
	//新增用户
	public function sysManage(){
		$SysDB = M('sys');
		$syshtmlCondition['key']='note_html';
		$context = $SysDB->where($syshtmlCondition)->find();
		
		$sysPhoneCondition['key']='phone';
		$phone = $SysDB->where($sysPhoneCondition)->find();
		
		$sysEmailCondition['key']='email';
		$email = $SysDB->where($sysEmailCondition)->find();
		
		$sysWorkTimeCondition['key']='work_time';
		$work_time = $SysDB->where($sysWorkTimeCondition)->find();
		
		$sysTaobaoCondition['key']='taobao';
		$taobao = $SysDB->where($sysTaobaoCondition)->find();
		
		$sysPaipaiCondition['key']='paipai';
		$paipai = $SysDB->where($sysPaipaiCondition)->find();
		
		$this->assign('context',$context['value']);
		$this->assign('phone',$phone['value']);
		$this->assign('email',$email['value']);
		$this->assign('work_time',$work_time['value']);
		$this->assign('taobao',$taobao['value']);
		$this->assign('paipai',$paipai['value']);
		
		$this->display();
    }
	
	public function updateDesc(){
		$SysDB = M('sys');
		$sysCondition['key']='note_html';
		$text = str_replace('\"', '"',$_POST['text']);
		$data['value']=$text;
		$context = $SysDB->where($sysCondition)->save($data);
		$this->assign('context',$context['value']); // 赋值分页输出
		$this->assign("jumpUrl","sysManage");
		$this->success("修改成功");
	}
	public function updateInfo(){
		
		$phone = $_POST['phone'];
		$email	 = $_POST['email'];
		$worktime = $_POST['worktime'];
		$taobao = $_POST['taobao'];
		$paipai = $_POST['paipai'];
		
		$SysDB = M('sys');
		$sysPhoneCondition['key']='phone';
		$dataphone['value']=$phone;
		$phone = $SysDB->where($sysPhoneCondition)->save($dataphone);
		
		$sysEmailCondition['key']='email';
		$dataEmail['value']=$email;
		$email = $SysDB->where($sysEmailCondition)->save($dataEmail);
		
		$sysWorkTimeCondition['key']='work_time';
		$dataWorkTime['value']=$worktime;
		$work_time = $SysDB->where($sysWorkTimeCondition)->save($dataWorkTime);
		
		$sysTaobaoCondition['key']='taobao';
		$datataobao['value']=$taobao;
		$taobao = $SysDB->where($sysTaobaoCondition)->save($datataobao);
		
		$sysPaipaiCondition['key']='paipai';
		$datapaipai['value']=$paipai;
		$paipai = $SysDB->where($sysPaipaiCondition)->save($datapaipai);
		
		$this->assign("jumpUrl","sysManage");
		$this->success("修改成功");
	}
}  
?>
