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
                	$news = array(
                			array(
                					'title' => '凡人修仙传 起点中文网',
                					'desc' => '凡人修仙传 起点中文网得desc',
                					'pic' => 'http://qidian.qpic.cn/qdbimg/349573/107580/180',
                					'link' => 'http://read.qidian.com/BookReader/Gyliu2kLjSQ1.aspx',
                			),
                			array(
                					'title' => '凡人修仙传 笔趣阁',
                					'desc' => '凡人修仙传 笔趣阁desc',
                					'pic' => 'http://www.biquku.com/d/image/1/1429/1429s.jpg',
                					'link' => 'http://www.biquku.com/1/1429/',
                			),
                	);
                	$resultStr = $this->template->toMsgNews($fromUsername, $toUsername, $news);
                	//$resultStr = $this->template->toMsgText($fromUsername, $toUsername, $keyword);
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
