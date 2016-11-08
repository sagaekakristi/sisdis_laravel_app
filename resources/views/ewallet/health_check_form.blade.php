<!DOCTYPE html>
<html lang="en">
<head>
	<title>Transfer Saldo</title>
</head>
<body>
<?php
	echo Form::open(array(
		'action'=>'EWalletController@health_check', 
		'method' => 'post'
	));

	echo Form::submit('Kirim', array('class' => 'btn btn-success'));
	echo Form::close();
?>

<?php
	
?>
</body>
</html>