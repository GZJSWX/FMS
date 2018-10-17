<?php
	require "fun.php";
    // require "public_sql.php";
    // dbInit();
    header("Content-type:text/html;charset=utf-8");
    if (isset($_POST['submit'])) {
    //接收表单数据 trim标签是去除空格
    $scproduct = trim($_POST['scproduct']);
	}
     if(empty($scproduct))
    {
        echo "<script>alert('删除的产品id不能为空！');location.href='product.php';</script>";//若用户名或密码为空则跳出警告窗口
    }else if(!(mysqli_fetch_array(mysqli_query($conn,"select product_id from and_product where product_id = '$scproduct'")))){
        echo "<script>alert('该产品id不存在');window.location.href='product.php'</script>";
    }else{
        $sql= "delete from and_product where product_id = '$scproduct'";
        //插入数据库
    if(!(mysqli_query($conn,$sql))){
        echo "<script>alert('数据删失败');window.location.href='product.php'</script>";
        }else{
        echo "<script>alert('产品删除成功!');window.location.href='product.php'</script>";
        }
    }
?>