<?php
namespace App\Repositories;

use App\Models\Contact;

/**
 * Class ContactRepository
 */
class ContactRepository
{

    /**
     * @param $name
     * @param $email
     * @param $message
     * @return Contact
     */
    public function createContactMessage($name, $email, $message) {

        $contact = new Contact();
        $contact->name = $name;
        $contact->email = $email;
        $contact->message = $message;

        return $contact;
    }

}