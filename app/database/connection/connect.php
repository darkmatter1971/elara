<?php

class DBConnection
{
    private static $instance;
    private $pdo;
    private $dbName;
    private $dbType;

    private function __construct($dbName, $options = [])
    {
        $this->dbName = $dbName;

        $dotenv = Dotenv\Dotenv::create(__DIR__);
        $dotenv->load();

        $this->dbType = getenv('DB_TYPE_' . strtoupper($dbName));
        $db_host = getenv('DB_HOST_' . strtoupper($dbName));
        $db_port = getenv('DB_PORT_' . strtoupper($dbName));
        $db_name = getenv('DB_NAME_' . strtoupper($dbName));
        $db_user = getenv('DB_USER_' . strtoupper($dbName));
        $db_pass = getenv('DB_PASS_' . strtoupper($dbName));

        switch ($this->dbType) {
            case 'mysql':
                $dsn = "$this->dbType:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8";
                break;
            case 'postgresql':
                $dsn = "$this->dbType:host=$db_host;port=$db_port;dbname=$db_name";
                break;
            case 'sqlite':
                $dsn = "$this->dbType:$db_name";
                break;
            default:
                throw new Exception('Unsupported database type: ' . $this->dbType);
        }

        try {
            $this->pdo = new PDO($dsn, $db_user, $db_pass, $options);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance($dbName, $options = [])
    {
        if (self::$instance === null) {
            self::$instance = new self($dbName, $options);
        }
        return self::$instance->pdo;
    }
}


/**
 * To use the modified DBConnection class, you can call the getInstance() method and pass in the name of the database 
 * that you want to connect to. The getInstance() method will return a PDO instance that is connected to the specified database.
 */

// $pdo = DBConnection::getInstance('DB1');


/**
 * This will create a PDO instance that is connected to the database specified in the .env file with the name DB1.
 *
 * You can then use the PDO instance to execute queries and perform other database operations, 
 * just like you would with a regular PDO object.
 */

//  $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
//  $stmt->execute([':username' => $username, ':password' => $password]);
//  $result = $stmt->fetchAll();
 


/**
 * You can also pass in optional connection options to the getInstance() method, as an array. For example:
 */

// $options = [
//     PDO::ATTR_PERSISTENT => true,
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
// ];
// $pdo = DBConnection::getInstance('DB1', $options);

/**
 * The .env file should contain the following variables:
 */

//  DB_TYPE_DB1=mysql
//  DB_TYPE_DB2=sqlite
 
//  DB_HOST_DB1=your_database_host
//  DB_PORT_DB1=your_database_port
//  DB_NAME_DB1=your_database_name
//  DB_USER_DB1=your_database_username
//  DB_PASS_DB1=your_database_password
 
//  DB_HOST_DB2=your_database_host
//  DB_PORT_DB2=your_database_port
//  DB_NAME_DB2=your_database_name
//  DB_USER_DB2=your_database_username
//  DB_PASS_DB2=your_database_password
 





























// class DBConnect
// {
//     private static $instance;
//     private $pdo;
//     private $dbName;
//     private $dbType;

//     private function __construct($dbName, $options = [])
//     {
//         $this->dbName = $dbName;

//         $dotenv = Dotenv\Dotenv::create(__DIR__);
//         $dotenv->load();

//         $this->dbType = getenv('DB_TYPE');
//         $db_host = getenv('DB_HOST_' . strtoupper($dbName));
//         $db_port = getenv('DB_PORT_' . strtoupper($dbName));
//         $db_name = getenv('DB_NAME_' . strtoupper($dbName));
//         $db_user = getenv('DB_USER_' . strtoupper($dbName));
//         $db_pass = getenv('DB_PASS_' . strtoupper($dbName));

//         switch ($this->dbType) {
//             case 'mysql':
//                 $dsn = "$this->dbType:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8";
//                 break;
//             case 'postgresql':
//                 $dsn = "$this->dbType:host=$db_host;port=$db_port;dbname=$db_name";
//                 break;
//             case 'sqlite':
//                 $dsn = "$this->dbType:$db_name";
//                 break;
//             default:
//                 throw new Exception('Unsupported database type: ' . $this->dbType);
//         }

//         try {
//             $this->pdo = new PDO($dsn, $db_user, $db_pass, $options);
//             $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch (PDOException $e) {
//             die('Database connection failed: ' . $e->getMessage());
//         }
//     }

//     public static function getInstance($dbName, $options = [])
//     {
//         if (self::$instance === null) {
//             self::$instance = new self($dbName, $options);
//         }
//         return self::$instance->pdo;
//     }
// }


/*
To use the DBConnect class, you can call the getInstance() method and pass in the name of the database that you want to connect to. The getInstance() method will return a PDO instance that is connected to the specified database.
*/

// $pdo = DBConnect::getInstance('DB1');


/*
This will create a PDO instance that is connected to the database specified in the .env file with the name DB1.

You can then use the PDO instance to execute queries and perform other database operations, just like you would with a regular PDO object.
*/

// $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
// $stmt->execute([':username' => $username, ':password' => $password]);
// $result = $stmt->fetchAll();


/*
You can also pass in optional connection options to the getInstance() method, as an array. For example:
*/

// $options = [
//     PDO::ATTR_PERSISTENT => true,
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
// ];
// $pdo = DBConnect::getInstance('DB1', $options);
