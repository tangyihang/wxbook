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
		if (!empty($books)) {
			$message = self::getbookList($books);
		} else {
			$message = array(
				'msgType' => 'text',
				'content' => '未搜索到您找的小说，请确认小说名称是否正确。'
			);
		}
		return $message;
	}
	
	/**
	 * 获取小说来源列表
	 * @param int $bookid
	 */
	public static function getbookSource($bookid){
		$bookInfo = Search::getBookSourcesById($bookid);
		$msgType = 'news';
		$content = array();
		if (!empty($bookInfo)) {
			foreach ($bookInfo as $v) {
				$content[] = array(
						'title' => $v['bcnewtitle'],
						'desc' => $v['info'],
						'pic' => $v['imgsourceurl'],
						'link' => $v['listurl'],
				);
			}
		} else {
			$msgType = 'text';
			$content = '未搜索到您找的小说，请确认小说ID是否正确。';
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
		$msgType = 'text';
		$content = '';
		foreach ($books as $v) {
			$content .= "书号：".$v['bookid']."，名称：".$v['bookname']."，作者：".$v['author']."\n";
		}
		return array(
				'msgType' => $msgType,
				'content' => $content
		);
	}
	
	
	
}