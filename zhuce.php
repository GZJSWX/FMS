<?php
include 'fun.php';
 // require "public_sql.php";
 // dbInit();
 header("Content-type:text/html;charset=utf-8");
 if(isset($_POST['submit'])){
 	$username = $_POST['username'];
 	$password = $_POST['password'];
 	$confirm = $_POST['confirm'];
 	$bumen = $_POST['bumen'];
 }
 if(empty($username) || empty($password) || empty($confirm) || empty($bumen))
 {
 	echo "<script>alert('信息不能为空！重新填写');window.location.href='zhuce.html'</script>";
 } elseif ((strlen($username) < 3)||(!preg_match('/^\w+$/i', $username))) {
 	echo "<script>alert('用户名至少3位且不含非法字符！重新填写');window.location.href='zhuce.html'</script>";
 	//判断用户名长度
 }elseif(strlen($password) < 5){
 	echo "<script>alert('密码至少5位！重新填写');window.location.href='zhuce.html'</script>";
 	//判断密码长度
 }elseif($password != $confirm) {
 	echo "<script>alert('两次密码不相同！重新填写');window.location.href='zhuce.html'</script>";
 	//检测两次输入密码是否相同
 }elseif(!(mysqli_fetch_array(mysqli_query($conn,"select departName from and_depart where departName = '$bumen'")))){
 	echo "<script>alert('该部门不存在');window.location.href='zhuce.html'</script>";
 }elseif(mysqli_fetch_array(mysqli_query($conn,"select userName from and_user where userName = '$username'"))){
 	echo "<script>alert('用户名已存在');window.location.href='zhuce.html'</script>";
 } else{
 	$sql= "insert into and_user(userName,userPassword,userDepart) values('$username',md5('$password'),'$bumen')";
 	//插入数据库
 	if(!(mysqli_query($conn,$sql))){
 		echo "<script>alert('数据插入失败');window.location.href='zhuce.html'</script>";
 	}else{
 		echo "<script>alert('注册成功!请登录');window.location.href='index.html'</script>";
 	}
 }
?>