<?php

namespace frontend\controllers;

use backend\models\Category;
use backend\models\Record;
use backend\models\Tag;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class BlogController
 * @package frontend\controllers
 */
class BlogController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['/front/index']);
    }
    /**
     * Отображение одной конкретной записи
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        $model = Record::find()
            ->select(['id','category_id','title','slug','preview','content','status','created_at'])
            ->andWhere(['slug'=>$slug,'status'=>10])
            ->one();

        if ($model !== null) {
            return $this->render('view',['model'=>$model]);
        } else {
            throw new NotFoundHttpException(\Yii::t('app', 'The requested article does not exist.'));
        }
    }

    /**
     * Отображение записей в конктретной категории
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategory($id)
    {
        $records = Record::find()
            ->select(['id','category_id','title','slug','preview','content','status','created_at'])
            ->andWhere(['category_id'=>$id ,'status'=>10])
            ->with(['category','tagArticles'])
            ->orderBy('created_at DESC');

        if ($records !== null) {
            $dataProvider = new ActiveDataProvider([
                'query' => $records,
                'pagination' => [
                    'pageSize' => 5,
                    'pageSizeParam' => false,
                    'forcePageParam' => false,
                    //'route' => 'front/index'
                ],
            ]);

            if(!empty($dataProvider->getModels())){
                $category = $dataProvider->getModels()[0]->category->title;
            } else {
                $category = null;
            }

            if(!empty(\Yii::$app->request->get('page'))){
                $p = \Yii::$app->request->get('page');
            } else {
                $p = null;
            }

            return $this->render('category',['dataProvider'=>$dataProvider,'category'=>$category, 'page'=>$p]);
        } else {
            throw new NotFoundHttpException(\Yii::t('app', 'The requested article does not exist.'));
        }
    }

    /**
     * Отображение записей с определенным тегом
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionTag($name)
    {
        $tag = Tag::find()
            ->select(['id','name'])
            ->andWhere(['name'=>$name])
            ->one();

        if ($tag !== null) {
            $dataProvider = new ActiveDataProvider([
                'query' => $tag->getTagArticles()->with(['tagArticles'])->orderBy('created_at DESC'),
                'pagination' => [
                    'pageSize' => 5,
                    'pageSizeParam' => false,
                    'forcePageParam' => false,
                    //'route' => 'front/index'
                ],
            ]);
            if(!empty(\Yii::$app->request->get('page'))){
                $p = \Yii::$app->request->get('page');
            } else {
                $p = null;
            }

            return $this->render('tag',['dataProvider'=>$dataProvider,'tag'=>$tag->name, 'page'=>$p]);
        } else {
            throw new NotFoundHttpException(\Yii::t('app', 'The requested article does not exist.'));
        }
    }
}