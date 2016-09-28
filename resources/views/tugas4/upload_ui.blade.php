<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tugas</title>
</head>
<body>

<?php
echo Form::open(array('action'=>'Tugas4Controller@upload_image_ui_receiver', 'files'=>true, 'method' => 'post'));
echo Form::hidden('dummy', 'this is just a dummy');

echo '<div>';
echo Form::label('file', 'File');
echo ':';
echo Form::file('file', '', array('id'=>'','class'=>''));
echo '</div>';

echo Form::submit('Unggah');
echo Form::close();
?>

</body>
</html>