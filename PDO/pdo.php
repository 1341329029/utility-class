
    <?php   
        header("Content-type:text/html; charset=utf-8");      
        class DBPDO {  
      
            private static $instance;         
            public $dsn;         
            public $dbuser;         
            public $dbpwd;         
            public $sth;         
            public $dbh;   
            //初始化  
            function __construct() {  
                $this->dsn = 'mysql:host='localhost';dbname='admin;  
                $this->dbuser = root;  
                $this->dbpwd = 123456;  
                $this->connect();  
                $this->dbh->query("SET NAMES 'UTF8'");  
                $this->dbh->query("SET TIME_ZONE = '+8:00'");  
            }  
            //连接数据库  
            public function connect() {  
                try {  
                    $this->dbh = new PDO($this->dsn, $this->dbuser, $this->dbpwd);  
                }  
                catch(PDOException $e) {  
                    exit('连接失败:'.$e->getMessage());  
                }  
            }  
            //插入数据  
            public function insert($sql) {  
                if($this->dbh->exec($sql)) {  
                    $this->getPDOError();  
                    return $this->dbh->lastInsertId();  
                }  
                return false;  
            }  
            //删除数据  
            public function delete($sql) {  
                if(($rows = $this->dbh->exec($sql)) > 0) {  
                    $this->getPDOError();  
                    return $rows;  
                }  
                else {  
                    return false;  
                }  
            }  
            //更改数据  
            public function update($sql) {  
                if(($rows = $this->dbh->exec($sql)) > 0) {  
                    $this->getPDOError();  
                    return $rows;  
                }  
                return false;  
            }  
      
            //获取数据  
            public function select($sql) {  
                $this->sth = $this->dbh->query($sql);  
                $this->getPDOError();  
                $this->sth->setFetchMode(PDO::FETCH_ASSOC);  
                $result = $this->sth->fetchAll();  
                $this->sth = null;  
                return $result;  
            }  
            //关闭连接  
            public function __destruct() {  
                $this->dbh = null;  
            }  
        }  
      
        //eg: an example for operate select  
      
        $test = new DBPDO;  
      
        $sql = "SELECT * FROM `user` WHERE `id`=1";  
      
        $rs = $test->select($sql);  
      
        print_r($rs);  
          
      
      
      
      
    ?>