<?php

require(__DIR__.'/../Storage/Writer.php');

use App\Storage;

class Queue{


    public function __construct() {
        $this->_writer = new Storage\Writer();
    }

    public function add($action, $data){
        $attempt = 0;
        try{
            $key = 'queued-'.microtime(true) . '-'.$action.'-'.$data['id'];
            $payload = ['action'=>$action,'data'=>$data];
            $this->_writer->create($key, json_encode($payload));
        }catch(Exception $e){
            $attempt++;
            if($attempt<5){
                return $this->add($action, $data);
            }
            throw $e;
        }
        return true;
    }
}