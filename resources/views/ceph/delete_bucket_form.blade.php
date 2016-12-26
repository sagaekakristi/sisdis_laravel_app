<!DOCTYPE html>
<html lang="en">
<head>
	<title>Delete Bucket</title>
</head>
<body>

<h1>Delete Bucket</h1>

<?php
echo Form::open(array('action'=>'CephConsumer@delete_bucket_receiver', 'method' => 'post'));

echo '<div>';
echo Form::label('bucket_name', 'Bucket Name');
echo ' : ';
echo Form::text('bucket_name', null, array('class' => 'form-control'));
echo '</div>';

echo Form::submit('Delete');
echo Form::close();
?>

</body>
</html>