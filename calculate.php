<?php

if (isset($_POST)) {
	$data = $_POST;
	
	$inputInitial				= $_POST['inputInitial'];
	$inputMonthly				= $_POST['inputMonthly'];
	$inputYears					= $_POST['inputYears'];
	$inputAverageRet			= $_POST['inputAverageRet'];
	$inputAge					= $_POST['inputAge'];
	
	function nf($number) {
		return number_format($number, 2);
	}
	

	for ($x=1; $x<=$inputYears; $x++) {
		$inputYearly 			= $inputMonthly * 12;
		if ($x == 1) {
			$output				= '';
			$start_principle 	= $inputInitial;
			$end_principle 		= $inputInitial + $inputYearly;
			$year 				= date('Y');
			$age 				= $inputAge;
		} else {
			$start_principle	= $end_balance;
			$end_principle		= $start_principle + $inputYearly;
			$year 				= (int)$year + 1;
			$age 				= $age + 1;
		}

		$interest_gain			= $end_principle * $inputAverageRet / 100;
		$end_balance			= $end_principle + $interest_gain;
		
		$output .= "<tr>"
				 . "   <td>" . $x					. "</td>"
				 . "   <td>" . $age					. "</td>"
				 . "   <td>" . $year				. "</td>"
				 . "   <td>" . nf($start_principle)	. "</td>"
				 . "   <td>" . nf($end_principle) 	. "</td>"
				 . "   <td>" . nf($interest_gain) 	. "</td>"
				 . "   <td>" . nf($end_balance) 	. "</td>"
				 . "</tr>";
	}
	if (isset($output)) {
		echo $output;
	}
}


