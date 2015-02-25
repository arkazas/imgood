<?php

namespace app\modules\admin\controllers;

use yii;

class StorageController extends \yii\web\Controller
{
	public function actionIndex()
	{
		return $this->render('index');
	}

}
