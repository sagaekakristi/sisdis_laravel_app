<!DOCTYPE html>
<html lang="en">
<head>
	<title>Transfer Saldo</title>
</head>
<body>
<?php
	echo Form::open(array(
		'action'=>'EWalletController@ping_caller', 
		'method' => 'post'
	));

	echo Form::submit('Ping!', array('class' => 'btn btn-success'));
	echo Form::close();
?>

<?php
	
?>
</body>
</html>