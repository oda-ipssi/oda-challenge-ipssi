<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Offer;
use App\Models\OrdersOffer;
use App\Models\Payment;
use Session;
use DB;
use PDF;
use App;


class SubscriptionController extends Controller
{
    private $status = 200;
    private $message = 'OK';


    public function response($data == null, $status, $message){

        return response()->json(['data' => $data, 'status' => $status, 'message' => $message]);
    }
	/**
	* Show subscription's status
	* @param int $userId
	*
	*/
    public function show($userId) {

    	$user = User::find($userId);
    	$order = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->first();
    	$offerValue = OrdersOffer::where('order_id', $order->id)->value('offer_id');
    	$offer = Offer::find($offerValue);
        if(!$offer){
            $this->status = 404;
            $this->message = 'Not found';
        }

    	return  $this->response([ 'user' => $user, 'order' => $order, 'offer' => $offer ],  $this->status, $this->message);
    }

    /**
    * Terminate subscription
    * @param int $orderId
    *
    */
    public function stopSubscription($orderId) {

        $order = Order::find($orderId);
    	
        if(!$order) {
            $this->status = 404;
            $this->message = 'Not found';
        } else {
            $order->status = 'Stopped';
            $order->save();
            Session::flash('message', 'Successfully stopped subscription!');
            $this->status = 200;
            $this->message = 'Request completed';
        }

        return  $this->response(null,  $this->status, $this->message);
    }

    /**
    * Subscription renewal
    * @param int $orderId
    *
    */
    public function renewSubscription($orderId) {

    	$order = Order::find($orderId);

        if(!$order) {
            $this->status = 404;
            $this->message = 'Not found';
        } else {
            $order->status = 'Renew';
            $order->save();
            Session::flash('message', 'Successfully renewed subscription!');
            $this->status = 200;
            $this->message = 'Request completed';
        }

    	return  $this->response(null,  $this->status, $this->message);

    }

    /**
    * Download invoice
    * @param
    *
    */
    public function downloadInvoice($id) {
    	
    	$payment = Payment::find($id);
    	$user = User::find($payment->user_id);
    	$order = Order::find($payment->order_id);
    	$offerValue = OrdersOffer::where('order_id', $order->id)->value('offer_id');
    	$offer = Offer::find($offerValue);
    	
    	$html = '
    		<html>
    			<head>
    				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    			</head>

    			<body>
		    		<center><h1>Invoice #'.$payment->id.'</h1></center>
		    		<h2>Payment information</h2>
		    		<p>Billing type : '.$payment->billingType.'</p>
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

        return  $this->response($pdf->stream(),  $this->status, $this->message);

    }


}