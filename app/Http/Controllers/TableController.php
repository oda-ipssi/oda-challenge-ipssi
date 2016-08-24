<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
// use App\Models\Abstract;

class TableController extends Controller
{

    private $status = 200;
    private $message = 'OK';
    private $statusCreate = 201;
    private $messageCreate = 'Created';


    /**
     * Store a new table in database following json returns by front.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeTable(Request $request)
    {
        $table = "";

        // if (exist) {
        //        $this->updateTable();
        // } else {
        //        $this->createTable();
        // }

        return response()->json(['status' => $this->status_create, 'data' => $content , 'message' => $this->message_create]);
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
