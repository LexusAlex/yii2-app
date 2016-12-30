<?php

namespace frontend\controllers;

use backend\models\Record;
use samdark\sitemap\Sitemap;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

/**
 * Class FrontController
 * @package frontend\controllers
 */
class FrontController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'sitemap' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {

        if($action->id === "sitemap"){
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
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

    public function actionSitemap()
    {
        $sitemap = new Sitemap(\Yii::getAlias('@frontend/web') . '/sitemap.xml');
        $this->addUrls($sitemap);
        $sitemap->write();
        $this->redirect(['/sitemap.xml']);
    }

    private function addUrls(Sitemap $sitemap)
    {
        $sitemap->addItem(Url::to('/', true), null, Sitemap::ALWAYS, 1);
        $baseUrls = [
            'about'
        ];
        foreach ($baseUrls as $baseUrl) {
            $sitemap->addItem(Url::toRoute($baseUrl, true), null, Sitemap::DAILY, 0.2);
        }
        $records = Record::find()
            ->select(['title','slug','created_at'])
            ->andWhere(['status'=>10])
            ->asArray()
            //->with(['category','tagArticles'])
            ->orderBy('position DESC, created_at DESC')
            ->all();

        foreach ($records as $record) {
            $url = Url::to(['blog/view','slug' => $record['slug']], true);
            $sitemap->addItem($url, $record['created_at'], null, 0.3);
        }

    }

}