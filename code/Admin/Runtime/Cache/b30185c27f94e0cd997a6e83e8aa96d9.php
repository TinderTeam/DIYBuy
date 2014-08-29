<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en">
<meta http-equiv="Reply-to" content="@.com">
<meta name="generator" content="PhpED 8.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="creation-date" content="09/06/2012">
<meta name="revisit-after" content="15 days">
<title>DIY团网站后台管理系统</title>
    <style type="text/css"> 
    /*基本信息*/
    body {
    font: 20px Tahoma;
    margin: 0px auto;
    text-align: left;
    background: #FFF;
    word-spacing: normal;
    border: thin ridge #09C;
    left: 0px;
}
    /*页面层容器*/
    #Container {width:100%;}
    
    /*页面头部*/
    #Header {width:100%;margin:0 auto;height:80px;background:#5B5B5B;border:1px solid #E0E0E0;padding:3px; }
    
    /*头部主题*/
    #HeaderTitle {width:60%;margin:25px 30px auto;height:40px;background:#5B5B5B;float:left}
    
    /*头部当前用户名*/
    #HeaderName {width:12%;margin:25px 12px auto;height:20px;background:#5B5B5B;float:left}   

    /*退出登陆*/
    #HeaderButton {width:10%;margin:25px 12px auto;height:20px;background:#5B5B5B;float:left} 
    
    /*页面主体*/
    #PageBody {width:100%;margin:0 auto;height:800px;background:#FFF;}
       
    /*左侧导航条*/
    #LeftNav {width:15%;margin:0 auto;height:800px;background:#ECECFF;float:left;border:1px solid #7B7B7B;padding:3px;}
    
    #menu {width:225px;height:320px;background-color:#dee;padding:0px;margin:0px;} 
    
    /*去掉列表前的圆点*/
    #menu ul{width:225px;list-style-type:none;padding:0px;margin:0px; /*消除左侧间隙*/}
    #menu ul li{width:225px;/*填充满整个边栏*//*margin:0px;padding:0px;*/}
    #menu ul li a {display:block; /*先转化成块级元素*/
                    color:Gray;text-align:left;text-decoration:none;
                    padding:10px 0px 10px 30px;/*设置距离左侧的边栏和上边距*/
                    font-size:14px; }
    #menu ul li a:hover{
        color:Orange;
        text-align:left;
        text-decoration:none;
        padding:10px 0px 10px 30px;
        font-size:14px;}
        
    
    /*右侧内容*/
    #RightList {width:80%;margin:0 auto;height:800px;background:#FFF;float:left}
    
    /*会员列表*/
    #IdList {width:60%;margin:30px 10% auto;height:800px;background:#FFF;float:left}
    

    </style>
</head>
<body> 

<div id="Container">  <!--页面容器-->
    <div id="Header">  <!--页面头条-->
        <div id="HeaderTitle">
        <font color=#E0E0E0 size=5><b>DIY团&nbsp;&nbsp;&nbsp;&nbsp;网站后台管理系统</b></font>
        </div>
        
        <div id="HeaderName">
        <font color=#E0E0E0 size=2>当前登录用户：<?php echo (session('admin_name')); ?></font>
        </div>
        
        <div id="HeaderButton">
        <form action="__URL__/logout" method="POST" name="Form1" >
        <input type="submit" name="Submit" value="退出登陆">
        </form>
        </div>
    </div>
    
    <div id="PageBody">   <!--页面主体-->
        <div id="LeftNav">   <!--左侧导航-->
            <div id="Menu">
                <ul>
                <li><a href="__URL__/manage.html"><font color=#000 size=2><b>会员管理</b></font></a></li>
                <li><a href="#"><font color=#000 size=2><b>网页管理</b></font></a></li>
                <li><a href="__URL__/list.html"><font color=#000 size=2><b>产品列表</b></font></a></li>
                <li><a href="__URL__/upload.html"><font color=#000 size=2><b>新增产品</b></font></a></li>
                <li><a href="#"><font color=#000 size=2><b>联系我们</b></font></a></li>
                </ul>
            </div>
        </div>
        
        <div id="RightList">   <!--右侧内容-->
        <div id="IdList">
            <form name="form1" method="post"  action="__URL__/manage" onSubmit="return chkinput(this)" >
            <table width="405" border="1" cellpadding="2" cellspacing="2" bgcolor="#ADADAD" bordercolor="#ADADAD">
              <tr>
                <td colspan="5" bgcolor="#FFFFFF" class="title" align="center"><font face="黑体" color=#000 size=3>产品列表</font></td>
              </tr>
              <tr class="title">
                <td bgcolor="#FFFFFF" width="44"><font face="Times New Roman" color=#000 size=2>ID</font></td>
                <td bgcolor="#FFFFFF" width="120"><font face="宋体" color=#000 size=2><b>名字</b></font></td>
                <td bgcolor="#FFFFFF" width="223"><font face="宋体" color=#000 size=2><b>密码</b></font></td>
                <td bgcolor="#FFFFFF" width="223"><font face="宋体" color=#000 size=2><b>身份</b></font></td>
                <td bgcolor="#FFFFFF" width="250"><font face="宋体" color=#000 size=2><b>参团数量</b></font></td>
              </tr>
              <?php if(is_array($b)): foreach($b as $key=>$vo): ?><tr class="content">
                <td bgcolor="#FFFFFF">&nbsp;<font face="Times New Roman" color=#000 size=2><?php echo ($vo["user_id"]); ?></font></td>
                <td bgcolor="#FFFFFF">&nbsp;<font face="宋体" color=#000 size=2><?php echo ($vo["user_name"]); ?></font></td>
                <td bgcolor="#FFFFFF">&nbsp;<font face="Times New Roman" color=#000 size=2><?php echo ($vo["user_password"]); ?></font></td>
                <td bgcolor="#FFFFFF">&nbsp;<font color=#000 size=2><?php echo ($vo["user_identity"]); ?></font></td> 
                <td bgcolor="#FFFFFF">&nbsp;<font face="Times New Roman" color=#000 size=2><?php echo ($vo["user_tuan_number"]); ?></font></td>  
              </tr><?php endforeach; endif; ?>
              
              <tr class="content">
                <td colspan="5" bgcolor="#FFFFFF">&nbsp;<font face="Times New Roman" color=#000 size=2><?php echo ($page); ?></font></td>
                </tr>
            </table>
            </form>
        </div>
        </div>
    </div>
    
    
</div>


</body>
</html>