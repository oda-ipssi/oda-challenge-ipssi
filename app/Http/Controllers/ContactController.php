<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Services\Helper;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;


class ContactController extends Controller
{


    /**
     * @var ContactRepository $contactRepository
     */
    private $contactRepository;

    /**
     * @var Helper $helper
     */
    private $helper;

    /**
     * ContactController constructor.
     * @param ContactRepository $contactRepository
     * @param Helper $helper
     */
    public function __construct(ContactRepository $contactRepository, Helper $helper)
    {
        $this->contactRepository = $contactRepository;
        $this->helper = $helper;
    }


    /**
     * @param ContactRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function saveContactMessage(ContactRequest $request) {

        $name = $request->get('name');
        $email = $request->get('email');
        $message = $request->get('message');

        $contact = $this->contactRepository->createContactMessage($name, $email, $message);
        $contact->save();

        return $this->helper->createResponse([], 200, trans("contact.get", [], "contact"));

    }


}
