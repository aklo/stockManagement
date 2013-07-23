<?php
session_start();

date_default_timezone_set('Asia/Manila');

$db['production']['host']       = 'localhost';
$db['production']['username']   = 'frogforc_jethro';
$db['production']['password']   = 'jethro125';
$db['production']['dbname']     = 'frogforc_stock';

/*
$db['production']['host']       = 'localhost';
$db['production']['username']   = 'aklo_admin';
$db['production']['password']   = 'qweasdzxc';
$db['production']['dbname']     = 'aklo_cg';
*/

$con = mysql_connect(
	$db['production']['host'], 
	$db['production']['username'], 
	$db['production']['password']
);
mysql_select_db($db['production']['dbname'], $con) or die(mysql_error()); 
		
function checkDBChanges($sql) 
{
	if ($sql) {
		return (mysql_affected_rows() > 0) ? true : false;
	} else {
		return false;
	}
}
	
function runSqlQuery($sqlQuery)
{
	$sql = mysql_query($sqlQuery) or print( mysql_error() );
	
	// check if there is db changes upon querying
	return checkDBChanges($sql);
	
}

function getDatabaseRecords($sqlQuery, $limit=false) 
{
	$sql = mysql_query($sqlQuery) or die("Query failed: <br />\n$sqlQuery");
	
	// Fetch SQL
	return checkGetDBFetches($sql, $limit);
	
}

function checkGetDBFetches($sql, $limit) 
{
	$rows = array();
	
	if ($sql) {
		if (@mysql_num_rows($sql) > 0) {
			while ($row = @mysql_fetch_assoc($sql)) {
				$rows[] = $row;
			}
			
			@mysql_free_result($sql);
			return ($limit) ? $rows[0] : $rows ;
		}
	}
}

function pre_print($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function relativeTime( $timestamp ){
	if( !is_numeric( $timestamp ) ){
		$timestamp = strtotime( $timestamp );
		if( !is_numeric( $timestamp ) ){
			return "";
		}
	}
	$difference = time() - $timestamp;
	$test = $difference;
	$periods = array( "sec", "min", "hour");
	$lengths = array( "60","60");
	for( $j=0; $difference>=$lengths[$j] and $j < 2; $j++ )
		$difference /= $lengths[$j];
	$difference = round($difference);

	
	if ($difference > 24 && $periods[$j] == 'hour')
		$text = date('l, F j, Y - g:i:sA', $timestamp);
	else {
		if( $difference != 1 ){
			$periods[$j].= "s";
		}
		$ending = "ago";
		$text = "$difference $periods[$j] $ending";
	}
	return $text;
}

function is_loggedin()
{
	if (isset($_SESSION['userID']) && $_SESSION['userID'] > 0){
		return true;
	}
	return false;
}

function getIP() {
	$ip;
	if (getenv("HTTP_CLIENT_IP"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if(getenv("HTTP_X_FORWARDED_FOR"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if(getenv("REMOTE_ADDR"))
		$ip = getenv("REMOTE_ADDR");
	else
		$ip = "UNKNOWN";
	return $ip;
}

function clean($str)
{
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}

	$str = mysql_real_escape_string($str);
	
	return $str;
}