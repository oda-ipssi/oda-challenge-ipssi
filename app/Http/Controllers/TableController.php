<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Managers\TableManager;
use App\Http\Controllers\Artisan;

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
        $this->table = TableManager::getInstance("food");
        $this->table->saveData();
        \Illuminate\Support\Facades\Artisan::call('jables');
        dd($this->table);

        // return response()->json(['status' => $this->statusCreate, 'data' => $this->table , 'message' => $this->messageCreate]);
    }

    /**
     * Store a new table in database following json returns by front.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataTable(Request $request)
    {
        $user = Auth::user();
        if ($user)
        {
            return response()->json(['status' => $this->status, 'data' => TableManager::getInstance($userId) , 'message' => $this->message]);
        }

        return response()->json(['status' => '402', 'message' => "No user logged in"]);
    }

    /**
     * Store a new table in database following json returns by front.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTable(Request $request)
    {
        $table = "";

        // return response()->json(['status' => $this->status_create, 'data' => $content , 'message' => $this->message_create]);
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

}
