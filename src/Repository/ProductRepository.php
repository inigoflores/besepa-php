<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 2:04
 */

namespace Besepa\Repository;



use Besepa\Entity\EntityInterface;
use Besepa\Entity\Product;
use Besepa\Exceptions\OperationNotPermittedException;


class ProductRepository extends AbstractRepository{



    function create(EntityInterface $entity ){
        throw new OperationNotPermittedException("You can´t create products through the Besepa API");
    }

    function getResourcePath(){
        return "products";
    }

    function getEntityName(){
        return '\Besepa\Entity\Product';
    }

    function getRequestData(EntityInterface $entity, $update=true){

        $data = json_decode( json_encode($entity), true );

        if(!$update){
            unset($data["id"]);
            unset($data["status"]);
        }

        return array( "product" => $data );


    }


} 