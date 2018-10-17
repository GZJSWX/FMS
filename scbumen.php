<?php
	require "fun.php";
    // require "public_sql.php";
    // dbInit();
    header("Content-type:text/html;charset=utf-8");
    if (isset($_POST['submit'])) {
    //接收表单数据 trim标签是去除空格
    $scbumen = trim($_POST['scbumen']);
	}
     if(empty($scbumen))
    {
        echo "<script>alert('删除的部门id不能为空！');location.href='bumen.php';</script>";//若用户名或密码为空则跳出警告窗口
    }else if(!(mysqli_fetch_array(mysqli_query($conn,"select departID from and_depart where departID = '$scbumen'")))){
        echo "<script>alert('该部门id不存在');window.location.href='bumen.php'</script>";
    }else{
        $sql= "delete from and_depart where departID = '$scbumen'";
        //插入数据库
    if(!(mysqli_query($conn,$sql))){
        echo "<script>alert('数据删失败');window.location.href='bumen.php'</script>";
        }else{
        echo "<script>alert('部门删除成功!');window.location.href='bumen.php'</script>";
        }
    }
?>