<!DOCTYPE html>
<html lang="en">
<head>
	<title>Copy Object</title>
</head>
<body>

<h1>Copy Object</h1>

<?php
echo Form::open(array('action'=>'CephConsumer@copy_object_receiver', 'method' => 'post'));

echo '<div>';
echo Form::label('source_bucket_name', 'Source Bucket Name');
echo ' : ';
echo Form::text('source_bucket_name', null, array('class' => 'form-control'));
echo '</div>';

echo '<div>';
echo Form::label('source_object_name', 'Source Object Name');
echo ' : ';
echo Form::text('source_object_name', null, array('class' => 'form-control'));
echo '</div>';

echo '<div>';
echo Form::label('destination_bucket_name', 'Destination Bucket Name');
echo ' : ';
echo Form::text('destination_bucket_name', null, array('class' => 'form-control'));
echo '</div>';

echo '<div>';
echo Form::label('destination_object_name', 'Destination Object Name');
echo ' : ';
echo Form::text('destination_object_name', null, array('class' => 'form-control'));
echo '</div>';

echo Form::submit('Copy');
echo Form::close();
?>

</body>
</html>