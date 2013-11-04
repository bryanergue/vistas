<!-- 


	_|    _|  _|_|_|_|_|  _|      _|  _|        _|_|_|_|  
	_|    _|      _|      _|_|  _|_|  _|        _|        
	_|_|_|_|      _|      _|  _|  _|  _|        _|_|_|    
	_|    _|      _|      _|      _|  _|              _|  
	_|    _|      _|      _|      _|  _|_|_|_|  _|_|_|    
	
	_|_|_|    _|_|_|_|    _|_|_|  _|_|_|_|  _|_|_|_|_|  
	_|    _|  _|        _|        _|            _|      
	_|_|_|    _|_|_|      _|_|    _|_|_|        _|      
	_|    _|  _|              _|  _|            _|      
	_|    _|  _|_|_|_|  _|_|_|    _|_|_|_|      _|      
	
                                                                                                            
	The HTML5 Reset Template Set						:: http://html5reset.org
	The site is copyright (c) 2011 Monkey Do, LLC 		:: http://monkeydo.biz
	
	The templates are free and released under the BSD license; if you like them, please pass them along.


-->

<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head id="www-html5reset-org" data-template-set="html5-reset">

	<meta charset="utf-8">
	
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php echo $this->pageTitle ?></title>
	
	<meta name="title" content="HTML5 Reset :: A simple set of templates for any project">
	<meta name="description" content="A simple set of HTML5 and CSS best practices to get your HTML5 project off on the right foot. " />
	<!-- Google will often use this as its description of your page/site. Make it good. -->
	
	<meta name="google-site-verification" content="eZEnJYptPgEDsL202PwuIwmQWxXblu5t2O9XZ8SizxI" />
	<!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
	
	<meta name="author" content="Tim Murtaugh, Monkey Do, LLC" />
	<meta name="Copyright" content="Copyright Monkey Do, LLC 2011. All Rights Reserved." />
	
	<!-- Dublin Core Metadata : http://dublincore.org/ -->
	<meta name="DC.title" content="HTML5 Reset" />
	<meta name="DC.subject" content="A simple set of best practices to get your HTML5 project off on the right foot." />
	<meta name="DC.creator" content="Monkey Do, LLC" />
	
	<!--  Mobile Viewport Fix
	j.mp/mobileviewport & davidbcalhoun.com/2010/viewport-metatag 
	device-width : Occupy full width of the screen in its current orientation
	initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
	maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
	-->
	<meta name="viewport" content="width=device-width; initial-scale=.9;">
	
	<link rel="shortcut icon" href="_/img/favicon.png">
	<!-- This is the traditional favicon.
		 - size: 16x16 or 32x32
		 - transparency is OK
		 - see wikipedia for info on browser support: http://mky.be/favicon/ -->
		 
	<link rel="apple-touch-icon" href="_/img/apple-touch-icon-precomposed.png">
	<!-- The is the icon for iOS's Web Clip.
		 - size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for iPhone4's retina display (IMHO, just go ahead and use the biggest one)
		 - To prevent iOS from applying its styles to the icon name it thusly: apple-touch-icon-precomposed.png
		 - Transparency is not recommended (iOS will put a black BG behind the icon) -->
	
	<!-- CSS: screen, mobile & print are all in the same file -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/_/css/style.css">
	
	<!-- TypeKit -->
	<script src="http://use.typekit.com/lvd3bfg.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	
	<!-- all our JS is at the bottom of the page, except for Modernizr. -->
	<script src="<?php echo Yii::app()->theme->baseUrl ?>/_/js/modernizr-1.7.min.js"></script>

</head>

<body id="www-html5reset-org">

<div class="wrapper"><!-- not needed? up to you: http://camendesign.com/code/developpeurs_sans_frontieres -->

	<header>
	
		<h1><a href="/"><?php echo Yii::app()->name ?></a></h1>
		
		<nav>
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Home', 'url'=>array('/site/index')),
						array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
						array('label'=>'Contact', 'url'=>array('/site/contact')),
						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),
				)); ?>
		</nav>
	
	</header>
	<article>
		<?php echo $content ?>
	</article>
	<!--
	<article id="why">
	
		<h1>Why?</h1>
		
		<p>Like a lot of developers, we start every HTML project with the same set of HTML and CSS files. We've been using these files for a long time and have progressively added bits and pieces to them as our own personal best practices have evolved.</p>
		
		<p>Now that modern browsers are starting to support some of the really useful parts of HTML5 and CSS3, it's time for our best practices to catch up, and we thought we'd put our files out there for everyone to use. By no means do we see this as the One True Way to start every project, but we think it's a good starting place that anyone can make their own.</p>
	
		<h2 id="about">About Version 2</h2>
		
		<p>The biggest change is to our stylesheets. We've been using the browser-specific style sheets less and less often in our work so we eliminated them, which saves us the overhead of additional downloads. In their place we're now using Paul Irish's conditional comments technique to add IE-specific classes to the HTML tag &#8212; creating IE-specific styles is now as easy as <code>.ie body { IE styles go here }</code>.</p>
		
		<p>In the same spirit, we've also moved our print styles into the main stylesheet and added a mobile/small display style block (including blocks for orientation). The end result is a faster-downloading page.</p>
		
		<p>Also in the sprirt of simplifiction, we've eliminated the "Bare Bones" version and are now only offering one set of fully-commented files. (We assume everyone is tweaking the files for their own use anyway, so go ahead and strip the comments out at your leisure!)</p>
		
		<p>Finally, and sigificantly, we're hosting <a href="https://github.com/murtaugh/HTML5-Reset">the files on GitHub</a> (yay!) for better issue and version tracking.</p>

	</article>
		-->

	<footer>
		
		<p>
			<small>
				Copyright 2011 <a href="http://monkeydo.biz" data-twitter="monkeydobiz">Monkey Do, LLC</a>. All Rights Reserved.<br>
				<a href="http://twitter.com/html5reset">@html5reset</a> <a href="http://twitter.com/monkeydobiz">@monkeydobiz</a> <a href="http://twitter.com/murtaugh">@murtaugh</a> <a href="http://twitter.com/mikepick">@mikepick</a>
			</small>
		</p>
		
	</footer>
</div>

<!-- here comes the javascript -->

<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="<?php echo Yii::app()->theme->baseUrl ?>/_/js/jquery-1.5.1.min.js"><\/script>')</script>

<!-- this is where we put our custom functions -->
<script src="<?php echo Yii::app()->theme->baseUrl ?>/_/js/functions.js"></script>

<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID. -->
<!--
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->

</body>
</html>
