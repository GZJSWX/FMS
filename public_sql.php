<?php
 //初始化数据库连接
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
function dbInit(){
    $link=mysqli_connect('localhost','root','180811','android');
    if(mysqli_connect_errno($link)){
        die('连接数据库失败'.mysqli_connect_error());
    }
}
//查询数据库显示错误信息
function query($sql){
    $link=mysqli_connect('localhost','root','180811','android');
    if($result=mysqli_query($link,$sql)){
        //执行成功
        return $result;
    }else{
        //执行失败,显示错误信息以便于调试程序
        echo 'sql执行失败:<br>';
        echo '错误的sql为:'.$sql.'<br>';
        echo '错误的代码为:'.mysqli_connect_error().'<br>';
        echo '错误的信息为:'.mysqli_connect_errno().'<br>';
        die();
    }
}
//查询所有数据并返回结果集
function fetchAll($sql){
    //执行query()函数
    if($result=query($sql)){
        //执行成功
        //遍历结果集
        $rows=array();
        while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
            $rows[]=$row;
        }
        //释放结果集资源
        mysqli_free_result($result);
        return $rows;
    }else{
        //执行失败
        return false;
    }
}
//查询单条数据并返回结果集
function fetchRow($sql){
    //执行query()函数
    if($result=query($sql)){
        //从结果集取得依次数据即可
        $row=mysqli_fetch_array($result,MYSQL_ASSOC);
        return $row;
    }else{
        return false;
    }
}