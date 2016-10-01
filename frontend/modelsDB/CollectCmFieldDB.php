<?php
namespace frontend\modelsDB;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * 小说采集详细规则
 * @author yihang
 *
 */
class CollectCmFieldDB extends ActiveRecord {
	
	public static function tableName() {
		return 'collect_cmurlfiled';
	}
	
	/**
	 * 获取来源下规则获取的字段信息
	 * @param int $id
	 * @return \yii\caching\mixed
	 */
	public static function getFieldInfo($ruleid){
		$key = 'CollectCmFieldDB_getFieldInfo_ruleid_'.$ruleid;
		$fields = \Yii::$app->cache->get($key);
		if (empty($fields)) {
			$fields = self::find()->where(['cruleid' => $ruleid])->all();
			\Yii::$app->cache->set($key, $fields, ONE_MONTH_TIME);
		}
		return $fields;
	}
	
	/* 字段类型
		$allfields = array (
				'bookid' => '',//书籍ID
				'chapterid' => '',//章节ID
		);
	*/
	
	/**
	 * //CollectFieldDB::setfield();//生成获取字段的规则
	 * @return boolean
	 */
	public static function setfield(){
		$field = new CollectCmFieldDB();
		$field->sourceid = '1';
		$field->fieldname = 'chapterid';//字段名
		$field->cruleid = '3';//所属规则id
		$field->uregular = 'http://www.ckxsw.co/chkbook/(?)/(?)/(*).html';//规则
		$field->save();
		var_dump($field);
		return true;
	}
	
}