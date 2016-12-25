<?php

namespace frontend\controllers;

use backend\models\Category;
use backend\models\Record;
use yii\base\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class BlogController
 * @package frontend\controllers
 */
class BlogController extends Controller
{
    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView()
    {
        $slug = \Yii::$app->request->get('slug');

        if (($model = Record::findOne(['slug'=>$slug])) !== null) {
            return $this->render('view',['model'=>$model]);
        } else {
            throw new NotFoundHttpException(\Yii::t('app', 'The requested article does not exist.'));
        }
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