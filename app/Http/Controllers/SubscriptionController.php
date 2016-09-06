<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Offer;
use App\Models\Payment;
use Carbon\Carbon;
use Faker\Provider\ka_GE\DateTime;
use Illuminate\View\View;
use Session;
use DB;
use PDF;
use App;
use Symfony\Component\HttpFoundation\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class SubscriptionController extends Controller
{

    /**
     * @var App\Repositories\UserRepository $userRepository
     */
    private $userRepository;

    /**
     * @var App\Repositories\OrderRepository $orderRepository
     */
    private $orderRepository;

    /**
     * @var App\Http\Services\Helper
     */
    private $helper;


    /**
     * SubscriptionController constructor.
     * @param App\Repositories\UserRepository $userRepository
     * @param App\Repositories\OrderRepository $orderRepository
     */
    public function __construct(App\Repositories\UserRepository $userRepository, App\Repositories\OrderRepository $orderRepository, Helper $helper)
    {
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->helper = $helper;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrder(){

        $user = JWTAuth::parseToken()->authenticate();
        $order = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        if(!$order){
            return $this->helper->createResponse([], 400, trans('order.not.found', [], 'order'));
        } else {
            return $this->helper->createResponse(['order'=> $order], 200, trans('order.get.success', [], 'order'));
        }
    }


    /**
     * @param User $user
     * @param Offer $offer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    private function createSubscription(User $user, Offer $offer){

        $order = $this->orderRepository->createOrder($user, $offer)->save();

        $this->userRepository->validateUser($user)->save();

        return $this->helper->createResponse(compact($order, $user), 400, trans('order.create.success', [], 'order'));


    }

    /**
     * @param $userId
     * @param $offerId
     */
    public function subscriptionFactory($userId, $offerId) {

        $offer = Offer::findOrFail($offerId);
        $user = User::findOrFail($userId);

        switch ($offer->price) {
            case 0 :
                $this->createSubscription($user, $offer);
                break;
            default:
                // TODO redirect to payment
        }

    }

    /**
     * @param $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSubscription($orderId){

        return $this->helper->createResponse([], 422, trans('order.delete.not_allowed', [], 'order'));
    }

    /**
     * @param $orderId
     * @param $offerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeSubscription($orderId, $offerId){

        $order = Order::find($orderId);
        $userId = $order->user_id;

        if($order->offer_id != $offerId){
            $this->subscriptionFactory($userId, $offerId);
        }

        return $this->helper->createResponse($order, 422, trans('order.change.same', [], 'order'));

    }

    /**
     * @param $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function stopSubscription($orderId) {

        $order = Order::find($orderId);

        $order->status = Order::STATUS_STOP;
        $order->save();

        return $this->helper->createResponse($order, 200, trans('order.change.stop', [], 'order'));

    }

    /**
     * @param $order_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function downloadInvoice($order_id, Request $request) {

        $user = $request->get('data')['userId'];

        $payment = DB::table('payments')->where([
            ['user_id', '=', $user->id],
            ['order_id', '=', $order_id],
        ])->get();

        $payment = $payment[0];

        $order = Order::find($order_id);
        $offer = Offer::find($order->offer_id);

        $view = view ('invoice/subscription',  ['user' => $user, 'offer' => $offer, 'payment' => $payment]);
        $html = $view->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->save($this->generatePdfName($user, $payment));

        return  response()->json($html, 200, ['Response Ok']);

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllOrders(){
        $orders = DB::table('orders')->orderBy('created_at', 'desc')->get();

        return response()->json(['orders' => $orders], 200, ['OK']);
    }

    /**
     * @param User $user
     * @param Payment $payment
     * @return string
     */
    private function generatePdfName(User $user, $payment) {

        return 'invoice_'.$user->username.'_'.$user->id.'_'.substr($payment->created_at,0, 10).'.pdf';

    }


}