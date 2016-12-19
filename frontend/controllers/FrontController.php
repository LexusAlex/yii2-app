<?php

namespace frontend\controllers;

use yii\base\Controller;

/**
 * Class FrontController
 * @package frontend\controllers
 */
class FrontController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}