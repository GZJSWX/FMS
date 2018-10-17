<?php 
    require "fun.php";
    $sj = $_GET['sj'];
    if($sj == "cp"){
    	$sql = mysqli_query($conn,"select * from and_product");
    	$a[] = mysqli_fetch_assoc($sql);
    	$json = array($a);
    	echo json_encode($json);
    }else{
    	echo "数据请求错误!";
    }
?>    