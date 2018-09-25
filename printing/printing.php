<?php 	
	header("Content-Type:text/html;charset=UTF-8");
	/**
	 * *
	 * @param  [type] $fileName 文件名
	 * @param  [type] $id       打印机id
	 * @return [type]          	返回是否成功
	 */
	class Printing{
		public function listDir($dir){
			$handle = opendir($dir);
			if ($handle) {
				echo "<table>";
				while (($file = readdir($handle)) !== false){
					if($file !== "." && $file !== ".."&&mb_substr($file, 0,1) !== '~'){
						if (intval(substr($file,-5,1)) == 0) {
							continue;
						}
						$file = iconv("gb2312","utf-8",$file);
						echo "<tr><td>$file</td><td>
						<button type='button' onclick='printing(\"$file\")'>打印</button>
						</td></tr>";
					}
				}
				echo "</table>";
			}
		}
		public function rename($fileName){
			$pos = strpos($fileName,'.');
			//新名字为0，代表打印了
			$newName = substr($fileName,0,$pos-1)."0.doc";
			if(rename("./static/".$fileName,"./static/".$newName)){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
	if(!empty($_GET)){
		$action = $_GET['par'];
		$obj = new Printing();
		if($action == 'listDir'){
			$obj->$action("./static");
		}
		if($action == 'rename'){
			$obj->$action($_GET['fileName']);
		}
	}
		
 ?>