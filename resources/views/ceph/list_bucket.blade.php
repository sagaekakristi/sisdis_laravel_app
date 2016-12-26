<!DOCTYPE html>
<html lang="en">
<head>
	<title>List Bucket</title>
</head>
<body>

<h1>List Bucket</h1>

<?php
foreach($list_of_bucket as $bucket_name){
    $url = url('ceph/' . $bucket_name);
    $link = '<a href="' . $url . '">' . $bucket_name . '</a>' . '<br>';
    echo $link;
}
?>

</body>
</html>