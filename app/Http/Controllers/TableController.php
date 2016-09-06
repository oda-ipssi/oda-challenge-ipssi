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
     * Store a new table in database following json returns by front.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataTable(Request $request, User $user)
    {
        if ($user)
        {
            if (Schema::hasTable('food')) {
                return response()->json(['status' => '200', 'message' => "The table already exist, no need to re-import !"]);
            }
            return response()->json(['status' => $this->status, 'data' => TableManager::getInstance($userId) , 'message' => $this->message]);
        }

        return response()->json(['status' => '402', 'message' => "No user logged in"]);
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
        dd($request);
        $dataArray = json_decode($request->data);

        if (!$dataArray) {
            return response()->json(['status' => '402', 'message' => "Je suis ton PERE"]);
        }

        return response()->json(['status' => $this->status_create, 'data' => $dataArray , 'message' => $this->message_create]);
    }

}
