<?php

namespace frontend\controllers;

use backend\models\Record;
use yii\base\Controller;
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
        $records = Record::find()->select(['id','category_id','title','slug','preview','status','created_at'])->andWhere(['status'=>10])->with(['category','tagArticles'])->orderBy('created_at DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $records,
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false,
                'forcePageParam' => false,
                //'route' => 'front/index'
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

    /**
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}