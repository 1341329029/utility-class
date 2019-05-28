<?php

/**
 * 单例模式的DB数据库工具类
 * author: lucifer赫神
 * date:2019-05-28
 */
class Db
{
	//私有静态的保存对象的属性
	private static $obj=null;

	//私有的数据库配置信息
	private $db_host; //主机名
	private $db_user; //用户名
	private $db_pass; //密码
	private $db_name; //数据库名
	private $charset; //字符集
	private $link ;   //连接对象

	//私有构造方法防止new对象
	private function __construct($config=array())
	{
		$this->db_host = $config['db_host'];
		$this->db_user = $config['db_user'];
		$this->db_pass = $config['db_pass'];
		$this->db_name = $config['db_name'];
		$this->charset = $config['charset'];
		//一个方法只做一件事
		$this->connectDb(); //连接MySQL服务器
		$this->selectDb(); //选择数据库
		$this->setCharset(); //设置字符集
	}
	//私有克隆方法，防止克隆
	private function __clone(){

	}
	public static function getInstance($config=array()){
		if (!self::$obj instanceof self) {
			self::$obj = new self($config);
		}
		return self::$obj;
	}
	//私有的连接MySQL服务器方法
	private function connectDb()
	{
		if(!$this->link = @mysqli_connect($this->db_host, $this->db_user, $this->db_pass))
		{
			echo "连接MySQL服务器失败！";
			die();
		}
	}

	//私有的选择数据库的方法
	private function selectDb()
	{
		if(!mysqli_select_db($this->link, $this->db_name))
		{
			echo "选择数据库{$this->db_name}失败！";
			die();
		}
	}

	//私有的设置字符集
	private function setCharset()
	{
		mysqli_set_charset($this->link, $this->charset);
	}

	//公共的执行SQ语句方法：insert,update,delete,set,drop等
	//执行成功返回true,执行失败返回false
	public function deal($sql){
		//将字符串转化为全小写
		$sql = strtolower($sql);
		//判断是否为SELECT语句
		if (substr($sql,0,6)=='select') {
			//返回die
			echo "请调用专用SELECT查询方法";
			die();
		}
		//返回执行结果
		return mysqli_query($this->link,$sql);

	}

	//私有执行SQL语句方法：select
	//执行成功返回对象，失败返回flase
	private function query($sql){
		
		//判断是不是SELECT语句
		if(substr($sql,0,6)!='select')
		{
			echo "不能执行非SELECT语句！";
			die();
		}		

		//返回执行的结果(结果集对象)
		return mysqli_query($this->link, $sql);	

	}

	//公共的获取单行数据的方法
	public function fetchOne($sql,$type=3)
	{
		//执行SQL语句，并返回结果集对象
		$result = $this->query($sql);

		//定义返回数组类型的常量
		$types = array(
				1 => MYSQLI_NUM,
				2 => MYSQLI_BOTH,
				3 => MYSQLI_ASSOC,
			);

		//返回一维数组
		return mysqli_fetch_array($result, $types[$type]);
	}

	//公共的获取多行数据的方法
	public function fetchAll($sql, $type=3)
	{
		//执行SQL语句，并返回结果集对象
		$result = $this->query($sql);

		//定义返回数组类型的常量
		$types = array(
				1 => MYSQLI_NUM,
				2 => MYSQLI_BOTH,
				3 => MYSQLI_ASSOC,
			);

		//返回二维数组
		return mysqli_fetch_all($result, $types[$type]);
	}

	//获取记录数
	public function rowCount($sql)
	{
		//执行SQL语句，并返回结果集对象
		$result = $this->query($sql);
		//返回记录数
		return mysqli_num_rows($result);
	}

	//公共析构函数设置关闭mysql
	public function __destruct(){
		mysqli_close($this->link);
	}
}
	$arr=[
		'db_host' => 'localhost',
		'db_user' => 'root',
		'db_pass' => '123456',
		'db_name' => 'test',
		'charset' => 'utf8'
	];
	$obj = Db::getInstance($arr);
	var_dump($obj);
?> 
