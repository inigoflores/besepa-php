<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 2:03
 */

namespace Besepa\Repository;


use Besepa\Client;
use Besepa\Entity\EntityInterface;

abstract class AbstractRepository {

    protected $client;



    function __construct(Client $client){
        $this->client = $client;
    }

    function findAll( $page=1 ){

        $path =  $this->getResourcePath() . "?page=" . $page;
        return $this->client->getMany( $path, $this->getEntityName() );
    }

    function find( $id ){
        $path =  $this->getResourcePath() . "/" . $id;
        return $this->client->get( $path, $this->getEntityName() );
    }

    function create(EntityInterface $entity ){
        $path =  $this->getResourcePath();

        return $this->client->create( $path, $this->getRequestData($entity, false), $this->getEntityName() );
    }

    function update(EntityInterface $entity ){
        $path =  $this->getResourcePath() . "/" . $entity->getId();
        return $this->client->update( $path, $this->getRequestData($entity), $this->getEntityName() );
    }

    function delete( EntityInterface $entity ){
        $path =  $this->getResourcePath() . "/" . $entity->getId();
        return $this->client->delete( $path );
    }

    abstract function getResourcePath();

    abstract function getEntityName();

    abstract function getRequestData(EntityInterface $entity, $update=true);

} 