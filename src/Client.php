<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 2:00
 */

namespace Besepa;

use Besepa\Entity\EntityInterface;
use GuzzleHttp\Transaction;

class Client {


    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    const ENDPOINT_ROOT = "besepa.com/api/{version}/";


    function __construct($api_key, $sandbox_mode=false){
        $this->client = new \GuzzleHttp\Client(
            array(
                "base_url" => array(
                    "https://{mode}" . static::ENDPOINT_ROOT,
                    array(
                        "mode"    => $sandbox_mode ? "sandbox." : "",
                        "version" => 1
                    )
                ),
                'defaults' => array(
                    'headers' => array(
                        'Authorization' => 'Bearer ' . $api_key,
                    ),
                ),
            )
        );
    }

    function getMany($path, $entity_name){

        try{
            /**
             * @var $response \GuzzleHttp\Message\AbstractMessage
             */
            $response = $this->client->get($path);
            $data     = $response->getBody();

            $mapper = new \JsonMapper();
            return $mapper->mapArray( $data, new \ArrayObject(), $entity_name );

        }catch (\Exception $e){

        }

    }

    function get($path, $entity_name){

        try{
            /**
             * @var $response \GuzzleHttp\Message\AbstractMessage
             */
            $response = $this->client->get($path);
            $data     = $response->getBody();

            $mapper = new \JsonMapper();
            return $mapper->map( $data, new $entity_name );

        }catch (\Exception $e){

        }

    }

    function create($path, $body_data, $entity_name){

        try{
            /**
             * @var $response \GuzzleHttp\Message\AbstractMessage
             */
            $response = $this->client->post($path);
            $data     = $response->getBody();

            $mapper      = new \JsonMapper();
            return $mapper->map( $data, new $entity_name );

        }catch (\Exception $e){

        }

    }

    function update($path, $body_data, $entity_name){

        try{
            /**
             * @var $response \GuzzleHttp\Message\AbstractMessage
             */
            $response = $this->client->put($path);
            $data     = $response->getBody();

            $mapper      = new \JsonMapper();
            return $mapper->map( $data, new $entity_name );

        }catch (\Exception $e){

        }

    }

    function delete($path){

        try{
            /**
             * @var $response \GuzzleHttp\Message\ResponseInterface
             */
            $response = $this->client->delete($path);

            return $response->getStatusCode() == 200;

        }catch (\Exception $e){

        }

    }
} 