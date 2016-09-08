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
     * @var
     */
    public  $data;
    private $userId;
    public $tableName;


    /**
     * TableManager constructor.
     * @param $name
     * @param $data
     */
    private function __construct($name,$data)
    {
        //$this->userID = $id;

        $this->tableName = $name;
        if(is_null($this->data)){
            $this->loadData($data);
        }
    }


    /**
     * @param $name
     * @return TableManager|null
     */
    public static function getInstance($name,$data)
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new TableManager($name,$data);
        }
        return self::$_instance;
    }


    /**
     * @param $data
     * @return mixed
     */
    private function loadData($data)
    {
        return $this->data = $data;

    }


    /**
     * @return path
     */
    public function saveSchema($originalData = null)
    {
        if(!is_dir(database_path()."/jables/")){
            mkdir(database_path()."/jables/",0775);
        }
        $primaryKey =  ["type" => "integer","default" => "", "nullable" => false,"primary" => true,"unique" => true, "ai" => true ];
        $myData = json_decode($this->data,true)['data'];
        $data = array("fields" => $myData["fields"]);
        foreach ($data["fields"] as &$elem){
            if(array_key_exists("foreign",$elem) && $elem["foreign"] == ""){
                unset($elem["foreign"]);
            }
        }
        $data["fields"]["id"] = $primaryKey;
        if(!is_null($originalData)){
            $finalData['fields'] = array_merge($data['fields'],$originalData['fields']);
        }
        else{
            $finalData = $data;
        }
        if(file_exists(database_path()."/jables/".$this->tableName.".json")){
            unlink(realpath(database_path()."/jables/".$this->tableName.".json"));
        }
        if (file_put_contents(database_path()."/jables/".$this->tableName.".json", json_encode($finalData))) {
            return true;
        } else {
            return false;
        }

    }


    public function saveData($table,$data){
        $db = DB::table($table);
        $db->insert(
           $data
        );
    }
}
