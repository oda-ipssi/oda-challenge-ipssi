<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Offer;
use App\Models\Payment;
use Carbon\Carbon;
use Session;
use DB;
use PDF;
use App;


class SubscriptionController extends Controller
{
    private $status = 200;
    private $message = ['OK'];


    /**
     * Return all the commands for one users
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($userId){
        $order = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        if(!$order){
            return  response()->json('',  404, 'Not found');
        } else {
            return  response()->json(['order' => $order],  $this->status, $this->message);
        }
    }

    // show one command with possibillity to download the invoice
    // create one subscription
    // delete one subscription
    // upgrade offer

    /**
     * @param $userId
     * @param $offerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSubscription($userId,$offerId){
        $order = new Order();
        //if pay
        //get value return
        $order->vat = 20;
        $order->status = 'OK';
        $order->user_id = $userId;
        $order->offer_id = $offerId;
        $order->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $order->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $order->price = 20;

        $order->save();

        //activate user
        $user = User::find($userId);

        $user->is_active = 1;

        $user->save();

        return  response()->json(['order' => $order, 'user' => $user],  $this->status, 'Order created');

    }

    /**
     * @param $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSubscription($orderId){
        $order = Order::find($orderId);

        $order->delete();

        return  response()->json('',  $this->status,'Order deleted');

    }

    /**
     * @param $orderId
     * @param $offerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeSubscription($orderId,$offerId){
        $order = Order::find($orderId);

        //if(pay)
        if($order->offer_id != $offerId){
            $order->offer_id = $offerId;
        }

        $order->save();

        return  response()->json(['order' => $order],  $this->status, 'Order created');

    }

    /**
     * @param $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function stopSubscription($orderId) {

        $order = Order::find($orderId);

        $order->status = 'STOP';
        $order->save();

        return  response()->json(['order' => $order],  200, 'order stopped');
    }

    public function downloadInvoice($order_id) {

        $payment = Payment::where('order_id',$order_id)->first();
        $user = User::find($payment->user_id);
        $order = Order::find($order_id);
        $offer = Offer::find($order->offer_id);

        $html = '
    		<html>
    			<head>
    				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

        return  response()->json($pdf->stream(), 200, ['Response Ok']);

    }


    public function getAllOrders(){
        $orders = DB::table('orders')->orderBy('created_at', 'desc')->get();

        return response()->json(['orders' => $orders], 200, ['OK']);
    }


}