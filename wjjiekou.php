<?php
	require "fun.php";
	$cpid = $_GET['cpid'];
	$wjid = $_GET['wjid'];
	if($cpid !== ""){
		$sql = mysqli_query($conn,"select * from and_file where product_id = $cpid");
		while ($row = mysqli_fetch_row($sql)) {
			$a[] = $row[0];
		}
    	$json = array($a);
    	echo json_encode($json);
	}
	if($wjid !== ""){
		$sql = mysqli_query($conn,"select * from and_file where file_id = $wjid");
    	$s = mysqli_fetch_assoc($sql);
    	$json = array($s);
    	echo json_encode($json);
	}
	else{
    	echo "数据请求错误!";
    }
?>  
	