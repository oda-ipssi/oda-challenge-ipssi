<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Http\Services\Helper;

use App\Http\Requests;
use App\Models\Order;
use App\Models\User;
use App\Models\Offer;
use App\Models\Payment;
use PDF;
use App;

class OrderController extends Controller
{
    /**
     * @var App\Http\Services\Helper $helper
     */
    private $helper;

    /**
     * OrderController constructor.
     * @param App\Http\Services\Helper $helper
     */
    public function __construct(App\Http\Services\Helper $helper)
    {
        $this->helper = $helper;
    }


    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getAllOrders()
    {
        $orders = Order::all();

        if(!$orders){
            return $this->helper->createResponse([], 400, trans('order.get.notfound', [], 'order'));
        } else {
            return $this->helper->createResponse(['orders'=> $orders], 200, trans('order.get.success', [], 'order'));
        }

    }

    /**
     * @param $idOrder
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show($idOrder)
    {
        $order = Order::FindOrFail($idOrder);

        if(!$order){
            return $this->helper->createResponse([], 400, trans('order.get.notfound', [], 'order'));
        }else{
            return $this->helper->createResponse($order, 200, trans('order.get.success', [], 'order'));
        }
    }

    /**
     * @param $idOrder
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function downloadInvoice($idOrder) {
        
        
        $order = Order::findOrFail($idOrder);
        $offer = Offer::findOrFail($order->offer_id);
        $payment = Payment::where('order_id', $order->id)->first();
        $user = User::findOrFail($order->user_id);


        $view = view ('invoice/subscription',  ['user' => $user, 'offer' => $offer, 'payment' => $payment]);
        $html = $view->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->save($this->helper->generatePdfName($user, $payment));

        return $this->helper->createResponse($html, 200, trans('order.invoice.success', [], 'order'));

    }
    
   }
