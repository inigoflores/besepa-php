<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 2:04
 */

namespace Besepa\Repository;



use Besepa\Entity\EntityInterface;
use Besepa\Exceptions\ResourceInvalidException;

class DebitRepository extends AbstractRepository{


    private $customer_id;


    function setCustomerId($customer_id){
        $this->customer_id = $customer_id;
    }

    function getResourcePath(){

        if(!$this->customer_id) throw new ResourceInvalidException("Se necesita indicar un id de customer, utilice el método setCustomerId en " . get_class($this));

        return "customers/" . $this->customer_id . "/debits";
    }

    function getEntityName(){
        return '\Besepa\Entity\Debit';
    }

    function getRequestData(EntityInterface $entity, $update=true){

        $data = json_decode( json_encode($entity), true );

        if(!$update){
            unset($data["id"]);
            unset($data["status"]);
            unset($data["creditor_bank_account"]);
            unset($data["debtor_bank_account"]);
            unset($data["customer"]);
        }

        return array( "debit" => $data );


    }


} 