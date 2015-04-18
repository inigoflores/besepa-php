<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 19:17
 */

namespace Besepa\Entity;



class Product implements EntityInterface{


    public $id;

    public $name;

    public $status;

    public $reference;

    public $amount;

    public $currency;

    public $recurrent;

    public $max_charges;

    public $charge_on;

    public $periodicity;

    function getId(){
        return $this->id;
    }
} 