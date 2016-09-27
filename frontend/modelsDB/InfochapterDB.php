<?php
namespace frontend\modelsDB;

use Yii;
use yii\db\ActiveRecord;

/**
 * 章节信息
 */
class InfochapterDB extends ActiveRecord {
	
	static $sourceid;
	
// 	public function __construct($sourceid){
// 		self::$sourceid = $sourceid;
// 		parent::__construct();
// 	}
	
	public static function tableName() {
		return 'info_chapter';
	}
	
	public static function getBookChapters($bookid){
		$chapterData = self::find()->where(['bookid'=>$bookid])->indexBy('chaptertitle')->all();
		$chapters = array();
		if (!empty($chapterData)) {
			foreach ($chapterData as $key => $value) {
				$chapters[self::filter_mark($key)] = $value;
			}
		}
		return $chapters;
	}
	
	/**
	 * 去掉字符串中全部的标点符号和空格
	 * @param string $text
	 * @return string
	 */
	public static function filter_mark($text){
		if(trim($text)=='')return '';
		//去掉英文字符
		$text=preg_replace("/[[:punct:]\s]/",'',$text);
		//去掉中文字符
		$text = preg_replace('/[\x{2018}-\x{2026}\x{3000}-\x{301e}\x{fe50}-\x{ff1f}]/u','',$text);
		return trim($text);
	}

}