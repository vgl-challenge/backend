<?php

require(__DIR__.'/Queue.php');

use App\Storage;

class Product{

    private $queue;
    private $_reader;
    private $_writer;

    public function  __construct() {
        $this->queue = new Queue();
        $this->_reader = new Storage\Reader();
        $this->_writer = new Storage\Writer();
    }

    private function _parsePayload($payload, $action){
        try {
            //remove called script from payload
            array_shift($payload);
            $data = [];
            $allowed_fields = ['id','name','price'];
            for($x=0;$x<count($payload);$x++){
                $data[$allowed_fields[$x]] = $payload[$x];
            }

            if(($action == 'create' && count($data) != 3) ||
                $action == 'delete' && count($data) != 1){
                throw new Exception('wrong_params_count');
            }
            if(!array_key_exists('id', $data)){
                throw new Exception('missing_id');
            }
            return $data;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function createFromPayload($payload){
        $data = $this->_parsePayload($payload, 'create');
        /** TODO more validation checking specific to create */
        $this->queue->add('create', $data);
    }

    public function updateFromPayload($payload){
        $data = $this->_parsePayload($payload, 'update');
        /** TODO more validation checking specific to update */
        $this->queue->add('update', $data);
    }

    public function deleteFromPayload($payload){
        $data = $this->_parsePayload($payload, 'delete');
        /** TODO more validation checking specific to delete */
        $this->queue->add('delete', $data);
    }

    public function process($action, $data){
        $key = 'product-'.$data['id'];
        if($action == 'create') {
            $this->_writer->create($key, json_encode($data));
            return $data;
        }
        if($action == 'update'){
            $res = $this->_reader->read($key);
            $current_data = json_decode($res, true);
            $changed = array_diff($data, $current_data);
            $data = array_merge($current_data, $data);
            $this->_writer->update($key, json_encode($data));
            return $changed;
        }
        if($action == 'delete'){
            $this->_writer->delete($key);
            return $data;
        }
        return true;
    }

}