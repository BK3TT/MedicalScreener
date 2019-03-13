<?php

  class DB {
    protected static $DB;

    private function __construct() {
        try {
          $config = parse_ini_file('./config/config.ini');

          self::$DB = new PDO( "mysql:host={$config['db_host']}; dbname={$config['db_name']}", $config['db_user'], $config['db_pass'] );
          
          self::$DB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          self::$DB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
          echo "Database connection Error: ".$e->getMessage();
          die;
        }
    }

    public static function connect() {
      if (!self::$DB) {
        new DB();
      }
      return self::$DB;
    }

  }

?>
