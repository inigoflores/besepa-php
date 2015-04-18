<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 6/2/15
 * Time: 11:50
 */

namespace Besepa\Entity;


class Customer implements EntityInterface{

    /**
     * @required
     */
    public $name;

    /**
     * @required
     */
    public $taxid;

    /**
     * @required
     */
    public $reference;

    public $contact_name;

    public $contact_email;

    public $contact_phone;

    public $address_street;

    public $address_postalcode;

    public $address_state;

    public $address_country;

    public $id;

    public $status;

    function getId(){
        return $this->id;
    }

} 