<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 2:04
 */

namespace Besepa\Repository;



use Besepa\Client;
use Besepa\Entity\BankAccount;
use Besepa\Entity\EntityInterface;
use Besepa\Entity\Mandate;
use Besepa\Exceptions\OperationNotPermittedException;
use Besepa\Exceptions\ResourceInvalidException;

class BankAccountRepository extends AbstractRepository{


    private $customer_id;


    function setCustomerId($customer_id){
        $this->customer_id = $customer_id;
    }

    function getResourcePath(){

        if(!$this->customer_id) throw new ResourceInvalidException("Se necesita indicar un id de customer, utilice el método setCustomerId en " . get_class($this));

        return "customers/" . $this->customer_id . "/bank_accounts";
    }

    function create(BankAccount $entity, $send_mandate_email=false){

        $path =  $this->getResourcePath();


        if(!($entity->mandate && $entity->mandate instanceof Mandate)){
            throw new ResourceInvalidException("Mandate debe ser una instancia de la entidad Mandate en " . get_class($entity));
        }

        $data                       = $this->getRequestData($entity, false);
        $data["send_mandate_email"] = $send_mandate_email ? "yes" : "no";


        return $this->client->create( $path, $data, $this->getEntityName() );

    }

    function update(BankAccount $entity){
        throw new OperationNotPermittedException("You can´t update bank accounts through the Besepa API");
    }

    function delete(BankAccount $entity){
        throw new OperationNotPermittedException("You can´t delete bank accounts through the Besepa API");
    }

    function getEntityName(){
        return '\Besepa\Entity\BankAccount';
    }

    function getRequestData(EntityInterface $entity, $update=true){

        $data = json_decode( json_encode($entity), true );



        if(isset($data["mandate"]) && $data["mandate"]){
            unset($data["mandate"]["id"]);
            unset($data["mandate"]["status"]);
        }

        unset($data["id"]);
        unset($data["status"]);


        return array( "bank_account" => $data );


    }


} 