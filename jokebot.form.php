<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>add a joke</title>
	<meta name="description" content="Jokebot MP is written in PHP for Mongo DB">
	<meta name="author" content="syspimp">

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="stylesheet" href="css/style.css">

	<script src="js/libs/modernizr-2.0.min.js"></script>
	<script src="js/libs/respond.min.js"></script>
	<?php include_once("jokebot.google.php"); ?>
</head>
<body>
	<div id="header-container">
		<header class="wrapper">
			<h1 id="title">Jokebot MP</h1>
			<nav>
				<ul>
					<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">random</a></li>
					<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?format=json">json</a></li>
					<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?format=xml">xml</a></li>
					<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?format=text">text</a></li>
					<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?format=new">add a joke</a></li>
					<li><a href="http://github.com/syspimp/Jokebot-MP">about</a></li>
				</ul>
			</nav>
		</header>
	</div>
	<div id="main" class="wrapper">
		<article>
			<header>
				<h2><?php echo $joke['title']; ?></h2>
				<p><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=new">
			<ul >
			
					<li id="li_4" >
		<label class="description" for="category">Category </label>
		<div>
		<select class="element select medium" id="category" name="category"> 
			<option value="" selected="selected">Pick One</option>
<?php foreach(getallcats() as $category) {
	echo "			<option value=\"".$category['_id']."\" >".$category['name']."</option>\n";
}
?>
		</select>
		</div> 
		</li>		<li id="li_1" >
		<label class="description" for="title2">Title </label>
		<div>
			<input id="title2" name="title" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="text">Text </label>
		<div>
			<textarea id="text" name="text" class="element textarea medium"></textarea> 
		</div> 
		</li>		<li id="li_3" >
		<label class="description" for="author">Author ( optional ) </label>
		<div>
			<input id="author" name="author" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>
			
					<li class="buttons">
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	</p>
			</header>
		</article>
	</div>
	<div id="footer-container">
		<footer class="wrapper">
		<h3>Copyright © Syspimp <a href="http://github.com/syspimp/Jokebot-MP">Jokebot MP</a>, 2012</h3>
		</footer>
	</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
<script src="js/script.js"></script>
<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
	<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

</body>
</html>
