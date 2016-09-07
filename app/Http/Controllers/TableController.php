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
        // $name = $data->tableName;
        $name = 'ourTest';
        $this->table = TableManager::getInstance($name, $data);
        if (Schema::hasTable($this->table->tableName)) {
            $this->table->saveData();
            \Illuminate\Support\Facades\Artisan::call('jables:refresh');
            return response()->json(['status' => '200', 'message' => "Your table has been updated or refresh, See Ya ;)" .$this->table->tableName]);
        } else {
            // return save data
            $this->table->saveData();
            \Illuminate\Support\Facades\Artisan::call('jables');
            return response()->json(['status' => $this->status, 'data' => TableManager::getInstance($name, $data) , 'message' => 'Table created !']);
        }
    }

    /**
     * @param Request $request
     * @param User $user
     */
    public function getDataTable(Request $request, User $user)
    {
        // $userTables =
        // return response()->json(['status' => $this->status_create, 'data' => $content , 'message' => $this->message_create]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function populateTable(Request $request)
    {
        // Insert some stuff
        $table = DB::table('ourTest');
        $table->insert(
            array(
                'test4' => 1,
                'test5' => 2
            )
        );

        return response()->json(['status' => '200', 'message' => "You have registered data in your table" ]);
    }


}


