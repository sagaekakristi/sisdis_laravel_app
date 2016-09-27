<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tugas</title>
</head>
<body>
	<img src="{{ url('/assets/tugas4/img/' . $image_filename )}}">
	<div>
		Lokasi Pada Server : {{ $image_path }}
	</div>
	<div>
		Ukuran : {{ $image_size }} Byte
	</div>
</body>
</html>