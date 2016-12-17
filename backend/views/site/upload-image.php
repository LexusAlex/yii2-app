<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\forms\ImageForm */

use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Uploaded Images');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xs-8 col-xs-offset-2">
    <h1 class="text-center"><?= \yii\helpers\Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?php echo \kartik\file\FileInput::widget([
    'model' => $model,
    //'attribute' => 'imageFiles[]',
    'attribute' => 'imageFiles[]',
    'options' => [
        //'multiple' => false,
        'multiple' => true,
        'accept' => 'image/*',
        'maxFileCount' => 4,
        'previewFileType' => 'any',
    ],
    'pluginOptions' => [
        'showPreview' => true,
    ],
]);
?>
<?= \yii\helpers\Html::error($model, 'imageFiles', ['class' => 'text-danger']) ?>
    <br>
    <button class="btn btn-default">Submit</button>

<?php ActiveForm::end() ?>

</div>
