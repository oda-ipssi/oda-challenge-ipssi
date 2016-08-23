<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Models\Content;

class ContentController extends Controller
{
     
	private $status = 200;
	private $message = 'OK';
	private $status_create = 201;
	private $message_create = 'Created';

	
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        // get all the contents
        $contents = Content::all();

        if(!$contents){
        	$this->status = 404;
        	$this->message = 'Not found';

        }

        return response()->json(['status' => $this->status, 'data' => $contents , 'message' => $this->message]);  

    }

    
    /**
     * Store a newly created resource in storage.
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = "";

       	// validate       
        $rules = array(
            'title'       => 'required',
            'content'      => 'required',
            'url' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
        	$this->status_create = 422;
        	$this->message_create = 'Not valide';    

        } else {
            // store
            $content = new Content; 
            $content->title       = $request->get('title');
            $content->content      = $request->get('content');
            $content->url =  $request->get('url');
            $content->save();
           
            
        }

        return response()->json(['status' => $this->status_create, 'data' => $content , 'message' => $this->message_create]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        
		// get the content
        $content = Content::where('url','like', '%' .$url. '%') ->first();       
        
        if(!$content){
        	$this->status = 404;
        	$this->message = 'Not found';

        }

        return response()->json(['status' => $this->status, 'data' => $content , 'message' => $this->message]);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        

         // get the content
        $content = Content::where('url','like', '%' .$url. '%') ->first();       
        
        if(!$content){
        	$this->status = 404;
        	$this->message = 'Not found';

        }

        return response()->json(['status' => $this->status, 'data' => $content , 'message' => $this->message]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function update($url,  Request $request)
    {
        
        $password = $request->get('password');
        $newPassword = $request->get('new_password');
    	$content = "";

        $rules = array(
            'title'       => 'required',
            'content'      => 'required',
            'url' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
        	$this->status_create = 422;
        	$this->message_create = 'Not valide';           
      
        } else {
            // store
            $content = Content::where('url','like', '%' .$url. '%') ->first(); 
            $content->title       = $request->get('title');
            $content->content      = $request->get('content');
            $content->url =  $request->get('url');
            $content->save();

            
            
        }
        return response()->json(['status' => $this->status_create, 'data' => $content , 'message' => $this->message_create]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $content = Content::find($id); 
        $content->delete();

        $this->message = 'Delete done';

       return response()->json(['status' => $this->status, 'data' => $content , 'message' => $this->message]);
    }
}
