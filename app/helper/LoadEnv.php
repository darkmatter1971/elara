<?php

class Env
{
    private static $variables;

    public static function load($path = __DIR__ . '/.env')
    {
        if (!file_exists($path)) {
            throw new Exception(".env file at '$path' not found");
        }

        self::$variables = parse_ini_file($path);
    }

    public static function get($name, $default = null)
    {
        return self::has($name) ? self::$variables[$name] : $default;
    }

    public static function has($name)
    {
        return isset(self::$variables[$name]);
    }

    public static function all()
    {
        return self::$variables;
    }

    public static function set($name, $value)
    {
        self::$variables[$name] = $value;
    }

    private static function validateName($name)
    {
        if (!preg_match('/^[A-Za-z0-9_]+$/', $name)) {
            throw new Exception("Invalid environment variable name '$name'");
        }
    }
}


// Set the value of an environment variable
// Env::validateName('VARIABLE_NAME');
// Env::set('VARIABLE_NAME', 'value');