<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh_CN">
<head>
	<meta charset="UTF8">
	<title><?php echo ($set["site_title"]); ?></title>
	<link rel="stylesheet" href="__ROOT__/statics/index/Css/style.css">
	<script type="text/javascript" src="__ROOT__/statics/index/Js/script.js"></script>
	<script type="text/javascript" src="__ROOT__/statics/index/Js/jquery.1.10.2.js"></script>
 	<script type="text/javascript" src="__ROOT__/statics/index/Js/lunbo.js"></script>
</head>
<body>
<!-- header start -->
<div id="header">
	<div class="top"></div>
		<div class="container">
		<div class="logo_sousuo">
			<div class="logo">
				<a href="__APP__"><img src="__ROOT__/statics/index/Image/logo.jpg"></a><!-- <?php echo ($set["site_logo"]); ?> -->
				</div>
			<div class="sousuo">
				<form name="searchform" action="__APP__/Index/search" method="post">
						<input class="newinput" type="text" name="word">
						<input type="hidden" name="mo" value="Article" />
					 	<input type="submit" name="search"  value="搜索" />
				</form>
			</div>
		</div>
			<div class="nav">
				<ul>
				 <?php if(is_array($article_cate_list['parent'])): $i = 0; $__LIST__ = $article_cate_list['parent'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li style="width:10%"><a href="__APP__/Submenu/showFirstMenu?id=<?php echo ($val["id"]); ?>&pid=<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></a>
						 <ul>
							<?php if(is_array($article_cate_list['sub'][$val['id']])): $i = 0; $__LIST__ = $article_cate_list['sub'][$val['id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sval): $mod = ($i % 2 );++$i; if($sval["in_site"] == '1'): ?><li id=""><a  target="_blank" href="<?php echo ($sval["url"]); ?>"><?php echo ($sval["name"]); ?></a></li>
							<?php else: ?>
							<li id=""><a  target="_blank" href="__APP__/Submenu/index?id=<?php echo ($sval["id"]); ?>&pid=<?php echo ($val["id"]); ?>"><?php echo ($sval["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						 </ul>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
</div>
<!-- header end -->
<!-- photochange and importantnews start-->
<div id="photochange_importantnews">
	<div class="container">
			<div id="photochange">
				<div id="list" style="left: -800px;">
				   		<img src="__ROOT__/data/advert/<?php echo ($Adasc[0]['code']); ?>" alt="<?php echo ($Adasc[0]['ordid']); ?>"/>
					         <?php if(is_array($Ad)): $i = 0; $__LIST__ = $Ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="__ROOT__/data/advert/<?php echo ($vo["code"]); ?>" alt="<?php echo ($vo["ordid"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?>
				  		 <img src="__ROOT__/data/advert/<?php echo ($Addesc[0]['code']); ?>" alt="<?php echo ($Addesc[0]['ordid']); ?>"/>
		    	</div>
		    <div id="buttons">
		        <?php if(is_array($Ad)): $i = 0; $__LIST__ = $Ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span index="<?php echo ($vo["ordid"]); ?>" class="on" > 
		        	 	<a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a>
		        	 </span><?php endforeach; endif; else: echo "" ;endif; ?>
		    </div>
			    <a href="javascript:;" id="prev" class="arrow">&lt;</a>
			    <a href="javascript:;" id="next" class="arrow">&gt;</a>
			</div>
			<div class="importantnews">
				<h1>重要通知 </h1>
					 <ul>
				 		<?php if(is_array($Notice)): $i = 0; $__LIST__ = $Notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li ><a href="__APP__/Notice/detail?mo=Notice&id=<?php echo ($val["id"]); ?>&type=<?php echo ($val["type"]); ?>"><?php echo (msubstr($val["name"],0,18,'utf-8',true)); ?><span>【<?php echo (date("m-d",$val["uploadtime"])); ?>】</span></a></li><hr><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul> 
				<h3><a href="__APP__/Notice/more/mo=Notice&type=0">READ MORE >></a></h3>
			</div>
	</div>
</div>
<!-- photochange and importantnews end-->
<!-- focus and collegenews start-->
<div id="focus_collegenews">
	<div class="container">
		<div class="focus">
			<div class="focus_main">
					<div class="focus_main_image">
					 <img src="__ROOT__/data/nav/<?php echo ($Master[0]['logo']); ?>" alt="艺术照">
					 </div>
					 <div class="focus_main_name">
							<a href="__APP__/Master/index">
										<h4>艺术硕士</h4>
										<h5>Master of Arts</h5>
							</a>
					</div>
			</div>
			<div class="focus_main">
					<div class="focus_main_image">
							<img src="__ROOT__/data/nav/<?php echo ($coirse[0]['logo']); ?>" alt="艺术照">
					</div>
					<div class="focus_main_name">
							<a href="__APP__/Coirse/index">
								<h4>精品课程</h4>
								<h5>Excellent coirse</h5>
							</a>
					</div>
			</div>
			<div class="focus_main">
					<div class="focus_main_image">
							<img src="__ROOT__/data/nav/<?php echo ($Institute[0]['logo']); ?>" alt="艺术照">
					</div>
					<div class="focus_main_name">
							<a href="__APP__/Institute/index">
										<h4>中北大学<br>艺术研究所</h4>
										<h5>Art Institute of North University</h5>
							</a>
					</div>
			</div>	
			<div class="focus_main">
					<div class="focus_main_image">
							<img src="__ROOT__/data/nav/<?php echo ($military[0]['logo']); ?>" alt="艺术照">
					</div>
					<div class="focus_main_name">
						<a href="__APP__/Military/index">
									<h4>中国军工<br>文化艺术团</h4>
									<h5>Chinese military culture in North Troupe</h5>
						</a>
					</div>
			</div>
		</div>
		<div class="collegenews">
				<h1>学院新闻</h1>
					 <ul>
					 	<?php if(is_array($CollegeNotice)): $i = 0; $__LIST__ = $CollegeNotice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="__APP__/Notice/detail?mo=Notice&id=<?php echo ($val["id"]); ?>&type=<?php echo ($val["type"]); ?>"><?php echo (msubstr($val["name"],0,21,'utf-8',true)); ?><span>【<?php echo (date("m-d",$val["uploadtime"])); ?>】</span></a></li><hr><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul> 
				<h3><a href="__APP__/Notice/more/type=1">READ MORE >></a></h3>
		</div>
	</div>
</div>
<!-- focus and collegenews end-->
<!--office start -->
<div id="office">
	<div class="container">
		<div class="office_title">
				<span>办公机构</span>
		</div>
		<div class="office_body">
			<?php if(is_array($Department)): $i = 0; $__LIST__ = $Department;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="office_main">
						<a href="__APP__/Department/index?id=<?php echo ($val["id"]); ?>&mo=Article">
							<div class="office_main_photo">
									<h4><?php echo ($val["alias"]); ?></h4>
									<img src="__ROOT__/data/department/<?php echo ($val["img"]); ?>" alt="艺术照">
							</div>
							<div class="office_main_content">
									<h4>&nbsp;<?php echo ($val["alias"]); ?></h4>
									<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (msubstr($val["intro"],0,53,'utf-8',false)); ?>
									</p>
							</div>
						</a>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
</div>
<!--office end -->
<!--discipline start -->
<div id="discipline">
	<div class="container">
		<div class="discipline_title">
				<span>学科管理部</span>
		</div>
		<div class="office_body">
		<?php if(is_array($Profession)): $i = 0; $__LIST__ = $Profession;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="office_main">
					<a href="__APP__/Profession/index?mo=Profession&pid=<?php echo ($val["id"]); ?>">
						<div class="office_main_photo">
								<h4><?php echo ($val["name"]); ?></h4>
								<img src="__ROOT__/data/profession/<?php echo ($val["img"]); ?>" alt="艺术照">
						</div>
						<div class="office_main_content">
								<h4>&nbsp;<?php echo ($val["name"]); ?></h4>
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (msubstr($val["intro"],0,53,'utf-8',false)); ?>
								</p>
						</div>
					</a>	
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>			   				   	
	</div>
</div>
<!--discipline end -->
<div id="footer">
			<div class="footer_main">
				<div class="container clearfix">
					<div class="footer_main_logo">
						<img src="__ROOT__/statics/index/Image/logo-hei.jpg" alt="logo">
					</div>
					<div class="footer_main_friend_link">
						  <div id="footer_main_friend_link_title" class="footer_main_friend_link_title">
						  		<ul>
						  			<li><a>友情链接</a></li>
						  			<li><a>联系方式</a></li>
						  			<li><a>关于我们</a></li>
						  			<li ><a>院长信箱</a></li>
						  		</ul>
						  </div>
						   <div id="footer_main_friend_link_con" class="footer_main_friend_link_con">
						   	<div class="mod">
						   			<ul>
						   					
							   			 <?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($val["url"]); ?>"><?php echo ($val["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?> 
						   			</ul>
						   	</div>
						   	<div class="mod">
						   		<span class="mod_pad">
							   			TEL:<?php echo ($set["tel"]); ?><br>
							   			E-mail:<?php echo ($set["mail_username"]); ?><br>
							   			
						   		</span>
						   	</div>
						   	<div class="mod">
						   		<span class="mod_pad">	
							   			<?php echo ($set["about_web"]); ?>
							   	</span>	
						   	</div>
						   	<div class="mod">
							   	<span class="mod_pad">	
								   	院长信箱：<?php echo ($set["president_email"]); ?>
								   	微信：<img src="__ROOT__/<?php echo ($set["site_logo"]); ?>">
							   	</span>	
						   	</div>
						  </div>
					</div>
				</div>
			</div>
				<div class="foot_copyright">
					<div class="container">
							<div class="copyright_left">
								<?php echo ($set["site_icp"]); ?>
							</div>
							<div class="copyright_right">
								版权所有:中北大学艺术学院
							</div>	
					</div>
			</div>
	</div>
</body>
</html>