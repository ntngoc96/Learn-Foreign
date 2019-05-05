<?php
    //this db using singleton pattern
    class DB{
        private static $instance = NULL;
        public static function getInstance(){
            if(!isset(self::$instance)){
                try {
                    self::$instance = new PDO(
                        'mysql:host=localhost;
                        dbname=lf',
                        'root', //id
                        '', //password
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                    );
                    self::$instance->exec("SET NAMES utf8");
                } catch (PDOException $ex){
                    die($ex->getMessage());
                }
            } //end if
            return self::$instance;
        }
    }

?>