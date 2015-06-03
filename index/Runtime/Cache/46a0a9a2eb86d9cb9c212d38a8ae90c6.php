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
<!-- photo start -->
<div id="photo">
	<div class="container">
			<img src="Image/teacher.jpg" alt="tuqian">
	</div>
</div>
<!-- photo end -->
<!-- mian  start -->
<div id="main">
	<div class="container clearfix">
				<div class="main_list" id="main_list">
	<div class="main_list_title">
		<img src="__ROOT__/statics/index/Image/nav_house.png" alt="lala">
		<?php echo ($now_here); ?><!-- 首页菜单不显示；样式不对 -->
	</div>
	<div class="main_list_nav">
		 <ul>
			<?php if(is_array($mainleft_cate_list)): $i = 0; $__LIST__ = $mainleft_cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sval): $mod = ($i % 2 );++$i;?><li id=""><a href="__APP__/Submenu/index?id=<?php echo ($sval["id"]); ?>&pid=<?php echo ($sval["pid"]); ?>"><?php echo ($sval["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul> 
	</div>
</div>
				<div class="main_con" id="main_con">
						<div class="main_con_title">
								<span class="span1">现任领导</span>
								<span class="span2">Current Ieader ship</span>
						</div>
						<div class="main_con_con">
								<div class="leader_main">
									<?php if(is_array($teaList)): $i = 0; $__LIST__ = $teaList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sval): $mod = ($i % 2 );++$i;?><div class="leader">
											<div class="leader_photo">
												<img src="Image/leader.jpg" alt="习大大">
											</div>
												<div class="leader_intro">
													<div class="leader_intro_title">
														<span class="leader_intro_name"><b><?php echo ($sval["name"]); ?></b></span>
														<span class="leader_intro_position"><?php echo ($sval["position"]); ?></span>
													</div>
													<div class="leader_intro_con">
														<div class="intro_con">个人简介</div>
														<div class="intro_con_main">
															<?php echo ($sval["intro"]); ?>
															<br>
															办公电话:	<?php echo ($sval["phone"]); ?>
														</div>
													</div>
												</div>
										</div><?php endforeach; endif; else: echo "" ;endif; ?>
								</div>			
						</div><!-- ./main_con_con -->
				</div>
	</div>
</div>
<!-- mian  end -->
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