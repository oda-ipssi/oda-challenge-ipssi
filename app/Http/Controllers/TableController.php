<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Managers\TableManager;

use App\Http\Requests;

class TableController extends Controller
{

    private $status = 200;
    private $message = 'OK';
    private $statusCreate = 201;
    private $messageCreate = 'Created';
    private $table = null;

    /**
     * Store a new table in database following json returns by front.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeTable(Request $request)
    {
        $this->table = TableManager::getInstance("test");
        $this->table->saveData();
        dd($this->table);

        // if (exist) {
        //        $this->updateTable();
        // } else {
        //        $this->createTable();
        // }

        //return response()->json(['status' => $this->statusCreate, 'data' => $this->table , 'message' => $this->messageCreate]);
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
