<?php

require_once('jokebot.lib.php');

if (checkappkey($appkey) == false)
{
	exit(0);
}

function main()
{
	global $action;
	switch($action)
	{
		case 'get':
			displayjoke(getjoke());
			break;
		case 'set':
			break;
		case 'new':
			break;
	}
}

main();
exit (0);
