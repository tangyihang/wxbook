<?php
namespace frontend\controllers;
use Yii;
use yii\helpers\Json;
use frontend\config\CController;
use frontend\models\Gather;
use frontend\weixin\WeixinData;
use frontend\modelsDB\CollectCmUrlDB;
use frontend\modelsDB\CollectCmFieldDB;
use frontend\modelsDB\BooksourceDB;
use frontend\sphinx\BookinfoSphinx;
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
                	if (is_numeric($keyword)) {
                		$message = WeixinData::getbookSource($keyword);
                	} else {
                		$message = WeixinData::bookSearch($keyword);
                	}
                	if ($message['msgType'] == 'text') {
                		$resultStr = $this->template->toMsgText($fromUsername, $toUsername, $message['content']);
                	} else if ($message['msgType'] == 'news') {
                		$resultStr = $this->template->toMsgNews($fromUsername, $toUsername, $message['content']);
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
		$search = new BookinfoSphinx();
		$booksData = $search->search('');
		var_dump($booksData);
		var_dump($search);
		//根据关键字搜索书籍
		
		//根据
		
		
		
        /* echo '<pre>';
		$bookInfo = BooksourceDB::getBookSourcesById('340');
        //var_dump($bookInfo);die;
        $gather = new Gather(1);
        $rules = CollectCmUrlDB::getRuleInfo('1');
        foreach ($rules as $key => $value) {
            //var_dump($value);
            $fields = CollectCmFieldDB::getFieldInfo($value['id']);
            //var_dump($fields);
            if ($value['typeid'] == 1) {
                $murl = $gather->fetch_mfields($fields, $value['url_mstr'], $bookInfo['infourl']);
            } else if ($value['typeid'] == 2) {
                $murl = $gather->fetch_mfields($fields, $value['url_mstr'], $bookInfo['listurl']);
            } else {
                $murl = $gather->fetch_mfields($fields, $value['url_mstr'], $bookInfo['bcnewurl']);
            }
            var_dump($murl);
            //die;
        }

        var_dump($rules); */
		//$message = WeixinData::bookSearch('都市');
		//CollectCmFieldDB::setfield();//生成获取字段的规则
		//$resultStr = '1111';
		//echo $resultStr;
	}
	
	
}
