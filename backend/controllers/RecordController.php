<?php

namespace backend\controllers;

use FroalaEditor\Image;
use Yii;
use backend\models\Record;
use backend\models\RecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

require (__DIR__ . '/../../vendor/froala/wysiwyg-editor-php-sdk/lib/FroalaEditor.php');

/**
 * RecordController implements the CRUD actions for Record model.
 */
class RecordController extends Controller
{
    //public $enableCsrfValidation = false;
    public function beforeAction($action) {

        if($action->id === "upload-image" || $action->id === "delete-image"){
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Record models.
     * @return mixed
     */
    public function actionIndex()
    {
        // модель для поиска в Grid
        $searchModel = new RecordSearch();
        // параметризированные данные
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Record model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Record model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Record();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', '{model} was successfully added',['model' => 'record',]));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Record model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', '{model} was successfully updated',['model' => 'record',]));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Record model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('warning', Yii::t('app', '{model} №{number} was successfully deleted',['model' => 'record','number'=> $id]));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Record model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Record the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Record::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Загрузка изображения на сервер
     * @return \StdClass
     */
    public function actionUploadImage()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

       // $response = Image::upload(\Yii::getAlias('@backend/web/upload/'));
        //$response = Image::upload(\Yii::$app->params['path.images'].'/');
        $response = Image::upload('/uploads/images/');
        return $response;
        //$uploadfile = \Yii::getAlias('@backend/web/upload/').$_FILES['file']['name'];
        //move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
        //$items = Record::find()->all();
        //return $items;
    }

    /**
     * Показ всех загруженных изображений в редакторе
     * @return array
     */
    public function actionLoadImages(){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = Image::getList('/uploads/images/');
        return $response;
    }

    /**
     * Удаление изображения из директории сервера
     * @return bool
     */
    public function actionDeleteImage(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = Image::delete($_POST['src']);
        return $response;
    }
}
