<?php
namespace frontend\controllers;
use Yii;
use yii\helpers\Json;
use frontend\config\CController;
use frontend\models\Search;
use frontend\weixin\WeixinData;
/**
 * 首页
 */
class SiteController extends CController {
	
	//关键字找到多个书籍时返回书籍的ID和书籍的作者
	//关键字只找到一个书籍时直接返回数据的最新章节
	//书籍ID返回书籍最新的章节信息
	
	/**
	 * 返回消息
	 */
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
                	$message = WeixinData::bookSearch($keyword);
                	if ($message['msgType'] == 'text') {
                		$resultStr = $this->template->toMsgText($fromUsername, $toUsername, $message);
                	} else if ($message['msgType'] == 'news') {
                		
                	}
                	echo $resultStr;
                } else {
                	echo "Input something...";
                }
                
        }else {
        	echo '';
        	exit;
        }
	}
	
	
	public function actionTest(){
		/* $news = array(
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
		$resultStr = $this->template->toMsgNews($fromUsername, $toUsername, $news); */
		//$resultStr = $this->template->toMsgText($fromUsername, $toUsername, $keyword);
		
		//$message = WeixinData::bookSearch('都市');
		$message = WeixinData::getbookSource(324);
		var_dump($message);die;
		
		
		if ($message['msgType'] == 'text') {
			$resultStr = $this->template->toMsgText($fromUsername, $toUsername, $keyword);
		} else if ($message['msgType'] == 'news') {
			
		}
		echo $resultStr;
	}
	
	
}