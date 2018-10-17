<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
header("Content-Type:text/html;charset=utf-8");
//载入数据库操作文件
require "public_sql.php";
//初始化连接数据库操作
dbInit();
//获取当前目录的id
$folder_id=isset($_GET['folder'])?intval($_GET['folder']):0;
//网盘文件列表
//请求目录不是根目录时,获取当前访问目录的信息
$path=array();
if($folder_id!=0)
{
    //根据当前目录ID查询目录列表
    $sql="select folder_name,folder_path from and_folder where folder_id = $folder_id";
    $current_folder=fetchRow($sql);
    $file_ids=$current_folder['folder_path'];
    //根据ID路径查询所有父级目录的信息
    if($file_ids!="")
    {
        $sql="select folder_id,folder_name from and_folder where folder_path in('$file_ids')";
        $path=fetchAll($sql);
        //将当期目录追加到路劲数组的末尾
        $path[]=array(
            'folder_id'=>$folder_id,
            'folder_name'=>$current_folder['folder_name']
        );
    }
}
//获取指定目录下的所有文件夹
$sql="select folder_id,folder_name,folder_time from and_folder where folder_pid = $folder_id";
$folder=fetchAll($sql);
//获取指定目录下的所有文件
$sql="select file_id,file_name,file_save,file_size,file_time from and_file where folder_id = $folder_id ";
$file=fetchAll($sql);
require "main.php";

//获取表单传来的数据
$newfolder=isset($_POST['newfolder'])?trim($_POST['newfolder']):"";
//创建文件夹功能
// $dir = iconv("UTF-8","GBK","./uploads/$newfolder/");
$dir = "./uploads/$newfolder/";
if($newfolder == '')
{
    //echo "<script>alert('文件夹不能为空!');location.href='wenjian.php';</script>";
}
else
{
   $sql="select folder_name from and_folder where folder_pid='$folder_id' AND folder_name='$newfolder'";
    $allfolder=fetchRow($sql);
    if($allfolder)
    {
        echo "<script>alert('文件夹不能重复!');location.href='wenjian.php';</script>";
    }
    else
    {
        //正常创建的情况下
        if (!file_exists($dir))
        {
            mkdir ($dir,0777,true);
            // $dir = iconv("GBK","UTF-8","$dir");
            $sql="insert into and_folder (folder_name,folder_time,folder_path,folder_pid) values('$newfolder',now(),'$dir',$folder_id)";
            var_dump($sql);
            $result=query($sql);
        }
        if($result)
        {
            //echo "<script>alert('创建成功!');location.href='wenjian.php';</script>";
        }
        else
        {
            //echo "<script>alert('创建失败!');location.href='wenjian.php';</script>";
        }
    } 
}
    

//获取post提交的上传文件的信息
$uploadfile=isset($_FILES['file'])?$_FILES['file']:"";
$product_id=isset($_POST['product'])?$_POST['product']:"";
$hz = $uploadfile['name'];
$file_hz = pathinfo($hz,PATHINFO_EXTENSION);
//上传文件功能
//$uploadfile=iconv("GBK", "UTF-8", "$file");
if(!empty($uploadfile) && !empty($product_id))
{
    if($file_hz == 'jpg' || $file_hz == 'pdf')
    {
        if($uploadfile['error']==0)
        {
            //上传成功
            $uploadfile_name=trim($uploadfile['name']);
            //判断文件名是否存在
            $sql="select file_name from and_file  where file_name='$uploadfile_name' and folder_id=$folder_id";
            $sql1="select * from and_folder where folder_id=$folder_id";
            $dns=fetchRow($sql1);
            $name=$dns['folder_name'];
            $allfolder=fetchRow($sql);
            if($allfolder)
            {
                echo "<script>alert('上传的文件不能重名!');location.href='wenjian.php';</script>";
            }
            else
            {
            //文件未重名的情况
            //保存路径
            //iconv("UTF-8", "GBK", "./uploads/$newfolder/")
            $uploadfile_save="./uploads/$name/";//保存到/uploads/2018-3-2/里
            if(!file_exists($uploadfile_save))
            {
                mkdir($uploadfile_save,0777,true);
            }
            $new_uploadfile_name="$uploadfile_name";
            $uploadfile_save.=$new_uploadfile_name;
            if(move_uploaded_file($uploadfile['tmp_name'],$uploadfile_save))
            {
                //上传成功,并写入数据库
                $uploadfile_size=$_FILES['file']['size'];
                $sql="insert into and_file (file_name,file_save,file_size,file_time,folder_id,product_id) values('$new_uploadfile_name','$uploadfile_save',$uploadfile_size,now(),$folder_id,$product_id)";
                if(!query($sql))
                {
                    unlink($uploadfile_save);
                    echo "<script>alert('写入数据库失败！');location.href='wenjian.php';</script>";
                }
                else
                {
                    echo "<script>alert('上传成功！');location.href='wenjian.php';</script>";
                }
            }
        }
        }else{
            echo "<script>alert('上传失败！');location.href='wenjian.php';</script>";
        }
    }else{
        echo "<script>alert('请上传pdf或jpg文件!');location.href='wenjian.php';</script>";
    }
}


//删除文件
//获取get参数
$file_id=isset($_GET['file'])?intval($_GET['file']):0;
//复制和删除功能
$action=isset($_GET['action'])?trim($_GET['action']):"";
if($action=="del")
{
    //    unset();
    $sql="select * from and_file where file_id = $file_id";
    $del_file=fetchRow($sql);
    unlink($del_file['file_save']);
    //删除数据库里的数据
    $sql1="delete from and_file where file_id = $file_id";
    if(!query($sql1))
    {
        echo "<script>alert('数据库数据删除失败!');location.href='wenjian.php';</script>";
    }
}

//删除目录
//获取get参数
$folder_id=isset($_GET['folder'])?intval($_GET['folder']):0;
//复制和删除功能
$action=isset($_GET['action'])?trim($_GET['action']):"";
if($action=="del")
{
    $sql="select * from and_folder where folder_id = $folder_id";
    $del_file=fetchRow($sql);
    rmdir($del_file['folder_path']);
    //删除数据库里的数据
    $sql="delete from and_file where folder_id = $folder_id";
    if(query($sql))
    {
        $sql1="delete from and_folder where folder_id = $folder_id";
       if(!query($sql1))
       {    
            echo "<script>alert('数据库数据删除失败!');location.href='wenjian.php';</script>";
        }
        else{
            echo  "<script>alert('数据库数据删除成功!');location.href='wenjian.php';</script>";
        }
    }
}