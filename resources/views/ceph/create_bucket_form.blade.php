<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create New Bucket</title>
</head>
<body>

<h1>Create New Bucket</h1>

<?php
echo Form::open(array('action'=>'CephConsumer@create_bucket_receiver', 'method' => 'post'));

echo '<div>';
echo Form::label('bucket_name', 'Bucket Name');
echo ' : ';
echo Form::text('bucket_name', null, array('class' => 'form-control'));
echo '</div>';

echo Form::submit('Create');
echo Form::close();
?>

</body>
</html>