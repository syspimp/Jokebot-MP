<html><body>
<title>
<?php echo $joke['title']; ?>
</title>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<div id="container">
	<div id="header">
		<h1>
			Jokebot MP
		</h1>
	</div>
	<div id="navigation">
		<ul>
			<li><a href="<?php echo "$PHP_SELF"; ?>">Random Joke</a></li>
			<li><a href="<?php echo "$PHP_SELF"; ?>?format=json">JSON</a></li>
			<li><a href="<?php echo "$PHP_SELF"; ?>?format=xml">XML</a></li>
			<li><a href="<?php echo "$PHP_SELF"; ?>?format=text">Text</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Add a Joke</a></li>
			<li><a href="#">Subscribe</a></li>
			<li><a href="#">Contact us</a></li>
		</ul>
	</div>
	<div id="content">
		<h2>
			<?php echo $joke['title']; ?>
		</h2>
		<p>
			<?php $text=str_replace("\n","<br />\n",$joke['text']); echo $text; ?>
		</p>
	</div>
	<div id="footer">
		Copyright © Syspimp <a href="http://github.com/syspimp/Jokebot-MP">Jokebot MP</a>, 2012
	</div>
</div>
</body>
</html>
