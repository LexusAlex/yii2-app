<?php

namespace frontend\controllers;

use backend\models\Record;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

/**
 * Class FrontController
 * @package frontend\controllers
 */
class FrontController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}