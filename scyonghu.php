<?php
	require "fun.php";
    // require "public_sql.php";
    // dbInit();
    header("Content-type:text/html;charset=utf-8");
    if (isset($_POST['submit'])) {
    //接收表单数据 trim标签是去除空格
    $scyonghu = trim($_POST['scyonghu']);
	}
     if(empty($scyonghu))
    {
        echo "<script>alert('删除的用户id不能为空！');location.href='yonghu.php';</script>";//若用户名或密码为空则跳出警告窗口
    }else if(!(mysqli_fetch_array(mysqli_query($conn,"select userId from and_user where userId = '$scyonghu'")))){
        echo "<script>alert('该用户id不存在');window.location.href='yonghu.php'</script>";
    }else{
        $sql= "delete from and_user where userId = '$scyonghu'";
        //插入数据库
    if(!(mysqli_query($conn,$sql))){
        echo "<script>alert('数据删失败');window.location.href='yonghu.php'</script>";
        }else{
        echo "<script>alert('用户删除成功!');window.location.href='yonghu.php'</script>";
        }
    }
?>