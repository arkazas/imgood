<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

	public function actionIndex()
	{
		return $this->render('index');
	}
}