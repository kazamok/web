<?php
/**
 * @author Amin Mahmoudi (MasterkinG)
 * @copyright    Copyright (c) 2019 - 2024, MasterkinG32. (https://masterking32.com)
 * @link    https://masterking32.com
 **/

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class database
{
    public static $auth;
    public static $chars;

    public static function query($sql, $params = [])
    {
        return self::$auth->executeQuery($sql, $params);
    }

    public static function db_connect()
    {
        self::$auth = DriverManager::getConnection([
            'dbname' => get_config('db_auth_dbname'),
            'user' => get_config('db_auth_user'),
            'password' => get_config('db_auth_pass'),
            'host' => get_config('db_auth_host'),
            'port' => get_config('db_auth_port'),
            'driver' => 'pdo_mysql',
            'charset' => 'utf8',
        ], new Configuration());

        $realmlists = get_config("realmlists");
        if (is_iterable($realmlists) || is_object($realmlists)) {
            foreach ($realmlists as $realm) {
                if (!empty($realm["realmid"]) && !empty($realm["db_host"]) && !empty($realm["db_port"]) && !empty($realm["db_user"]) && !empty($realm["db_pass"]) && !empty($realm["db_name"])) {
                    $config = new Configuration();
                    // $config->setResultCacheImpl(new \Doctrine\Common\Cache\ArrayCache()); // Example of enabling cache

                    self::$chars[$realm["realmid"]] = DriverManager::getConnection([
                        'dbname' => $realm["db_name"],
                        'user' => $realm["db_user"],
                        'password' => $realm["db_pass"],
                        'host' => $realm["db_host"],
                        'port' => $realm["db_port"],
                        'driver' => 'pdo_mysql',
                        'charset' => 'utf8',
                    ], $config);
                } else {
                    die("Missing char database required field.");
                }
            }
        } else {
            // Handle the case when 'realmlists' is not iterable or an object
            die("Invalid 'realmlists' configuration.");
        }
    }
}
