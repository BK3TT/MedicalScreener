<?php

  require_once('dbConnect.php');

  class DBAccess {
    protected static $DB;
    public static $instance;

    private function __construct() {
      self::$DB = DB::connect();
      self::$instance = $this;
    }

    public static function DBAccess() {
      if(!self::$instance) {
        new DBAccess();
      }

      return self::$instance;
    }
    
    public function GetData($query, $fields) {
      try {
        $statement = self::$DB->prepare($query);
        $statement->execute($fields);
        $result_array = array();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
          array_push($result_array, $result);
        }

        if(sizeof($result_array) == 0) {
          throw new Exception("Data not found");
        }

        return $result_array;

      } catch(PDOException $e) {
        throw new Exception("Database query error");
      } catch(Exception $e) {
        throw new Exception($e->getMessage());
      }

    }

    public function PostData($query, $fields) {
      try {
        $statement = self::$DB->prepare($query);
        $statement->execute($fields);
      } catch(PDOException $e) {
        throw new Exception("Database query error");
      }
    }

  }

?>
