<?php
header("Content-Type:text/html; charset=UTF-8");
class PublicAction extends Action {
     Public function verify(){
        import('ORG.Util.Image');
        ob_end_clean();//关键
        Image::buildImageVerify(4,5,'jpg','65','30','verfify');
        output($im, $type='png', $filename='c:\b\verify.png'); 
    }
}

?>