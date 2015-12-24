<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 19/4/15
 * Time: 15:28
 */

namespace Besepa\Entity;


class Mandate implements  EntityInterface{

    public $id;

    public $description;

    public $signed_at;

    public $mandate_type;

    public $signature_type;

    public $reference;

    public $scheme;

    public $used;

    public $status;

    public $phone_number;

    public $url;

    function getId(){
        return $this->id;
    }



} 