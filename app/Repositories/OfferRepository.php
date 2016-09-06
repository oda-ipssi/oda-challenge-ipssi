<?php
namespace App\Repositories;

use App\Models\Offer;

/**
 * Class OfferRepository
 */
class OfferRepository
{

    /**
     * @param $data
     * @param Offer $offer
     * @return Offer
     */
    public function editOffer($data, Offer $offer){

        $offer->title = isset($data['title']) ? $data['title'] : $offer->title;
        $offer->description = isset($data['description']) ? $data['description'] : $offer->description;
        $offer->has_support = isset($data['has_support']) ? $data['has_support'] : $offer->has_support;
        $offer->has_update = isset($data['has_update']) ? $data['has_update'] : $offer->has_update;
        $offer->user_limit = isset($data['user_limit']) ? $data['user_limit'] : $offer->user_limit;
        $offer->database_limit = isset($data['database_limit']) ? $data['database_limit'] : $offer->database_limit;
        $offer->price = isset($data['price']) ? $data['price'] : $offer->price;


        return $offer;

    }


    /**
     * @param $data
     * @return Offer
     */
    public function createOffer($data){

        $offer = $this->editOffer($data,  new Offer());

        return $offer;

    }

    /**
     * @param Offer $offer
     */
    public function deleteOffer(Offer $offer) {

        $offer->delete();

    }

}