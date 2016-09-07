<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Models\Order;
use App\Models\User;
use App\Models\Offer;
use App\Models\Payment;
use PDF;
use App;

class OrderController extends Controller
{
     
	 private $status = 200;
    private $message = 'OK';


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        // get all the contents
        $orders = Order::all();

        if(!$orders){
        	$this->status = 404;
        	$this->message = 'Not found';

        }

        return response()->json(['status' => $this->status, 'data' => $orders , 'message' => $this->message]);  

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        // get all the contents
        $order = Order::FindOrFail($id);

        if(!$order){
            $this->status = 404;
            $this->message = 'Not found';

        }else{
            $user = User::where('id', $order->user_id)->get();
            //dd($user);
        }


        return response()->json(['status' => $this->status, 'data' => ['order' => $order, 'user'  => $user ] , 'message' => $this->message]);  

    }

    /**
    * Download invoice
    * @param
    *
    */
    public function download($id) {
        
        
        $order = Order::find($id);
        $offer = Offer::find($order->offer_id);
        $payment = Payment::where('order_id', $order->id)->first();
        //dd($payment);
        $user = User::where('id', $order->user_id)->first();

        $html = '
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="Content-Type" content="text/html;/>
                </head>

                <body>
                    <h1>Invoice #'.$payment->id.'</h1>
                    <h2>Payment information</h2>
                    <p>Payment method : '.$payment->paymentMethod.'</p>
                    <p>Card number : '.$payment->cardNumber.'</p>
                    <p>Expiration date : '.$payment->expirationDate.'</p>

                    <h2>Billing details</h2>
                    <p><b>'.$user->lastname.' '.$user->firstname.':</b></p>
                    <p>'.$user->address.'</p>
                    <p>'.$user->zipcode.'</p>
                    <p>'.$user->city.'</p>
                    <p>'.$user->phone.'</p>

                    <h2>Order summary</h2>
                    <table width="200"  align="left">
                        <tr>
                            <th>Offer</th>
                            <th>Database limit</th>
                            <th>Price</th>
                        </tr>

                        <tr>
                            <td>'.$offer->title.'</td>
                            <td>'.$offer->database_limit.'</td>
                            <td>'.$offer->price.'€</td>
                        </tr>
                    </table>
                </body>
            <html>';
        
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->save('invoice.pdf');


        if(!$payment) {
            $this->status = 404;
            $this->message = 'Not found';
        } else {
            $this->status = 200;
            $this->message = 'Request completed';
        }
        return  response()->json($pdf->stream(), 200, ['Response Ok']);

    }
    
   }
