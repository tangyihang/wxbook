<?php
namespace frontend\modelsDB;

use Yii;
use yii\db\ActiveRecord;

/**
 * 小说采集详细规则
 * @author yihang
 *
 */
class CollectCmUrlDB extends ActiveRecord {
	
	public static function tableName() {
		return 'collect_cmurl';
	}
	
	/**
	 * 获取来源下规则的信息
	 * @param int $id
	 * @return \yii\caching\mixed
	 */
	public static function getRuleInfo($id){
		$key = 'CollectCmurlDB_getRuleInfo_sourceid_'.$id;
		$rules = \Yii::$app->cache->get($key);
		if (empty($rules)) {
			$rules = self::find()->where(['sourceid'=>$id])->all();
			\Yii::$app->cache->set($key, $rules, ONE_MONTH_TIME);
		}
		return $rules;
	}
	
	/**
	 * //CollectRuleDB::setrule();//生成规则
	 * @return boolean
	 */
	public static function setrule(){
		$rule = new CollectCmUrlDB();
		$rule->sourceid = '1';//来源网站主键id
		$rule->typeid = '3';//转换规则类型:1、书籍介绍页，2、书籍章节列表页，3、书籍章节详情页
		$rule->url_mstr = 'http://m.ckxsw.co/chapter/%bookid%/%chapterid%.html';//手机站链接规则
		$rule->save();
		var_dump($rule);
		return true;
	}
}
