<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 19:17
 */

namespace Besepa\Entity;



class BankAccount implements EntityInterface{


    public $id;

    public $bank_name;

    public $status;

    public $bic;

    public $iban;

    public $customer_id;

    /**
     * @var Mandate
     */
    public $mandate;
    

    /**
     * @param Mandate $mandate
     */
    public function  setMandate(Mandate $mandate){
        $this->mandate = $mandate;
    }


    function getId(){
        return $this->id;
    }
} 