<!DOCTYPE html>
<html lang="en">
<head>
	<title>Transfer Saldo</title>
</head>
<body>
<?php
	echo Form::open(array(
		'action'=>'EWalletController@transfer_caller', 
		'method' => 'post'
	));

	echo '<div>';
	echo Form::label('user_id', 'User ID');
	echo ' : ';
	echo Form::text('user_id', null, array('class' => 'form-control'));
	echo '</div>';

	echo '<div>';
	echo Form::label('nilai', 'Nilai');
	echo ' : ';
	echo Form::text('nilai', null, array('class' => 'form-control'));
	echo '</div>';

	echo '<div>';
	echo Form::label('ip_tujuan', 'IP Tujuan (ex: saga.sisdis.ui.ac.id)');
	echo ' : ';
	echo Form::text('ip_tujuan', null, array('class' => 'form-control'));
	echo '</div>';

	echo Form::submit('Transfer', array('class' => 'btn btn-success'));
	echo Form::close();
?>

<?php
	
?>
</body>
</html>