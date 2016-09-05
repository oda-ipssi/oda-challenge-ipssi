<?php
namespace App\Http\Managers;
/**
* Class to handle users tables with their stored data
*/
class TableManager
{
    /*
    Declaring variable to store singleton
    */
    private static $_instance = null;
    /*
    * Declaring useful parameters used in the class
    */
    public  $data;
    private $userId;
    private $tableName;

    /*Declaring the class' methods*/

    public static function getInstance($name)
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new TableManager($name);
        }
        return self::$_instance;
    }

    /*Affecting useful parameters to allow class to work properly*/
    private function __construct($name)
    {
        //$this->userID = $id;
        $this->tableName = $name;
        if(is_null($this->data)){
            $this->loadData();
        }
    }

    private function loadData()
    {
        /*Method to load data*/

        $this->data = json_decode(file_get_contents("https://api.myjson.com/bins/10dyk"));
    }

    public function saveData()
    {
        /*Method to save data*/
        //dd(public_path()."/".$this->tableName.".json");
        file_put_contents(database_path()."/jables/".$this->tableName.".json", json_encode($this->data));
    }
}
