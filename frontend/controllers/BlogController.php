<?php

namespace frontend\controllers;

use yii\base\Controller;

/**
 * Class BlogController
 * @package frontend\controllers
 */
class BlogController extends Controller
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
    public function actionCategory()
    {
        return $this->render('category');
    }

    /**
     * @return string
     */
    public function actionTag()
    {
        return $this->render('tag');
    }
}