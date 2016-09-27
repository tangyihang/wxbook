<?php
namespace frontend\modelsDB;

use Yii;
use yii\db\ActiveRecord;
/**
 * 意见内容表
 * @author yihang
 *
 */
class FeedbackDB extends ActiveRecord {
	
	public static function tableName() {
		return 'feedback';
	}
	
	
	
}