<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use frontend\config\CController;
use frontend\weixin\WeixinBase;
use frontend\weixin\WeixinTemplate;

/**
 * Site controller
 */
class SiteController extends CController {
	
	public $template;
	public $weixinBase;
	
	public function beforeAction($action) {
		$this->template = new WeixinTemplate();
		$this->weixinBase = new WeixinBase();
	}
	
	public function actionIndex() {
		//get post data, May be due to the different environments
		$postStr = $this->wx_request_xml();

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
                	Yii::info($resultStr);
                } else {
                	echo "Input something...";
                }
                
        }else {
        	Yii::info('none postStr');
        	exit;
        }
	}
	
	/**
	 * 获取微信请求的XML数据
	 *
	 * @return xml
	 */
	function wx_request_xml(){
		if(!empty($GLOBALS["HTTP_RAW_POST_DATA"])){
			return $GLOBALS["HTTP_RAW_POST_DATA"];
		}else{
			return file_get_contents('php://input');
		}
	}
	
}
