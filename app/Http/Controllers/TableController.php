<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Managers\TableManager;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\UserRequest;

use Schema;
use Illuminate\Support\Facades\DB;
// use DB;

use App\Http\Requests;

class TableController extends Controller
{

    private $status = 200;
    private $table;

    /**
     * @description Store a new table in database following json returns by front or Update/refresh one already exist
     * @param Request $request
     * @return JsonResponse
     */
    public function storeTable(Request $request)
    {
        // $user = JWTAuth::parseToken()->authenticate(); // get current user
        // $userId = $user->id;

        $dataArray = json_decode($request->getContent());
        $data = json_encode($dataArray);
        $name = $dataArray->data->tableName ."_ODA";
        $this->table = TableManager::getInstance($name, $data);
        if (Schema::hasTable($this->table->tableName)) {
            $originalData = json_decode(file_get_contents(database_path()."/jables/".$this->table->tableName.".json"),true);
            $this->table->saveSchema($originalData);
            \Illuminate\Support\Facades\Artisan::call('jables:refresh');
            return response()->json(['status' => '200', 'message' => "Your table has been updated or refresh, See Ya ;)" .$this->table->tableName]);
        } else {
            // return save data
            $this->table->saveSchema();
            \Illuminate\Support\Facades\Artisan::call('jables:refresh');
            return response()->json(['status' => $this->status, 'data' => TableManager::getInstance($name, $data) , 'message' => 'Table created !']);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getDataTable(Request $request /*, User $user*/)
    {
        $tables = DB::table("pg_tables")->where("schemaname","oda")->where("tablename","LIKE", "%ODA")->select('tablename')->get();

        $data['tableName'] = [];
        foreach ($tables as $elem) {
            array_push($data['tableName'], $elem->tablename);
        }

        return response()->json(['status' => '200', 'data' => $tables , 'message' => 'OK']);
    }


    public function getDataForChoosenTable(Request $request)
    {
        $tableName = "jables";
        $tableData = DB::table($tableName)->get();
;
        return response()->json(['status' => '200', 'data' => $tableData , 'message' => 'All your data from '.$tableName]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function populateTable(Request $request)
    {
        // Insert some stuff
        $db = DB::table("ourTest");
        $db->insert(
            array('test4' => 45,'test5' => 90)

        );
        return response()->json(['status' => '200', 'message' => "You have registered data in your table" ]);
    }


}


