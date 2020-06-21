<?php 

$facilityType=_facilityType();
$productStatus=_productStatus();
$currency=_currency();
?>

Facility Type -	<?=@$facilityType[$data['facility_type']]?> <br />
Name - 	<?=@$data['name']?> <br />
Currency -	<?=@$currency[$data['currency']]?> <br />
Amount -	<?=@$data['amount']?><br />
Commission -	<?=@$data['commission']?><br />
Description -	<?=@$data['description']?><br />
Remarks -	<?=@$data['remarks']?><br />
Status -	<?=@$productStatus[$data['status']]?><br />
Created -	<?=date('Y-m-d H:i:s')?><br />
