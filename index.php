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
			if(isset($_POST['text']) || $_POST['title'] || $_POST['category']) {
				try {
					$joke=cleaninputforinsert($_POST);
					var_dump($joke);
					$joke=insertjoke($joke);
					displayjoke(getjoke(array('jokeid' => $joke['_id'])));
				} catch(Exception $e) {
    					echo "An error occured inserting joke! $e\n";
				}
			} else {
				include('jokebot.form.php');
			}
			break;
	}
}

main();
exit (0);
