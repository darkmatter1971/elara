<?php
class ConnectDB
{
    // Hold the class instance.
    private static $instance = null;

    // The PDO instance.
    private $pdo;

    // Private constructor to prevent direct creation of object.
    private function __construct()
    {
        // Load the .env file.
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // Get the database type from the .env file.
        $dbType = getenv('DB_TYPE_DB1');

        // Set the DSN based on the database type.
        switch ($dbType)
        {
            case 'mysql':
                $dsn = "mysql:host=" . getenv('DB_HOST_DB1') . ";dbname=" . getenv('DB_NAME_DB1');
            break;
            case 'sqlite':
                $dsn = "sqlite:" . getenv('DB_NAME_DB1');
            break;
            case 'postgresql':
                $dsn = "pgsql:host=" . getenv('DB_HOST_DB1') . ";port=" . getenv('DB_PORT_DB1') . ";dbname=" . getenv('DB_NAME_DB1') . ";user=" . getenv('DB_USER_DB1') . ";password=" . getenv('DB_PASS_DB1');
            break;
                // Add cases for other database types as needed.
                
        }

        // Set the PDO options.
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        );

        // Create a new PDO instance.
        try
        {
            $this->pdo = new PDO($dsn, getenv('DB_USER_DB1') , getenv('DB_PASS_DB1') , $options);
        }
        catch(PDOException $e)
        {
            $this->error = $e->getMessage();
        }
    }

    // Get the class instance.
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new ConnectDB();
        }

        return self::$instance;
    }

    // Get the PDO instance.
    public function getPDO()
    {
        return $this->pdo;
    }

    // Connect to a different database.
    public function connect($dbType, $host, $port, $dbName, $user, $pass)
    {
        // Set the DSN based on the database type.
        switch ($dbType)
        {
            case 'mysql':
                $dsn = "mysql:host=" . $host . ";dbname=" . $dbName;
            break;
            case 'sqlite':
                $dsn = "sqlite:" . $dbName;
            break;
            case 'postgresql':
                $dsn = "pgsql:host=" . $host . ";port=" . $port . ";dbname=" . $dbName . ";user=" . $user . ";password=" . $pass;
            break;
                // Add cases for other database types as needed.
                
        }

        // Set the PDO options.
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        );

        // Create a new PDO instance.
        try
        {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        }
        catch(PDOException $e)
        {
            $this->error = $e->getMessage();
        }
    }

    // Connect to a caching system.
    public function connectCache($cacheType, $host, $port)
    {
        switch ($cacheType)
        {
            case 'redis':
                $this->cache = new Redis();
                $this
                    ->cache
                    ->connect($host, $port);
            break;
            case 'memcached':
                $this->cache = new Memcached();
                $this
                    ->cache
                    ->addServer($host, $port);
            break;
                // Add cases for other caching systems as needed.
                
        }
    }
}

