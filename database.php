<?php 
header("Content-type: text/html; charset=utf-8");
//判断连接结果
//资源永远为true
$link = @mysql_connect('localhost','root','180811');//连接数据库
if (!$link) {
    echo "数据库连接失败<br/>";
    echo '错误编码是:'.mysql_errno().'<br/>';
    echo '错误信息是:'.iconv('GBK','utf-8',mysql_error()).'<br/>';//MYSQL默认是gbk因此需要转换成utf-8
    exit;//终止脚本
}
mysql_select_db('ANDROID',$link);//打开数据库
mysql_query("SET NAMES utf8");//设置字符集

function query($sql)//错误封装函数，判断是否错误
{
    $res = mysql_query($sql);
    if (!$res) {
    echo "sql语句有错<br/>";
    echo "错误编码是：".mysql_errno().'<br/>';
    echo '错误信息是:'.iconv('GBK','utf-8',mysql_error()).'<br/>';
    exit;
    }
return $res;
}
?>