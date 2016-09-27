<?php
namespace frontend\models;

use Yii;
use common\helps\globals;
use frontend\sphinx\BookinfoSphinx;
use frontend\modelsDB\InfobookDB;
use frontend\modelsDB\BooksourceDB;

/**
 * 书籍搜索类
 * @author v-tangyihang-yx
 *
 */
class Search {
	
	/**
	 * 获取书籍搜索结果
	 * @param string $keyword
	 */
	public static function getBooksInfo($keyword){
		$key = 'bookinfo_getBooks_bookname_'.$keyword;
		$books = \Yii::$app->cache->get($key);
		if (empty($books)){
			$books = InfobookDB::find()->where('bookname like :bookname')->addParams([':bookname' => '%'.$keyword.'%'])->limit(10)->all();
			//\Yii::$app->cache->set($key, $books, ONE_HOUSE_TIME);
		}
		return $books;
	}
	
	/**
	 * 根据书籍ID获取书籍来源列表
	 * @param int $bookid
	 */
	public static function getBookSourcesById($bookid){
		$key = 'bookinfo_getBookinfo_id_'.$bookid;
		$bookSource = \Yii::$app->cache->get($key);
		if (empty($bookSource)){
			$bookSource = BooksourceDB::find()->where(['bookid'=>$bookid])->all();
			//\Yii::$app->cache->set($key, $bookSource, ONE_HOUSE_TIME);
		}
		return $bookSource;
	}
	
	
}