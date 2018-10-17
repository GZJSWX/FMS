<?php
    require "fun.php";
    // require "public_sql.php";
    // dbInit();
    header("Content-type:text/html;charset=utf-8");
    if (isset($_POST['submit'])) {
    //接收表单数据 trim标签是去除空格
    $addbumen = trim($_POST['addbumen']);
    //合法性验证 empty标签判断值是否为空
    }
    if(empty($addbumen))
    {
        echo "<script>alert('添加的部门名称不能为空！');location.href='bumen.php';</script>";//若用户名或密码为空则跳出警告窗口
    }else if(mysqli_fetch_array(mysqli_query($conn,"select departName from and_depart where departName = '$addbumen'"))){
        echo "<script>alert('该部门已存在');window.location.href='bumen.php'</script>";
    }else{
        $sql= "insert into and_depart(departName) values('$addbumen')";
        //插入数据库
        if(!(mysqli_query($conn,$sql))){
        echo "<script>alert('数据插入失败');window.location.href='bumen.php'</script>";
        }else{
        echo "<script>alert('部门添加成功!');window.location.href='bumen.php'</script>";
        }
    }
?>