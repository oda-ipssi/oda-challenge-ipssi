<?php

namespace App\Http\Managers;


/**
 * Class TableManager
 * @package App\Http\Managers
 */
class TableManager
{
    /**
     * Declaring variable to store singleton
     * @var null
     */
    private static $_instance = null;


    /**
     * Declaring useful parameters used in the class
     * @var
     */
    public  $datas;
    private $userId;
    public $tableName;


    /**
     * TableManager constructor.
     * @param $name
     */
    private function __construct($name)
    {
        //$this->userID = $id;
        $this->tableName = $name;
        if(is_null($this->datas)){
            $this->loadData();
        }
    }


    /**
     * @param $name
     * @return TableManager|null
     */
    public static function getInstance($name)
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new TableManager($name);
        }
        return self::$_instance;
    }


    /**
     * load data in the json object given
     * @return mixed
     */
    private function loadData()
    {
        /*Method to load data*/

        return $this->datas = json_decode(file_get_contents("https://api.myjson.com/bins/10dyk"));

    }


    /**
     * @return path
     */
    public function saveData()
    {
        file_put_contents(database_path()."/jables/".$this->tableName.".json", json_encode($this->data));
    }
}
