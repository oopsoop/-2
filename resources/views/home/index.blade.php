<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" href="{{ url('home/css/index.css') }}">
<link href="{{ url('home/css/global.css') }}" rel="stylesheet">
{{--<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>--}}
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript">
	//JSON PORTFOLIO
	var portfolioJSON = [{},{},{},{}];
  // {"0":"B","4":"2012-10-28 19:24:24","1":"bci.jpg","3":"201"},
  // {"0":"C","4":"2012-03-07 03:07:55","1":"2012\/03\/c.jpg","2":"#FFFFFF","3":"82"},
  // // {"0":"Self-Service","4":"2012-03-06 16:43:34","1":"2012\/03\/selfservice11.jpg","2":"#669900","3":"4"},
  // {"0":"D","4":"2012-03-05 16:44:51","1":"2012\/03\/portfolio1.jpg","2":"#304B89","3":"176"}];
	var featuresTimer;
	var resizeTimer;
	var hoverTimer;
</script>	

	<script type="text/javascript" src="{{ url('home/js/features.js') }}"></script>
</head>
<body>
	<header>
	<div class="navbar">
			<img src="{{ url('home/image/LOGO@2x.png') }}" alt="">
		<ul>
			<li class="c5184CF">首页</li>
			<li>项目申报</li>
			<li>新闻资讯</li>
			<li>政策解读</li>
			<!-- <li>都是</li> -->
		</ul>
		<ul class="company">
			<li>上海柏源知识产权代理有限公司</li>
			<li><img data-src="{{ url('home/image/ext-nomal.png') }}" data-osrc="{{ url('home/image/ext-hover.png') }}" src="{{ url('home/image/ext-nomal.png') }}" alt=""></li>
		</ul>
		<!-- <ul class="dr">
			<li>登录</li>
			<li>注册</li>
		</ul> -->
	</div>                                 
	
	</header>
	<div class="sowing_map"></div>
	<div class="content">
		<div class="applyservice">
			<p>专业便捷的项目申报服务</p>
			<strong>Service Items</strong>
			<ul class="ztu">
				<li>
					<img src="{{ url('home/image/item-1-b.png') }}" data-src="{{ url('home/image/item-1-b.png') }}" data-osrc="{{ url('home/image/item-1-a.png') }}"  alt="">
					<p>项目申报服务</p>
					<span class="rows2">本系列课程从0开始系统地讲解css。如果你是前端新手，不知从何下手学习，那么可以认真学习本系列课程。学完之后基本常用的css属性你都能够有所了解，再搭配上适当的代码练习，很快就能做出漂亮的网页效果。</span>
				</li>
				<li><img src="{{ url('home/image/item-2-b.png') }}" data-src="{{ url('home/image/item-2-b.png') }}" data-osrc="{{ url('home/image/item-2-a.png') }}" alt="">
					<p>项目申报服务</p>
					<span class="rows2">本系列课程从0开始系统地讲解css。如果你是前端新手，不知从何下手学习，那么可以认真学习本系列课程。学完之后基本常用的css属性你都能够有所了解，再搭配上适当的代码练习，很快就能做出漂亮的网页效果。</span>
				</li>
				<li><img src="{{ url('home/image/item-3-b.png') }}" data-src="{{ url('home/image/item-3-b.png') }}" data-osrc="{{ url('home/image/item-3-a.png') }}" alt="">
					<p>项目申报服务</p>
					<span class="rows2">本系列课程从0开始系统地讲解css。如果你是前端新手，不知从何下手学习，那么可以认真学习本系列课程。学完之后基本常用的css属性你都能够有所了解，再搭配上适当的代码练习，很快就能做出漂亮的网页效果。</span>
				</li>
			</ul>
			<div class="seeAll"><span>查看全部</span></div>
		</div>
		<div class="applyservice">
			<p>最新最热的资讯</p>
			<strong style="width:182px">Hot Information</strong>
			<div id="content-outer">
  <div class="content-container home">
    <link href="{{ url('home/css/features.css') }}" rel="stylesheet" type="text/css">
    <div id="features-container">
 
      <div class="frame-smaller-outer left">
        <div class="frame-smaller-inner">
          <div class="slider"> 
          <img src='{{ url('home/image/a1.png') }}' />
          <img src='{{ url('home/image/a2.png') }}' />
          <img src='{{ url('home/image/a3.png') }}' />
          <img src='{{ url('home/image/a4.png') }}' />
          <img src='{{ url('home/image/a1.png') }}' />
          <img src='{{ url('home/image/a2.png') }}' />
          <img src='{{ url('home/image/a3.png') }}' />
          <img src='{{ url('home/image/a4.png') }}' /> </div>
        </div>
      </div>
      <div class="frame-smaller-outer right">
        <div class="frame-smaller-inner">
          <div class="slider"> 
          <img src='{{ url('home/image/a1.png') }}' />
          <img src='{{ url('home/image/a2.png') }}' />
          <img src='{{ url('home/image/a3.png') }}' />
          <img src='{{ url('home/image/a4.png') }}' />
          <img src='{{ url('home/image/a1.png') }}' />
          <img src='{{ url('home/image/a2.png') }}' />
          <img src='{{ url('home/image/a3.png') }}' />
          <img src='{{ url('home/image/a4.png') }}' /> </div>
        </div>
      </div>
    <!--   <img id="frame-center-shadow" src="image/frame-shadow.png" /> -->
      <div id="frame-center-outer">
        <div id="frame-center-inner">
          <div class="slider"> 
           <a href='#'><span class='title'>Self-Service</span><span class='more'>view more</span><span class='image-holder'><img src='{{ url('home/image/a1.png') }}' /></span></a><a href='#'><span class='title'>Portfolio: "Infinite Scolling" Wall</span><span class='more'>view more</span><span class='image-holder'><img src='{{ url('home/image/a2.png') }}' /></span></a><a href='#'><span class='title'>Mother's Ring Builder</span><span class='more'>view more</span><span class='image-holder'><img src='{{ url('home/image/a3.png') }}' /></span></a><a href='#'><span class='title'>BCI Rentals - Custom CMS</span><span class='more'>view more</span><span class='image-holder'><img src='image/a4.png' /></span></a><a href='#'><span class='title'>Schoolwires Creative Services</span><span class='more'>view more</span><span class='image-holder'><img src='{{ url('home/image/a1.png') }}' /></span></a><a href='#'><span class='title'>Self-Service</span><span class='more'>view more</span><span class='image-holder'><img src='{{ url('home/image/a2.png') }}' /></span></a><a href='#'><span class='title'>Portfolio: "Infinite Scolling" Wall</span><span class='more'>view more</span><span class='image-holder'><img src='{{ url('home/image/a3.png') }}' /></span></a><a href='#'><span class='title'>Mother's Ring Builder</span><span class='more'>view more</span><span class='image-holder'><img src='{{ url('home/image/a4.png') }}' /></span></a>
           
          </div>
        </div>
      </div>
      <div class="nav-arrow back"></div>
      <div class="nav-arrow next"></div>
    </div>
  </div>
			<div class="seeAll"><span>查看全部</span></div>
		</div>
		<div class="applyservice">
			<p>实时的政策解读</p>
			<strong style="width:177px">Real time policy</strong>
			<ul id="tu3">
				<li>a</li>
				<li>b</li>
				<li>c</li>
				<li>c</li>
			</ul>
			<div class="seeAll"><span>查看全部</span></div>
		</div>
		<div class="applyservice w230h90">
			<p>成功案例</p>
			<strong style="width: 127px;font-size: 20px;">Success case</strong>
			<ul id="tu4">
				<li>a</li>
				<li>b</li>
				<li>c</li>
				<li>c</li>
			</ul>
			
		</div>
	</div>	
	<footer>
		<div id="di">
			<ul>
			<li>首页</li>
			<li class="colorgray">项目申报</li>
			<li class="colorgray">新闻资讯</li>
			<li class="colorgray">政策解读</li>
			</ul>
			<img src="{{ url('home/image/footer@2x.png') }}" alt="">
			<div style="clear:both;"></div>
			<span class="left">Copyright © 上海柏源知识产权代理有限公司    粤ICP备18003151号-1   </span>
			<span>微信服务号</span>
		</div>
	</footer>
	<script type="text/javascript">
	window.onload=function(){
		
		//nav
		var navbar = document.querySelector('.navbar');
		var child_navbar = navbar.getElementsByTagName('li');
		for(let item of child_navbar){
			item.onmouseover=function(e){
				var target = e.target || e.srcElement;
				
				for(let item2 of child_navbar){
					item2.className = '';
				}
				if(target.children[0]){
					if(target.children[0].nodeName == 'IMG'){
					target.children[0].src = target.children[0].dataset.osrc;
				}
				}
				
				this.className = 'c5184CF';
				
			}
			item.onmouseout=function(e){
				var target = e.target || e.srcElement;
				if(target.children[0]){
					if(target.children[0].nodeName == 'IMG'){
					target.children[0].src = target.children[0].dataset.src;
				}
				}
				
				// this.className = '';
			}
		}	

		//
		var ztu = document.querySelector('.ztu');
		var child_ztu = ztu.getElementsByTagName('li');
		for(let item of child_ztu){
			item.onmouseover=function(){
				this.style.backgroundColor='#007EFF';
				this.style.color='#fff';
				this.children[0].src = this.children[0].dataset.osrc;
			}
			item.onmouseout=function(){
				this.style.backgroundColor='#fff';
				this.style.color='#000';
				this.children[0].src = this.children[0].dataset.src;
			}
		}
	}
	</script>
</body>
</html>