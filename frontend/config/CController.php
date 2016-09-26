<?php
namespace frontend\config;
use Yii;

use yii\web\Controller;
use yii\web\Application;
use common\helps\globals;
use frontend\weixin\WeixinBase;
use frontend\weixin\WeixinTemplate;

class CController extends Controller {

    public $user = [];
    public $subDomain;
    public $template;
    public $weixinBase;

    public function beforeAction($action) {
    	
    	if (!empty($_GET['echostr'])) {
	    	$echoStr = $_GET['echostr'];
	    	if($this->checkSignature()){
	    		echo $echoStr;
	    		exit;
	    	}
    	}
    	
    	$this->template = new WeixinTemplate();
    	$this->weixinBase = new WeixinBase();

        return true;
    }
    
    //微信验证
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
