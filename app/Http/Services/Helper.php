<?php
/**
 * Created by PhpStorm.
 * User: administrateur
 * Date: 23/08/16
 * Time: 17:06
 */

namespace App\Http\Services;


use App\Models\User;
use Illuminate\Support\Facades\Mail;


class Helper
{

    /**
     * @param null $data
     * @param $status
     * @param $message
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function createResponse($data = null, $status, $message) {
        return response([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ]);
    }

    /**
     * @param User $user
     * @param $sender
     * @param $subject
     */
    public function sendMail(User $user, $sender, $subject, $template, $option) {

        Mail::send($template, $option, function ($m) use ($user, $sender, $subject) {
            $m->from($sender, '');

            $m->to($user->email, $user->username)->subject($subject);
        });

    }


}