<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use frontend\config\CController;

/**
 * Site controller
 */
class SiteController extends CController {
	
	public function actionIndex() {
		//get post data, May be due to the different environments
		$postStr = $this->weixinBase->wx_request_xml();

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                
                if (!empty($keyword)) {
                	$resultStr = $this->template->toMsgText($fromUsername, $toUsername, $keyword);
                	echo $resultStr;
                } else {
                	echo "Input something...";
                }
                
        }else {
        	echo '';
        	exit;
        }
	}
	
}
