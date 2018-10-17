<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <style type="text/css">
       /* .wenjian{
            float: center;
        }*/
        .wenjian1{
            height: 10px;
            padding-bottom: 20px;
        }
        table{
            height: 100px;
            width: 800px;
            margin: auto;
        }
        h2,div{
            text-align: center;
        }
        .div1,.div2{
            padding-top: 20px;
            height: 30px;
        }
        *{
            padding: 0;
            margin: 0;
        }
        img{
            border: none;
        }
        a{
            text-decoration: none;
        }
        .table{
            margin: 0 auto;
        }
        .table tr{
            height:30px;
        }
    </style>
    <script src="js/jquery.media.js"></script>
    <script type="text/javascript">  
        $(function() {  
            $('a.media').media({width:800, height:600});  
        });  
    </script>  
</head>
<body>
    <div class="table table-hover " border="0" align="center" cellspacing="3" cellpadding="3" width="1000" >
        <tr>
            <th colspan="2" width="100%">
                <font size="6" color="blue" face="arial, helvetica">文件管理系统
                </font>
            </th>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <!--文件列表-->
        <div class="wenjian2">
            <table border="1" cellpadding="3" cellspacing="0">
            <tr bgcolor="skyblue">
                <th>文件名</th>
                <th>大小</th>
                <th>上传时间</th>
                <th>操作</th>
            </tr>
            <!--目录列表-->
            <?php foreach($folder as $v):?>
                <tr>
                    <td><?php echo $v['folder_name'];?></td>
                    <td>-</td>
                    <td><?php echo $v['folder_time'];?></td>
                    <td align="center">
                        <a href="?folder=<?php echo $v['folder_id'];?>">打开</a>
                    </td>
                </tr>
                <?php endforeach;?>
                 <!--文件列表-->
                 <?php foreach($file as $v):?>
                <tr>
                    <td><?php echo $v['file_name']; ?></td>
                    <td><?php echo round($v['file_size']/1024); ?>KB</td>
                    <td><?php echo $v['file_time']; ?></td>
                    <td align="center">
                        <a class="media" href="<?php echo $v['file_save'] ?>">预览</a>
                        |<a href="?file=<?php echo $v['file_id'] ?>&action=del" onClick="delcfm()">删除</a>
                    </td>
                </tr>
                <?php endforeach;?>
        </table>
        </div>
        <div class="div1">
            <form method="POST" enctype="multipart/form-data">
                上传的文件：<input type="file" name="file"><br><br>
                <select name="product">
                    <option value=0>请选择文件所属的产品id</option>
                    <?php
                        $sql="select product_id from and_product";
                        $result=query($sql);
                        while($row=mysqli_fetch_array($result)){
                            echo "<option value='$row[product_id]'>$row[product_id]</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="上传">
            </form>
        </div>
    </div>
    <script language="javascript"> 
        function delcfm() { 
            if (!confirm("确认要删除？")) { 
                window.event.returnValue = false; 
            } 
        } 
    </script> 
</body>
</html>
<script>
</script>