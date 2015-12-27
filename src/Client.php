<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 2:00
 */

namespace Besepa;

use Besepa\Entity\EntityInterface;
use Besepa\Exceptions\ResourceInvalidException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Stream\Stream;
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
                        "mode"    => $sandbox_mode ? "sandbox." : "api.",
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

    private function  throwException(ClientException $e, $entity_name){

        $error_data = $e->getResponse()->json();

        switch($error_data["error"]){
            case 'invalid_resource':

                $exception = new ResourceInvalidException("Algunos campos son incorrectos en " . $entity_name);
                $exception->error_messages = $error_data["messages"];

                throw $exception;

                break;

            default:

                throw new ResourceInvalidException("Petición fallida");

        }

    }

    function getMany($path, $entity_name){

        try{
            /**
             * @var $response \GuzzleHttp\Message\AbstractMessage
             */
            $response = $this->client->get($path);
            $data     = $response->json();

            $mapper = new \JsonMapper();
            return $mapper->mapArray( $data["response"], new \ArrayObject(), $entity_name );


        }catch (ClientException $e){
            //$e->getMessage();
            $this->throwException($e, $entity_name);
        }

    }

    function get($path, $entity_name){

        try{
            /**
             * @var $response \GuzzleHttp\Message\AbstractMessage
             */
            $response = $this->client->get($path);
            $data     = $response->json(['object'=>true]);
            //pr($data);

            $mapper = new \JsonMapper();
            return $mapper->map( $data->response, new $entity_name );

        }catch (ClientException $e){
            //var_dump($e);die();

            $this->throwException($e, $entity_name);
        }

    }

    function create($path, $body_data, $entity_name){

        try{


            /**
             * @var $response \GuzzleHttp\Message\Response
             */
            $response  = $this->client->post($path, array(
                'json' => $body_data
            ));
            $data     = $response->json(['object'=>true]);

            $mapper      = new \JsonMapper();
            return $mapper->map( $data->response, new $entity_name );

        }catch (ClientException $e){

            $this->throwException($e, $entity_name);

        }

    }

    function update($path, $body_data, $entity_name){

        try{
            /**
             * @var $response \GuzzleHttp\Message\AbstractMessage
             */
            $response = $this->client->put($path, array(
                'json' => $body_data
            ));
            $data     = $response->json();

            $mapper      = new \JsonMapper();
            return $mapper->map( $data["response"] , new $entity_name );

        }catch (\Exception $e){
            $this->throwException($e, $entity_name);
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
            $this->throwException($e, null);
        }

    }
} 