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
    public function actionIndex()
    {
        \Yii::$container->set('yii\widgets\LinkPager', [
            'registerLinkTags'=> true,
            'options' => ['class' => 'pagination'], //ul
            'pageCssClass'=>'pagination__item', // li
            'firstPageCssClass' => 'pagination__item pagination__item_first', //first
            'prevPageCssClass' =>  'pagination__item pagination__item_prev', // prev
            'nextPageCssClass' =>  'pagination__item pagination__item_next', // next
            'lastPageCssClass' =>  'pagination__item pagination__item_last', // last
            'activePageCssClass' => 'pagination__item_current', // active
            'disabledPageCssClass' => 'pagination__item_disabled', // disabled
            'linkOptions' => ['class'=> 'pagination__link'], //a
            'firstPageLabel' => 'Первая',
            'lastPageLabel' => 'Последняя',
            'nextPageLabel' => 'Следующая',
            'prevPageLabel' => 'Предыдущая',
            'maxButtonCount' => 5,
        ]);
        $records = Record::find()->select(['id','category_id','title','slug','preview','status','created_at'])->andWhere(['status'=>10])->with(['category','tagArticles'])->orderBy('id DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $records,
            'pagination' => [
                'pageSize' => 2,
                'pageSizeParam' => false,
                'forcePageParam' => false,
                //'route' => 'front/index'
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}