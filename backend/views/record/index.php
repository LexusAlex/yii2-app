<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Records');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Record'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [ // класс для таблицы
            'class' => 'table table-striped table-bordered'
        ],
        'showFooter'=> true, // отображаем футер

        'layout' => "{summary}\n{items}\n{pager}", // шаблон отображения
        /**
         * $model - текущая модель
         * $key - порядковый номер
         * $index - индекс
         * $grid - грид
         *
         * можно что-то делать с результатом
         */
        'rowOptions'=>function ($model, $key, $index, $grid){ // установим класс для четных и нечетных столбцов
            $class=$index%2 ?'odd':'even';
            return [
                //'key'=>$key,
                //'index'=>$index,
                'class'=>$class
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'category_id',
                'filter' => \backend\models\Category::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'category.title',
                /*'content'=>function($data){
                    return $data->category->title;
                },*/
            ],
            /*[
                'attribute' => 'user_id',
                'filter' => \common\models\User::find()->select(['username', 'id'])->indexBy('id')->column(),
                'value' => 'user.username',
            ],*/
            'slug',
            // 'preview:ntext',
            // 'content:ntext',
            [
                'attribute' => 'status',
                //'filter' => [0 => 'Не опубликован', 1 => 'Опубликован', 2 => 'Черновик'],
                'filter' => \backend\models\Record::getStatusesText(),
                'format' => 'text',
                'content'=>function($data){
                    return $data->getStatusLabel();
                },
            ],
            [
                'attribute' => 'created_at',
                //'format' => 'datetime',
                'format' => ['datetime', 'php:d F Y G:i:s'],
                /*'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'type' => \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
                    //'convertFormat' => true,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-M-dd h:i:s',
                        'todayHighlight' => true
                    ]
                ]),*/
                /*'filter' => \dosamigos\datetimepicker\DateTimePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'language' => 'ru',
                    'clientOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd h:ii:s',
                        //'todayBtn' => true
                        'todayHighlight' => true,
                        'minuteStep'=> 1
                    ]
                ]),*/
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['datetime', 'php:d F Y G:i:s'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> Yii::t('app', 'Action'),
                'template' => '{view} {update} {delete}',
            ],
            // типы стоблцов 	'raw' , 'text' , 'html' , 'image', 'datetime',  'time', 'date', ['date', 'php:Y-m-d']
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
