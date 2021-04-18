<?php

require(__DIR__.'/../Model/Product.php');

use App\Storage;

class QueueWorker{

    private $_reader;
    private $_writer;

    public function __construct(){
        $this->_reader = new Storage\Reader();
        $this->_writer = new Storage\Writer();
        $this->_product = new Product();
    }

    public function checkQueue(){
        $dir = $this->_reader->getStoragePath();
        $files = glob($dir.'queued-*');
        if(count($files) == 0){
            return 'queue_empty';
        }
        foreach($files as $file){
            echo $this->_processfromqueue($file) . "\n";
        }
        return true;
    }

    public function checkQueueItem(){
        $dir = $this->_reader->getStoragePath();
        $files = glob($dir.'queued-*');
        if(count($files) == 0){
            return 'queue_empty';
        }
        return $this->_processfromqueue($files[0]);
    }

    private function _processfromqueue($filepath){
        try{
            $filename = substr($filepath, strrpos($filepath,'/'));
            $json_data = $this->_reader->read($filename);
            if(!$json_data){
                throw new Exception('error_getting_queue_item');
            }
            $data = json_decode($json_data, true);
            if(!$action = $data['action']){
                throw new Exception('item_data_missing_action');
            }
            if(!$data = $data['data']){
                throw new Exception('item_data_missing_data');
            }
            if(!in_array($action, ['create','update','delete'])){
                throw new Exception('invalid_action');
            }
            return $this->_processAction($action, $data);
        }catch(Exception $e){
            throw $e;
        }finally{
            $this->_writer->delete($filename);
        }
    }

    private function _processAction($action, $data){
        try{
            /** Actual busines logic here  */
            $ret = $this->_product->process($action, $data);
            echo "Product ".$action."d: ".implode(' ', $ret);
        }catch(Exception $e){
            /**
             * handle exception coming from business logic
             */
        }
    }
}