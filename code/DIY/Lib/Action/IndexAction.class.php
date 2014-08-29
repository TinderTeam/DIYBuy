<?php
class IndexAction extends Action {
    public function index(){
        $Admin = M('Admin'); // 实例化Data数据模型
        $this->Admin = $Admin->select();
        $this->display();
    }
}