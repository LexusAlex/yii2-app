<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'parent_id',
                //'filter' => \backend\models\Category::find()->select(['title', 'id'])->where(['not',['parent_id'=>null]])->indexBy('id')->column(),
                            /*->select(['title','parent_id'])
                            ->where(['not',['parent_id'=>null]])
                            ->indexBy('parent_id')->column(),*/
                'filter' => \backend\models\Category::getParentsList(),
                'value' => 'parent.title',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> Yii::t('app', 'Action'),
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
