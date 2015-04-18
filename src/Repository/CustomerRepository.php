<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 2:04
 */

namespace Besepa\Repository;



use Besepa\Entity\EntityInterface;

class CustomerRepository extends AbstractRepository{



    function getResourcePath(){
        return "customers";
    }

    function getEntityName(){
        return '\Besepa\Entity\Customer';
    }

    function getRequestData(EntityInterface $entity, $update=true){

        $data = json_decode( json_encode($entity), true );

        if(!$update){
            unset($data["id"]);
            unset($data["status"]);
        }

        return array( "customer" => $data );


    }


} 