<!DOCTYPE html>
<html lang="en">
<head>
	<title>Transfer Saldo</title>
</head>
<body>
<?php
	echo Form::open(array(
		'action'=>'EWalletController@total_saldo_caller', 
		'method' => 'post'
	));

	echo '<div>';
	echo Form::label('user_id', 'User ID');
	echo ' : ';
	echo Form::text('user_id', null, array('class' => 'form-control'));
	echo '</div>';

	echo Form::submit('Kirim', array('class' => 'btn btn-success'));
	echo Form::close();
?>

<?php
	
?>
</body>
</html>