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
echo Form::label('urlWsdl', 'URL WSDL');
echo ':';
echo Form::text('urlWsdl', null, array('class' => 'form-control'));
echo '</div>';

echo '<div>';
echo Form::label('helloInputMessage', 'String Dikirim');
echo ':';
echo Form::text('helloInputMessage', null, array('class' => 'form-control'));
echo '</div>';

echo Form::submit('Kirim', array('class' => 'btn btn-success'));
echo Form::close();
?>

</body>
</html>