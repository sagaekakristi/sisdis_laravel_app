<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tugas</title>
</head>
<body>

<?php
echo Form::open(array('action'=>'Tugas4Controller@upload_image_ui_receiver', 'method' => 'post'));
echo Form::hidden('dummy', 'this is just a dummy');

echo '<div>';
echo Form::label('file_label', 'File');
echo ':';
echo Form::file('file_image', '', array('id'=>'','class'=>''));
echo '</div>';

echo Form::submit('Unggah', array('class' => 'btn btn-success'));
echo Form::close();
?>

</body>
</html>