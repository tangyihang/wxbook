<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use common\config\CController;

/**
 * Site controller
 */
class SiteController extends CController
{
	public function actionIndex() {
		echo 111;
	}
}