<?php

require_once('Mysqlidb.php');

/*
$db['production']['host']       = 'localhost';
$db['production']['username']   = 'aklo_admin';
$db['production']['password']   = 'qweasdzxc';
$db['production']['dbname']     = 'aklo_cg';
*/

$db = new Mysqlidb(
	'localhost', 
	'frogforc_jethro', 
	'jethro125', 
	'frogforc_stock'
);

function getStockList($term)
{
	//http://pse.com.ph/stockMarket/companyInfo.html?method=fetchHeaderData&company=212&security=179
	$getStockList = file_get_contents('http://pse.com.ph/stockMarket/companyInfoSecurityProfile.html?method=getListedRecords&common=yes');
	if ($getStockList) {
		$stockList = json_decode($getStockList);
		$records = $stockList->records;
		$results = array();
		foreach($records as $record) {
			if (preg_match("/^{$term}/i", $record->securitySymbol)) {
				$results[] = array(
					'value'				=> $record->securitySymbol,
					'label'				=> $record->securitySymbol,
					'desc'				=> $record->securityName,
					'companyId'			=> $record->companyId,
					'securitySymbolId'	=> $record->securitySymbolId,
				);
			}
		}
		//echo "<pre>";
		//print_r($results);
		//echo "</pre>";
		echo json_encode($results);
	}

}

if (isset($_GET['term']) && isset($_GET['getStockList']) && $_GET['term'] != '') {
	getStockList($_GET['term']);
}

if (isset($_GET['transaction']) && isset($_GET['inputTransaction']) && $_GET['inputTransaction'] != '') {
	$inputTransaction	= $_GET['inputTransaction'];
	$inputStock			= $_GET['inputStock'];
	$inputPrice			= $_GET['inputPrice'];
	$inputShares		= $_GET['inputShares'];
	$inputDate			= $_GET['inputDate'];
	
	
	if ($inputTransaction == 'buy') {
	
	}
}