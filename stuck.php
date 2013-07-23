<?php 

require_once('Mysqlidb.php');
/*
//https://www.colfinancial.com/ape/Final2/home/faq.asp#how_much_are_the_trade_charges 
Commission 														0.25% 	Of the gross trade amount	20
Value Added Tax (VAT) 											12% 	Of comission				2.4
Philippine Stock Exchange Transaction Fee (PSE Trans Fee) 		0.005% 	Of the gross trade amount	4
Securities Clearing Corporation of The Philippines Fee (SCCP) 	0.01% 	Of the gross trade amount	8

Additional Fee for Selling
Sales Tax 														No. of Shares X Price X 0.005
*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
	<header>
		<div class="navbar-fixed-top">&nbsp;</div>
	</header>
	<section>
		<div class='container'>
			<div class='row'>
				<div class='span3'>
					<div class='sidebar affix'>
						<ul class="nav nav-list">
							<!--<li class="nav-header">List header</li>-->
							<li class="nav-header">
								<h4>lorem ipsum * <br /><small>lorem ipsum dolor sit amet!</small></h4>
							</li>
							<li class="active"><a href="#">lorem</a></li>
							<li><a href="#">ipsum</a></li>
							<li><a href="#">dolor</a></li>
							<li><a href="#">sit</a></li>
							<li class="divider"></li>
							<li class='dropdown'>
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">amet<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">Chat</a></li>
									<li><a href="#">Investment Calc</a></li>
									<li><a href="#">Typing Test</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class='span9'>
					<div class='content'>
						<div class='app-controls'>
							<h4>add transaction</h4>
							<form class="form-horizontal" id='frmTrans'>
								<div class="row">
									<div class="span3">
										<div class='controlGroup'>
											<label for="inputTransaction">Transaction</label>
											<select class="span2" name="inputTransaction" id="inputTransaction">
												<option value='buy'>Buy</option>
												<option value='sell'>Sell</option>
											</select>
										</div>	
										<div class='controlGroup'>
											<label for="inputStock">Stock Symbol</label>
											<input class="span2" name='inputStock' id="inputStock" type="text"  />
										</div>										
									</div>																		
									<div class="span3">
										<div class='controlGroup'>
											<label for="inputPrice">Price</label>
											<div class="input-prepend">
												<span class="add-on">$</span>
												<input class="span2 inputNumber" name="inputPrice" id="inputPrice" type="number" />
											</div>
										</div>											
										<div class='controlGroup'>
											<label for="inputShares">Shares</label>
											<input class="span2 inputNumber" name="inputShares" id="inputShares" type="number" />
										</div>									
									</div>									
									<div class="span3">
										<div class='controlGroup'>
											<label for="inputDate">Date</label>
											<input class="span2" name='inputDate' id="inputDate" type="text"  />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="span3">
										<button class="btn" type="button" id='btnCalculate'>Proceed</button>
									</div>
								</div>
							</form>
						</div>
						<div id='transactions'>
							<div class='transaction-stock'>
								<div class='stock-info'>
									<h3>July 15, 2013</h3>
									<table class='table' id='tableMain'>
										<thead>
											<tr>
												<th>Stock Name</th>
												<th>Portfolio %</th>
												<th>Market Price</th>
												<th>Average Price</th>
												<th>Total Shares</th>
												<th>Market Value</th>
												<th>Average Value</th>
												<th>Gain / Loss</th>
												<th>% Gain / Loss </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>DNL</td>
												<td>35.36</td>
												<td>6.6000</td>
												<td>7.3591</td>
												<td>13600</td>
												<td>89,760.00</td>
												<td>100,083.76</td>
												<td>-10,323.76</td>
												<td>-10.32%</td>
											</tr>
											<tr>
												<td>MBT</td>
												<td>64.64</td>
												<td>109.4000</td>
												<td>78.2379</td>
												<td>1500</td>
												<td>164,100.00</td>
												<td>117,356.85</td>
												<td>46,743.15</td>
												<td>39.83%</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer>&nbsp;</footer>
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--[if lt IE 9]><script src="js/excanvas/excanvas.js"></script><![endif]-->
	<script>
	$(function() {
		$( "#inputDate" ).datepicker();
		$('#btnCalculate').click(function(){
			$('.hint').hide();
			$('.preloader').addClass('active');
			var transData = $('#frmTrans').serializeArray();
			$.post('stock.php?transaction', transData, function(data){
				if (data) {
				}
			});
		});
		
		$("#inputStock").autocomplete({
			minLength: 2,
			source: 'stock.php?getStockList',
			focus: function(event, ui) {
				$("#inputStock").val(ui.item.label);
				return false;
			},
		})
		.data("ui-autocomplete")._renderItem = function(ul, item) {
			return $("<li>")
				.append("<a><b>" + item.label + "</b><br><small>" + item.desc + "</small></a>")
				.appendTo(ul);
		};
	});

	</script>
</body>
</html>