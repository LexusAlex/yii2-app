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
        if(!empty(\Yii::$app->request->get('page'))){
            $p = \Yii::$app->request->get('page');
        } else {
            $p = null;
        }
        return $this->render('index',['page' => $p]);
    }

    /**
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}