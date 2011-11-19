<?php 

$appkey=1234;
$action='get';
$catid=0;
$jokeid=0;
$format='html';

# init, these variables can be changed by sending as a get request
if(!empty($_SERVER['SHELL']))
{
	$PHP_SELF="index.php";
	$format = isset($argv[1]) ? $argv[1] : 'text';
}
$configvars = array('format','appkey','action','catid','jokeid');
foreach($configvars as $var)
{
	if (isset($_GET[$var])) {
		$$var = $_GET[$var];
	}
}

function array2xml($ar,$root_element_name='joke'){
    $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><{$root_element_name}></{$root_element_name}>"); 
    $f = create_function('$f,$c,$a',' 
            foreach($a as $k=>$v) { 
                if(is_array($v)) { 
                    $ch=$c->addChild($k); 
                    $f($f,$ch,$v); 
                } else { 
                    $c->addChild($k,$v); 
                } 
            }'); 
    $f($f,$xml,$ar); 
    return $xml->asXML(); 
} 
function array2json($arr) { 
    if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
    $parts = array(); 
    $is_list = false; 

    //Find out if the given array is a numerical array 
    $keys = array_keys($arr); 
    $max_length = count($arr)-1; 
    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
        $is_list = true; 
        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position 
            if($i != $keys[$i]) { //A key fails at position check. 
                $is_list = false; //It is an associative array. 
                break; 
            } 
        } 
    } 

    foreach($arr as $key=>$value) { 
        if(is_array($value)) { //Custom handling for arrays 
            if($is_list) $parts[] = array2json($value); /* :RECURSION: */ 
            else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */ 
        } else { 
            $str = ''; 
            if(!$is_list) $str = '"' . $key . '":'; 

            //Custom handling for multiple data types 
            if(is_numeric($value)) $str .= $value; //Numbers 
            elseif($value === false) $str .= 'false'; //The booleans 
            elseif($value === true) $str .= 'true'; 
            else $str .= '"' . addslashes($value) . '"'; //All other things 
            // :TODO: Is there any more datatype we should be in the lookout for? (Object?) 

            $parts[] = $str; 
        } 
    } 
    $json = implode(',',$parts); 
     
    if($is_list) return '[' . $json . ']';//Return numerical JSON 
    return '{' . $json . '}';//Return associative JSON 
} 
function displayjoke($joke)
{
	global $format;
	switch($format)
	{
		case 'text':
		echo "\n".$joke['title'] ."\n\n". $joke['text'] ."\n";
		break;
		case 'html':
		include('html.php');
		#$text=str_replace("\n","<br />\n",$joke['text']);
		#echo "<html>\n<body>\n<title>".$joke['title']."</title>\n"
		#. "<p>".$joke['title']."</p>\n"
		#. "<p>".$text."</p>\n"
		#. "</body></html>\n";
		break;
		case 'json':
		#header("Content-Type:text/json");
		echo array2json($joke);
		break;

		case 'xml':
		header("Content-Type:text/xml");
		print array2xml($joke);
		break;
	}
}
function getjokebycat($catid=0)
{
	if ($catid==0){
		$catid=getrandomcatid();
	}
	$mongo = new Mongo();
	$collection = $mongo->jokes->jokes;
	return $collection->findOne(array("category" => $catid));
}
function getjoke($jokeid=0)
{
	if ($jokeid==0){
		$jokeid=getrandomjokeid();
	}
	$mongo = new Mongo();
	$collection = $mongo->jokes->jokes;
	$joke = $collection->findOne(array("_id" => $jokeid));
    	$cat = $collection->getDBRef($joke['category']);
    	$joke['category'] = $cat['name'];
	return $joke; 
}
function getrandomjokeid()
{
	$mongo = new Mongo();
	$collection = $mongo->jokes->jokes;
	$count = $collection->find()->count() - 1;
	$jokeid = $collection->findOne(array("_id" => rand(1,$count)));
	return $jokeid['_id'];
	
}

function getrandomcatid()
{
	$mongo = new Mongo();
	$collection = $mongo->jokes->categories;
	$count = $collection->find()->count() - 1;
	$catid = $collection->findOne(array("_id" => rand(1,$count)));
	return $catid['_id'];
	
}
function checkappkey($key)
{
	return true;
}


