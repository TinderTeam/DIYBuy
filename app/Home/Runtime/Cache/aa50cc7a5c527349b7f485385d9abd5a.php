<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>DIY组团网</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css">
        <link rel="stylesheet" href="__PUBLIC__/css/icomoon-social.css">
       <!--  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'> -->

        <link rel="stylesheet" href="__PUBLIC__/css/leaflet.css" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="__PUBLIC__/css/main.css">

        <script src="__PUBLIC__/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
	        <div class="container">

		        <nav id="mainmenu" class="mainmenu">
					<div class="row">
						<div class="col-md-3"><a href="index.html" class="logo-wrapper"><img src="__PUBLIC__/img/logo.png" alt="Multipurpose Twitter Bootstrap Template"></a>
						</div>
						<div class="col-md-5">
  					
						</div>
						<div class="col-md-4" style="text-align:right">
                           <span > <span >还没有账号，请</span> <a href="register.html" class="btn  btn-green">注册</a> </span>
						
						</div>
					</div>
					
				</nav>
			</div>
		</div>

        <!-- Page Title -->
	   <!-- 设计注册页面 -->
	   <div class="section">
			<div class="container">
				<div class="row">
				    <div class="col-lg-6">
				 	    <div class="panel panel-success">
						    <div class="panel-heading"><strong>会员登录</strong></div>
						    <div class="panel-body">
						    <form action="__URL__/check" method="POST" name="form">
								<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:right">用户名</label>
										<div class="col-sm-7">
											<input name="email" type="text" class="form-control"  placeholder="" style="margin-bottom:20px">
									    </div>
										<div class="col-sm-2" ></div>
								</div>
								

								<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:right">密码</label>
										<div class="col-sm-7">
											<input name="pwd" type="password" class="form-control"  placeholder="" style="margin-bottom:20px">
									    </div>
										<div class="col-sm-2" ></div>
								</div>

								<div class="form-group" style="margin-bottom:20px">
										<div class="col-sm-3" ></div>
										<div class="col-sm-7 ">
											    <label>
													<a href="#">忘记密码？</a>
												</label>
									    </div>
										<div class="col-sm-2" ></div>
										<hr/>
								</div>								
                               
                                <div class="form-group" >
										
                                        <div class="col-sm-3"></div>
										<div class="col-sm-7">
                                           <button type="submit" class="btn btn-green btn-block" ><strong>登&nbsp;&nbsp;录</strong></button>
										</div>
										<div class="col-sm-2" ></div>
							    </div> 
                            </form>
						
						
				            
				            </div>
					    </div>	
				    </div>
				
				<div class="col-lg-3"></div>
				<div class="col-lg-3">
						<div class="portfolio-item">
							<div class="portfolio-image">
								<a href="#"><img src="img/二维码.jpg" alt="Project Name"></a>
							</div>
							<div class="portfolio-info">
								<ul>
									<li class="portfolio-project-name">扫一扫关注我哦~</li>

								</ul>
							</div>
						</div>
					</div>	

				 </div>
				</div>
			</div>

	    <!-- Footer -->
	    <div class="footer">
	    	<div class="container">
		    	<div class="row">
		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>用户帮助</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="#">常见问题</a></li>
		    				<li><a href="#">申请退款</a></li>

		    			</ul>
		    		</div>
		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>商务合作</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="#">商家入驻</a></li>
		    				<li><a href="#">团购信息提供</a></li>

		    			</ul>
		    		</div>
		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>关于我们</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="#">公司简介</a></li>
		    				<li><a href="#">法律申明</a></li>
							<li><a href="#">用户协议</a></li>

		    			</ul>
		    		</div>		    		
		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>客服联系</h3>
		    			<p class="contact-us-details">
	        				<b>联系电话:</b> 400-8000-8008<br/>
	        				<b>工作时间:</b> 每天9:00-22:00<br/>
	        				
	        				<b>邮箱:</b> <a href="mailto:customer@diy-tuan.com">customer@diy-tuan.com</a>
	        			</p>
		    		</div>

		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">&copy; 2014 Fuego. All rights reserved.</div>
		    		</div>
		    	</div>
		    </div>
	    </div>

        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="__PUBLIC__/js/bootstrap.min.js"></script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="__PUBLIC__/js/jquery.fitvids.js"></script>
        <script src="__PUBLIC__/js/jquery.sequence-min.js"></script>
        <script src="__PUBLIC__/js/jquery.bxslider.js"></script>
        <script src="__PUBLIC__/js/main-menu.js"></script>
        <script src="__PUBLIC__/js/template.js"></script>

    </body>
</html>