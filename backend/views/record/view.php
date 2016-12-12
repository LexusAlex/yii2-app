<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Record */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Create Record'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Records'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => $model->category->title
            ],
            [
                'label' => 'user_id',
                'value' => $model->user->username
            ],
            'title:text',
            'slug',
            'preview:html',
            'content:html',
            [
                'attribute' => 'tagsArray',
                'value'=>implode(', ', \yii\helpers\ArrayHelper::map($model->tagArticles, 'id', 'name')),
            ],
            'status',
            [
                'attribute' => 'created_at',
                'format' => ['datetime', 'php:d F Y G:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['datetime', 'php:d F Y G:i:s'],
            ],
        ],
    ]) ?>

</div>
