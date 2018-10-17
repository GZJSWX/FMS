<?php
	require "public_sql.php";
	require "test.php";
	dbInit();
	$wjid = $_GET['wjid'];
	//下载文件功能
	if($wjid != "")
	{
	    $sql = "select * from and_file where file_id = $wjid";
	    if($downloadfile = fetchRow($sql))
	    {
	        //获取文件大小
	        $path = $downloadfile['file_save'];
	        $file_dir = dirname($path);
	        $name = $downloadfile['file_name'];
	        xiazai($file_dir,$name);
	    }else
	    {
	    	echo "该文件不存在!";
	    } 
	}else{
    	echo "数据请求错误!";
    }
?>  
