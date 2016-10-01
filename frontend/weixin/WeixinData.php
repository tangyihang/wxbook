<?php
namespace frontend\Weixin;

use Yii;
use common\helps\globals;
use frontend\modelsDB\InfobookDB;
use frontend\modelsDB\BooksourceDB;

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
		$books = InfobookDB::getBooksInfo($keyword);
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
	
	/**
	 * 获取小说来源列表
	 * @param int $bookid
	 */
	public static function getbookSource($bookid){
		$bookInfo = BooksourceDB::getBookSourcesById($bookid);
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