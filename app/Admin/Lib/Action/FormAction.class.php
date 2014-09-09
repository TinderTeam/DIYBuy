<?php
class FormAction extends Action {
    
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