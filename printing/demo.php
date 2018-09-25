<?php 
	function createWord($content='',$ip){
	    $content='<html 
	            xmlns:o="urn:schemas-microsoft-com:office:office" 
	            xmlns:w="urn:schemas-microsoft-com:office:word" 
	            xmlns="http://www.w3.org/TR/REC-html40">
	            <meta charset="UTF-8" />您的ip是：'.$ip."<br>".$content.'</html>';
	        $time = time();
	        //最后为1，代表为打印打印完成后为0
	        $fileName = "upload_".$time."_".rand(1000,9999)."_1.doc";
	        file_put_contents("./static/".$fileName,$content);
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	$content = $_POST['content'];
	if(empty($content)){
		echo "输入东西啊，老哥<br>";
	}
	createWord($content,$ip);
	echo "3秒后跳转。。。。。。。。";
	header('Refresh: 3; url=./index.php');
?>