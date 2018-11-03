<?php

header("Content-type:text/html; charset=utf-8");  
  
    define('DB_HOST', '127.0.0.1');//本地地址  
    define('DB_USER', 'root'); //用户名 
    define('DB_PWD', '123456'); //密码 
    define('DB_NAME', 'test'); //操作数据库

class MSQL
{
	//构造函数数据库连接
	function __construct()
	{
		$this->mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PWD,DB_NAME);
		if(mysqli_connect_error()){//判断连接状况
			printf (mysqli_connect_error() );
			 exit();
		}
	}
	//数据库台添加函数操作
	function insert($table,$data)//（表名,数组型数据）
	{
		$key = implode(",",array_keys($data));//获取数组的key值并拼接成以,分隔字符串
		$sql ="INSERT into $table ($key) values";
		$sql .= "('".implode("','",$data)."')";//获取数组元素值
		if ($result = mysqli_query($this->mysqli,$sql)) {
			return true;
		}else{
			return mysqli_errno($this->mysqli); //返回报错原因
		}		 	
	}
	//删除操作函数
	function delete($table,$where)//(表名,地点)
	{
		$sql ="DELETE FROM $table where $where";
		if ($result = mysqli_query($this->mysqli,$sql)) {
			return true;
		}else{
			return mysqli_errno($this->mysqli); //返回报错原因
		}
	}
	//更新操作函数
	function update($table,$data,$where)//（表名,数组数据,地点）
	{
		$sql ="UPDATE $table SET ";
		foreach ($data as $key => $value) {
			$sql .= "`{$key}`='{$value}',";
		}
		$sql = rtrim($sql,",");
		$sql.="WHERE"." $where";
		if ($result = mysqli_query($this->mysqli,$sql)) {
			return true;
		}else{
			return mysqli_errno($this->mysqli);//返回报错原因
		}
	}
	//查找操作函数
	function select($table,$where='',$what='*')//(表名,地点,列名)地点默认空，列名默认*
	{
		$sql ="SELECT $what FROM $table";
		if ($where) {
			$sql.=" where $where";
		}
		if ($result = mysqli_query($this->mysqli,$sql)) {
			$data=array();
			while ($row = mysqli_fetch_assoc($result)) {//循还打印数据组合到data数组中
				$data[]=$row;
			}
			return $data;

		}else{

			return mysqli_errno($this->mysqli); //返回报错原因
		}
	}

   function __destruct(){//对象销毁自动调用关闭mysql
	   	if (mysqli_close($this->mysqli)) {
	   		return true;
	   	}else{
	   		return  mysqli_errno($this->mysqli);//返回报错原因
	   	 

	   }
   	}
}
	
// $a = new MSQL;
//查找实例
// $sql="user_id IN (1,3)";
// $b=$a->select('user_info',$sql,"user_name");
//添加实例
// $sql = array('user_name'=>'是你哥','user_age'=>55);
// $b = $a->insert('user_info',$sql);
//删除实例
//  $sql = "user_id=88";
// $b = $a->delete('user_info',$sql);
//更新实例
//  $sql = array('user_name'=>'是哥','user_age'=>55);
// $b = $a->update('user_info',$sql,'user_id=1');
// var_dump($b);
?>
