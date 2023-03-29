<?php 

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbHandler;
    private $statement;

    public function __construct()
    {
        $this->ConnectionMySql();
    }

    private function ConnectionMySql()
        {
            // For mysql
            $conn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            try 
            {
                $this->dbHandler = new PDO($conn, $this->user, $this->pass, $options);
            } 
            catch(PDOException $ex) 
            {
                error_log("ERROR : Failed to connect mySql database!", 0);
                die('ERROR : Failed to connect mySql database '. $ex->getMessage());
            }
        }

        private function ConnectionSqlServer()
        {
            // For SqlServer
            $conn = 'sqlsrv:server=' . $this->host . ';Database=' . $this->dbname;
            $options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

            try 
            {
                $this->dbHandler = new PDO($conn, $this->user, $this->pass);
                error_log("INFO : APP has been connected with SqlServer database!", 0);
            } 
            catch(PDOException $ex) 
            {
                error_log("ERROR : Failed to connect SqlServer database!", 0);
                die('ERROR : Failed to connect SqlServer database! '. $ex->getMessage());
            }
        }

    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function bind($parameter, $value, $type = null)
    {
        if (is_null($type)) {
            switch($value) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break; 
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    public function execute()
    {
        return $this->statement->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }
} 