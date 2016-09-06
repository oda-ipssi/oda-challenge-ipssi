<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Repositories\OfferRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Services\Helper;

class OfferController extends Controller
{

    /**
     * @var OfferRepository
     */
    private $offerRepository;

    /**
     * @var Helper
     */
    private $helper;

    /**
     * OfferController constructor.
     * @param OfferRepository $offerRepository
     * @param Helper $helper
     */
    public function __construct(OfferRepository $offerRepository, Helper $helper) {
        $this->offerRepository = $offerRepository;
        $this->helper = $helper;

    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getAllOffers() {

        $offers = Offer::all();

        return $this->helper->createResponse($offers, 200, trans('offer.get.all', [], 'offer'));

    }

    /**
     * @param $id
     * @param OfferRequest $offerRequest
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update($id, OfferRequest $offerRequest) {


        try{

            $offer = $this->offerRepository->editOffer($offerRequest->get('data'), Offer::findOrFail($id));

            $offer->save();


            return $this->helper->createResponse($offer, 200, trans('offer.edit.success', [], 'offer'));

        } catch (ModelNotFoundException $e) {

            return $this->helper->createResponse("", 404, trans('offer.response.notfound', [], 'offer'));

        }

    }

    /**
     * @param OfferRequest $offerRequest
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function create(OfferRequest $offerRequest) {

        $newOffer = $this->offerRepository->createOffer($offerRequest->get('data'));
        $newOffer->save();

        return $this->helper->createResponse($newOffer, 200, trans("offer.response.success", [], 'offer'));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete($id) {

        $offer =  Offer::findOrFail($id);

        $this->offerRepository->deleteOffer($offer);

        return $this->helper->createResponse([], 200, trans("offer.response.success", [], 'offer'));


    }




}
