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
use App\Http\Services\Helper;
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
     * @var App\Http\Services\Helper $helper
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
            return $this->helper->createResponse([], 400, trans('order.get.notfound', [], 'order'));
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

        return $this->helper->createResponse(compact($order, $user), 200, trans('order.change.success', [], 'order'));


    }

    /**
     * @param User $user
     * @param Offer $offer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    private function updateSubscription(Order $order, User $user, Offer $offer){

        $order = $this->orderRepository->editOrder($order,$offer)->save();

        $this->userRepository->validateUser($user)->save();

        return $this->helper->createResponse(compact($order, $user), 400, trans('order.update.success', [], 'order'));


    }

    /**
     * @param $offerId
     * @param Order|null $order
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function subscriptionFactory(Request $request) {

        $token= $request->all()['token'];
        $offerId = $request->get('offerId');

        //$offerId = $request->get('data')['offerId'];
        $order = isset($request->get('data')['order']) ? $request->get('data')['order'] : null;

        $offer = Offer::find($offerId);


        $user = JWTAuth::parseToken()->authenticate();

        if($user){
            switch ($offer->price) {
                case 0 :
                    if($order!=null){
                        return $this->updateSubscription($order,$user,$offer);
                    } else {
                        return $this->createSubscription($user, $offer);
                    }
                    break;
                default:
                    return redirect()->route('checkout', ['id' => $offerId, 'token' => $token ]);
            }
        } else {
            $request->getSession()->set('user-registration-offer', $offerId);
            return redirect()->route('registration');
        }
    }

    public function validatePayment(Request $request){
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        $txt = "John Doe\n";
        fwrite($myfile, $txt);
        $txt = "Jane Doe\n";
        fwrite($myfile, $txt);
        fclose($myfile);
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
    public function changeSubscription($orderId, Request $request){

        $order = Order::findOrFail($orderId);
        $userId = $order->user_id;
        $user = JWTAuth::parseToken()->authenticate();

        //to modify to get data
        $offerId = $request->get('offerId');

        $offer = Offer::findOrFail($offerId);

        if($order->offer_id != $offerId && $userId == $user->id){
            $response = $this->updateSubscription($order,$user,$offer);

            return $response;
        } else {
            return $this->helper->createResponse([], 403, trans('order.change.notallowed', [], 'order'));
        }



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
    public function downloadInvoice($order_id) {

        $user = JWTAuth::parseToken()->authenticate();

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
        $pdf->loadHTML($html)->save($this->helper->generatePdfName($user, $payment));

        return $this->helper->createResponse($html, 200, trans('order.invoice.success', [], 'order'));

    }


}