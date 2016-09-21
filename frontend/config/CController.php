<?php
namespace frontend\config;
use Yii;

use yii\web\Controller;
use yii\web\Application;
use common\helps\globals;

class CController extends Controller {

    public $user = [];
    public $subDomain;

    public function beforeAction($action) {
    	
    	$echoStr = isset($_GET['echostr']) ? $_GET['echostr'] : '';
    	if($this->checkSignature()){
    		echo $echoStr;
    		exit;
    	}

        return true;
    }
    
    private function checkSignature() {
    	// you must define TOKEN by yourself
    	if (!defined("TOKEN")) {
    		throw new Exception('TOKEN is not defined!');
    	}
    
    	$signature = $_GET["signature"];
    	$timestamp = $_GET["timestamp"];
    	$nonce = $_GET["nonce"];
    
    	$token = TOKEN;
    	$tmpArr = array($token, $timestamp, $nonce);
    	// use SORT_STRING rule
    	sort($tmpArr, SORT_STRING);
    	$tmpStr = implode( $tmpArr );
    	$tmpStr = sha1( $tmpStr );
    
    	if( $tmpStr == $signature ){
    		return true;
    	}else{
    		return false;
    	}
    }

}
