
<?php 
	error_reporting(E_ALL&~E_NOTICE);
	if(!isset($_GET['password']) && $_GET['password'] != "wsx"){
		return;
	}
 ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>admin</title>
	<style>
		table
        {
            border-collapse: collapse;
            margin: 0 auto;
            text-align: center;
        }
       	td
        {
            border: 1px solid #cad9ea;
            color: #666;
            height: 30px;
        }
      	th
        {
            background-color: #CCE8EB;
            width: 100px;
        }
       tr:nth-child(odd)
        {
            background: #fff;
        }
        tr:nth-child(even)
        {
            background: #F5FAFA;
        }
		input{
			margin-left:10px;
			float: left;
		}
	</style>
</head>
<body>
	<div>
		<table>
		<tr>
			<th>文件名</th>
			<th style="width: 250px;">操作</th>
		</tr>
			<?php 
				function listDir($dir){
					$handle = opendir($dir);
					if ($handle) {
						while (($file = readdir($handle)) !== false){
							if($file !== "." && $file !== ".."&&mb_substr($file, 0,1) !== '~'){
								if (intval(substr($file,-5,1)) == 0) {
									continue;
								}
								$file = iconv("gb2312","utf-8",$file);
								echo "<tr><td>$file</td><td>
								<form action='./printing.php?id=1' method='post'>
								<input type='submit' value='打印机1'>
								<input type='hidden' value='$file' name='filename'>
								</form>
								<form action='./printing.php?id=2' method='post'>
								<input type='submit' value='打印机2'>
								<input type='hidden' value='$file' name='filename'>
								</form>
								<form action='./printing.php?id=3' method='post'>
								<input type='submit' value='打印机3'>
								<input type='hidden' value='$file' name='filename'>
								</form>
								</td></tr>";
							}
						}
					}
				}
				listDir("./static");
			 ?>
		</table>
	</div>
</body>
</html>