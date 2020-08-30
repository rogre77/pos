<?php
	include_once './class/posterminal.php';

	$terminal = new PosTerminal();

	$response = file_get_contents('http://localhost/pos/api/getshopcartitems.php');

	if ($response == "") {
		$arr = array();
	} else {
		$obj = json_decode($response);
		$arr = json_decode(json_encode($obj), true);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart Checkout</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="styles.css" >

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>    
<div class="container">
	<div class="row">
	<h2>Shopping Cart Checkout</h2>
		<table class="table "> 
		<thead> 
			<tr> 
				<th>Code</th> 
				<th>Item Description</th> 
				<th>Brand</th> 
				<th>Unit Price</th>
				<th>Bulk Price</th>
				<th>Quantity</th> 
				<th>Total Amount (individual)</th> 
				<th>Total Amount (bulk)</th> 
				<th>Total Item Amount</th> 
				<th>Action</th>
			</tr> 
		</thead> 
		<tbody> 
		<?php 
			foreach ($arr as $row) {
				$itemTotalAmt = $row['unit_total_amt'] + $row['bulk_total_amt'];
				?>
					<tr> 
						<th scope="row"><?php echo $row['pcode']; ?></th> 
						<td><?php echo $row['pdesc']; ?></td>
						<td><?php echo $row['brand']; ?></td>
						<td><?php echo $row['unitprice']; ?></td>
						<td><?php echo $row['bulkprice']." for ".$row['bulk_quantity']; ?></td>
						<td><?php echo $row['quantity']; ?></td> 
						<td><?php echo $row['unit_total_amt']; ?></td>
						<td><?php echo $row['bulk_total_amt']; ?></td>
						<td><?php echo $itemTotalAmt; ?></td>
						<td>
							<a href="api/deleteshopcartitem.php?pcode=<?php echo $row['pcode']; ?>" 
							onclick=""><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
						</td>
					</tr> 
			<?php } ?>
					<tr>
						<th></th>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Total</td>
						<td><?php echo $terminal->calculateTotal(); ?></td>
						<td>
							<button type="submit" form="Form" name="btnPay" value="paid" class="btn btn-success" onclick="" >Pay</button>         
						</td>						
					</tr>
		</tbody> 
		</table>
	</div>
</div>

<div class="container">
	<form id="Form" action="scanitem.php" method="post" autocomplete="off" >
		<div class="col-sm-3">
			<br>
			<input type="text" class="form-control" id="IdBarCode" name="BarCode" 
			placeholder="Barcode(s)" value="">
		</div> 
		<div class="col-sm-1">
			<br>
			<button type="submit" name="btnSave" class="btn btn-success" onclick="" >Scan/Add</button>   
		</div>   
	</form>

</div>

</body>
</html>