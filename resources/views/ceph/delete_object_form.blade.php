<!DOCTYPE html>
<html lang="en">
<head>
	<title>Delete Object</title>
</head>
<body>

<h1>Delete Object</h1>

<?php
echo Form::open(array('action'=>'CephConsumer@delete_object_receiver', 'method' => 'post'));

echo '<div>';
echo Form::label('bucket_name', 'Bucket Name');
echo ' : ';
echo Form::text('bucket_name', null, array('class' => 'form-control'));
echo '</div>';

echo '<div>';
echo Form::label('object_name', 'Object Name');
echo ' : ';
echo Form::text('object_name', null, array('class' => 'form-control'));
echo '</div>';

echo Form::submit('Delete');
echo Form::close();
?>

</body>
</html>