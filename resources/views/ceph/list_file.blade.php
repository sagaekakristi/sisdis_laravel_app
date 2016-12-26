<!DOCTYPE html>
<html lang="en">
<head>
	<title>List Object</title>
</head>
<body>

<h1>List Object: <?php echo $bucket_name; ?></h1>

<?php
foreach($list_of_object as $object_name){
    $url = url('ceph/' . $bucket_name . '/' . $object_name);
    $link = '<a href="' . $url . '">' . $object_name . '</a>' . '<br>';
    echo $link;
}
?>

</body>
</html>