<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Record */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-xs-8 col-xs-offset-2 record-form">

    <?php $form = ActiveForm::begin();  ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        \backend\models\Category::find()->select(['title', 'id'])->indexBy('id')->column(),
        ['prompt' => Yii::t('app', 'Select a category')]
    )->hint(Yii::t('app', 'Select a category')); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->hint(Yii::t('app', 'Title and Slug')) ?>
    <label><?php echo Yii::t('app', 'Preview')?></label>
    <?php echo froala\froalaeditor\FroalaEditorWidget::widget([
        'model' => $model,
        'attribute' => 'preview',
        'options'=>[// html attributes
            'rows'=>10
        ],
        'clientOptions'=>[
            'toolbarInline'=> false,
            'theme' =>'gray',//optional: dark, red, gray, royal
            'language'=>'ru', // optional: ar, bs, cs, da, de, en_ca, en_gb, en_us ...
            'fileUploadURL' => '/upload',
            'imageManagerLoadURL' => '/upload',
            'imageUploadURL' => '/upload',
            'height'=> 300,
            //'width'=> 800,
            //'codeMirror'=> true,
        ]
    ]); // https://froala.com/wysiwyg-editor/docs/options опции?>

    <label><?php echo Yii::t('app', 'Content')?></label>
    <?php echo froala\froalaeditor\FroalaEditorWidget::widget([
        'model' => $model,
        'attribute' => 'content',
        'options'=>[// html attributes
            'rows'=>10
        ],
        'clientOptions'=>[
            'toolbarInline'=> false,
            'theme' =>'gray',//optional: dark, red, gray, royal
            'language'=>'ru', // optional: ar, bs, cs, da, de, en_ca, en_gb, en_us ...
            'fileUploadURL' => '/upload',
            'imageManagerLoadURL' => '/upload',
            'imageUploadURL' => '/upload',
            'height'=> 300,
            //'width'=> 800,
            //'codeMirror'=> true,
        ]
    ]); // https://froala.com/wysiwyg-editor/docs/options опции?>

    <?= $form->field($model, 'status')->dropDownList(
        \backend\models\Record::getStatusesText(),
        ['prompt' => Yii::t('app', 'Select a status')]
    )->hint(Yii::t('app', 'Select a status'));  ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
