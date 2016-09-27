<?php
namespace frontend\Weixin;

use Yii;
use common\helps\globals;
use frontend\models\Search;
use frontend\weixin\WeixinBase;
use frontend\weixin\WeixinTemplate;

/**
 * 组成微信数据
 * @author v-tangyihang-yx
 *
 */
class WeixinData{
	
	/**
	 * 获取搜索结果数据
	 * @param string $keyword
	 */
	public static function bookSearch($keyword){
		$books = Search::getBooksInfo($keyword);
		$msgType = 'text';
		$content = '未搜索到您找的小说，请确认小说名称是否正确。';
		if (!empty($books)) {
			if (count($books) > 1) {
				$content = self::getbookList($books);
		var_dump($content);
			}
		}
		return array(
				'msgType' => $msgType,
				'content' => $content
		);
	}
	
	/**
	 * 获取微信书籍列表数据
	 * @param string $keyword
	 */
	public static function getbookList($books){
		$content = '';
		foreach ($books as $v) {
			$content .= '书号：'.$v['bookid'].'，名称：，'.$v['bookname'].'作者：'.$v['author'].'。\n';
		}
		return  $content;
	}
	
	
	
}