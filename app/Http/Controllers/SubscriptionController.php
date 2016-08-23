<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Offer;
use App\Models\OrdersOffer;
use Session;
use DB;
use PDF;
use App;


class SubscriptionController extends Controller
{

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

    	return response()->json(['results' =>  [ 'user' => $user, 'order' => $order, 'offer' => $offer ] ]);
    }

    /**
    * Terminate subscription
    * @param int $orderId
    *
    */
    public function stopSubscription($orderId) {

    	$order = Order::find($orderId);
    	$order->status = 'Stopped';
    	$order->save();
    	Session::flash('message', 'Successfully stopped subscription!');

    	return response()->json(['message' => 'Request completed']);

    }

    /**
    * Subscription renewal
    * @param int $orderId
    *
    */
    public function renewSubscription($orderId) {

    	$order = Order::find($orderId);
    	$order->status = 'Renew';
    	$order->save();
    	Session::flash('message', 'Successfully renewed subscription!');

    	return response()->json(['message' => 'Request completed']);

    }

    /**
    * Download invoice
    * @param
    *
    */
    public function downloadInvoice($userId) {
    	$user = User::find($userId);
    	$order = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->first();
    	$offerValue = OrdersOffer::where('order_id', $order->id)->value('offer_id');
    	$offer = Offer::find($offerValue);

    	$html = '
    		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    	';

    	$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML($html)->save('invoice.pdf');
		return $pdf->stream();

    }


}