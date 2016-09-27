<?php
namespace frontend\modelsDB;

use Yii;
use yii\db\ActiveRecord;

/**
 * 生成全局的唯一id
 * @author yihang
 *
 */
class TicketmutexDB extends ActiveRecord {
	
	public static function tableName() {
		return 'ticket_mutex';
	}
	
	/**
	 * 生成全局的唯一的id
	 * @param string $name
	 * @param int $num
	 */
	public static function getNextId($name, $num = 1){
		$connection = \Yii::$app->db;
		$threshold = 100; //最大尝试次数
		for($i = 0; $i < $threshold; $i++){
			$last_id = self::find()->where(array('name' => $name))->one();//从数据库获取全局id
			$id = $last_id->value + 1;
			$ret = $connection->createCommand("UPDATE ticket_mutex SET value=".$id." WHERE name='".$name."' and value < ".$id." ;")->execute();
			if($ret){
				return $id;
				break;
			}
		}
	}
}