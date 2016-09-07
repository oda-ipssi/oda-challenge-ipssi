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

use App\Http\Requests;

class TableController extends Controller
{

    private $status = 200;
    private $message = 'OK';
    private $table = null;

    /**
     * Store a new table in database following json returns by front.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeTable(Request $request)
    {
        // $user = User::where('validation_token', $token)->first(); find the user by right parameter
        // $user = JWTAuth::parseToken()->authenticate(); // get current user
        $this->table = TableManager::getInstance("food");
        if (Schema::hasTable($this->table->tableName)) {
            // return update in fact
            // $this->updateTable($request, User $user, $this->table);
            return response()->json(['status' => '200', 'message' => "You have already a table named " .$this->table->tableName]);
        } else {
            // return save data
            $this->table->saveData();
            \Illuminate\Support\Facades\Artisan::call('jables');
            return response()->json(['status' => $this->status, 'data' => TableManager::getInstance($userId) , 'message' => $this->message]);
        }
    }

    /**
     * get all tables creating by user
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataTable(Request $request, User $user)
    {
        // $userTables =
        return response()->json(['status' => $this->status_create, 'data' => $content , 'message' => $this->message_create]);
    }


    /**
     * Update an existing table in database following json returns by front.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateTable(Request $request)
    {
        $table = "";

        // return response()->json(['status' => $this->status_create, 'data' => $content , 'message' => $this->message_create]);
    }

    public function testTable(Request $request)
    {
        $datas = json_encode($request->getContent());
        var_dump($datas);
        var_dump(empty($datas));

        if (!$datas || empty($datas)) {
            return response()->json(['status' => '402', 'message' => "Je ne  pas suis ton PERE"]);
        }

        return response()->json(['status' => '200', 'message' => "Je suis ton PERE"]);
    }

}
