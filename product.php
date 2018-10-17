<!DOCTYPE html>
<html>
<head>
	<title>产品管理</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			padding:0px;
			margin:0px;
		}
		label,input,button{
				height: 30px;
				size: 5;
		}
		.STYLE1{
			margin-top:20px;
			font-size:22px;
			font-family:"楷体_utf8";
			text-align: center;
		}
		.product{
			text-align: center;
			padding-top: 10px;
		}
		.product1{
				height: 50px;
				float:center;
				padding-top: 10px;
		}
	</style>
</head>
<body>
	<div class="product">
		<font face="幼圆" size="5" color="#008000"><b>添加产品</b>
		</font>
		<div class="product1">
			<form action="addproduct.php" method="POST" style="margin:0">
				<label>产品名称:</label><input type="text" name="addproduct" class="addproduct" placeholder="请输入要添加的产品名称">
				<button sype="submit" name="submit" class="submit">添加</button>
			</form>
		</div>
	</div>
	<?php 
		require "fun.php";
		$sql="select * from and_product";
		$result=mysqli_query($conn,$sql);
		$total=mysqli_num_rows($result);//结果集中行的数目
		$page=isset($_GET['page'])?intval($_GET['page']):1;//当前页；获取地址栏中page的值，不存在设为1
		$num=5;//每页显示12条记录
		$bothNum=4;
		$url='product.php';//本页url
		$pagenum=ceil($total/$num);//总页数，最后一页
		$new_sql=$sql." limit ".($page-1)*$num.",".$num;//按每页记录生成查询语句
		$new_result=mysqli_query($conn,$new_sql);
		$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
		if($new_row=mysqli_fetch_array($new_result)){
				echo "<center><font size=5 face=楷体_GB2312 color=#008000><b>产品查看</b></font></center>";
				echo "<table width=500 border=1 align=center class=STYLE1>";
				echo "<tr>";
				echo "<td>产品id</td>";
				echo "<td>产品名称</td>";
				echo "</tr>";
			do
			{
				list($product_id,$product_name)=$new_row;
				echo "<tr>";
				echo "<td>$product_id</td>";
				echo "<td>$product_name</td>";
				echo "</tr>";
			}while($new_row=mysqli_fetch_array($new_result));
			echo "</table>";
			$pagenav="";
		if($page==1){
	    	$pagestr.='<span>上一页</span>';
		}else{
		    $lastPage=$page-1;
		    $pagenav.="<a href='$url?page=$lastPage'>上一页</a>"."  ";
		}
		if($page-$bothNum>1){
		    $pagenav.="<a href='$url?page=1'>首页</a>";
		    $pagenav.="<span>...</span>";
		}
		//当前页的左边
		for($i=$bothNum;$i>=1;$i--){
		    if(($page - $i) < 1 ) { // 当前页左边花最多 bothnum 个数字
		         continue;
		     }
		    $lastPage=$page-$i;
		    $pagenav.="<a href='$url?page=$lastPage'>$lastPage</a>"."  ";
		}
		//当前页
		$pagenav.="<span>$page</span>"."  ";
		//当前页右边
		for($i=1;$i<=$bothNum;$i++){
		    if(($page + $i) > $pagenum) { // 当前页右边最多 bothnum 个数字
		        break;
		    }
		    $lastPage=$page+$i;
		    $pagenav.="<a href='$url?page=$lastPage'>$lastPage</a>"."  ";
		}
		//尾页
		if(($cur_page+$bothNum)<$pagenum){
		    $pagenav.="<span>...</span>"."  ";
		    $pagenav .= '<a href="?page='.$pagenum.'">尾页</a>'."  ";
		}
		//下一页
		if($pagenum==1){
			$pagenav .='';
		}else if($page == $pageNum) {
	    	$pagenav .= '<span>下一页</span>';
		} else {
	       $nextPage=$page+1;
	       $pagenav .= "<a href='$url?page={$nextPage}'>下一页</a>";
	  	}
			$pagenav.="共(".$pagenum.")页";
			//输出分页导航
			echo "<br><div align=center class=STYLE1><b>".$pagenav."</b></div>";
		}else
		echo "<script>alert('无记录！');location.href='product.php';</script>";
		?>
		<div class="product">
			<font face="幼圆" size="5" color="#008000"><b>删除产品</b></font>
			<div class="product">
				<form action="scproduct.php" method="POST" style="margin:0">
					<label>产品id:</label><input type="text" name="scproduct" class="scproduct" placeholder="请输入要删除的产品id">
					<input name="submit" type="submit" value="删除" onClick="delcfm()" />
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