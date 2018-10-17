<?php
    require "fun.php";
    // require "public_sql.php";
    // dbInit();
    header("Content-type:text/html;charset=utf-8");
    if (isset($_POST['submit'])) 
    {
    //接收表单数据 trim标签是去除空格
    $addName = trim($_POST['addName']);
    $addPassword = trim($_POST['addPassword']);
    $addDepart = trim($_POST['addDepart']);
    //合法性验证 empty标签判断值是否为空
    }
    if(empty($addName) || empty($addPassword) || empty($addDepart)){
        echo "<script>alert('所填写的内容不能为空！');location.href='yonghu.php';</script>";//若用户名或密码为空则跳出警告窗口
    }elseif((strlen($addName) < 3)||(!preg_match('/^\w+$/i', $addName))) {
        echo "<script>alert('用户名至少3位且不含非法字符！重新填写');window.location.href='yonghu.php'</script>";
    //判断用户名长度
    }elseif(strlen($addPassword) < 5){
        echo "<script>alert('密码至少5位！重新填写');window.location.href='yonghu.php'</script>";
    //判断密码长度
    }elseif(!(mysqli_fetch_array(mysqli_query($conn,"select departName from and_depart where departName = '$addDepart'")))){
        echo "<script>alert('该部门不存在');window.location.href='yonghu.php'</script>";
    }elseif(mysqli_fetch_array(mysqli_query($conn,"select userName from and_user where userName = '$addName'"))){
        echo "<script>alert('用户名已存在');window.location.href='yonghu.php'</script>";
    }else{
        $sql= "insert into and_user(userName,userPassword,userDepart) values('$addName',md5('$addPassword'),'$addDepart')";
        //插入数据库
        if(!(mysqli_query($conn,$sql))){
            echo "<script>alert('数据插入失败！');window.location.href='yonghu.php'</script>";
        }else{
            echo "<script>alert('添加成功！');window.location.href='yonghu.php'</script>";
        }
    }
?>