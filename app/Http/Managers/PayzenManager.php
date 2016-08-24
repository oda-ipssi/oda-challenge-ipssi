<?php

    namespace App\Http\Managers;

class PayzenManager{

    private $defaultSettings = array();
    /*CONSTRUCTOR*/
    function __construct()
    {
        $this->key = config('services.payzen.testCert');
        $this->defaultSettings['vads_ctx_mode'] = "TEST";
        $this->defaultSettings['vads_site_id'] = config('services.payzen.shopId');
        $this->defaultSettings['vads_trans_id'] = date("His");
        $this->defaultSettings['vads_currency'] = '978';
        $this->defaultSettings['vads_action_mode'] = 'INTERACTIVE';
        $this->defaultSettings['vads_page_action'] = 'PAYMENT';
        $this->defaultSettings['vads_version'] = 'V2';
        $this->defaultSettings['vads_payment_config'] = 'SINGLE';
        $this->defaultSettings["vads_trans_date"] = date("YmdHis");
    }
    /*--------------------------------------------------------------------------------------------------------------------
   ----------------------------------------------------------------------------------------------------------------------
   FONCTION => CALCUL DE LA SIGNATURE
   ---------------------------------------------------------------------------------------------------------------------
   -------------------------------------------------------------------------------------------------------------------*/
   public function getFormParams($fields)
   {
       $settings = array_merge($this->defaultSettings, $fields);
       ksort($settings); // tri des paramÃ©tres par ordre alphabÃ©tique
       $signatureContent = "";
       foreach ($settings as $field => $value) {
           if (substr($field, 0, 5) == 'vads_') {
               $signatureContent .= utf8_encode($value . "+");
           }
       }
       $signatureContent .= utf8_encode($this->key);    // On ajoute le certificat Ã  la fin de la chaÃ®ne.
       $signature = sha1($signatureContent);
       return ["signature" => $signature,"fields" => $settings];
   }

    public function getOffers(){
        return \App\Models\Offer::all()->toArray();
    }
}