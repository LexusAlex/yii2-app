<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Record */

$this->title = Yii::t('app', 'Create Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
