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
    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->hint(Yii::t('app', 'Description').' '.Yii::t('app', 'For meta tag description')) ?>
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
            'imageUploadURL' => '/record/upload-image',
            //'imageUploadParams'=> ['file' => 'file'],
            'imageManagerLoadURL'=> '/record/load-images',
            'imageManagerDeleteURL'=> '/record/delete-image',
            'imageManagerDeleteMethod'=> 'POST',
            'height'=> 300,
            'imageDefaultWidth'=>0,
            'imageOutputSize'=> true,
            //'linkAlwaysBlank'=> true,// всегда открываем в новой вкладке
            'linkAlwaysNoFollow'=>false,
            //'linkMultipleStyles'=> false,
            //'linkStyles'=>[],
            'linkEditButtons'=>['linkOpen', 'linkEdit', 'linkRemove'],
            'linkText'=> true,
            'linkList'=>[
                [
                'text'=> 'sporthock.ru',
                'href'=> Yii::$app->params['path.frontend'],
                'target'=> '_blank',
                ]
            ],
            //'htmlAllowedAttrs'=> [],
            //'useClasses'=> false
            //'disableRightClick' => true
            //'width'=> 800,
            //'codeMirror'=> true,
        ],
        'excludedPlugins' =>[
            'emoticons'
        ],
    ]); // https://froala.com/wysiwyg-editor/docs/options опции?>
    <?php if(!is_null($model->getFirstError('preview'))){?>
        <div style="color:#a94442" class="help-block"><?php echo $model->getFirstError('preview');?></div>
    <?php }?>
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
            'imageUploadURL' => '/record/upload-image',
            //'imageUploadParams'=> ['file' => 'file'],
            'imageManagerLoadURL'=> '/record/load-images',
            'imageManagerDeleteURL'=> '/record/delete-image',
            'imageManagerDeleteMethod'=> 'POST',
            'height'=> 300,
            'imageDefaultWidth'=>0,
            'imageOutputSize'=> true,
            //'linkAlwaysBlank'=> true,// всегда открываем в новой вкладке
            'linkAlwaysNoFollow'=>false,
            //'linkMultipleStyles'=> false,
            //'linkStyles'=>[],
            'linkEditButtons'=>['linkOpen', 'linkEdit', 'linkRemove'],
            'linkText'=> true,
            'linkList'=>[
                [
                    'text'=> 'sporthock.ru',
                    'href'=> Yii::$app->params['path.frontend'],
                    'target'=> '_blank',
                ]
            ],
            //'htmlAllowedAttrs'=> [],
            //'width'=> 800,
            //'codeMirror'=> true,
        ]
    ]); // https://froala.com/wysiwyg-editor/docs/options опции?>
    <?php if(!is_null($model->getFirstError('content'))){?>
        <div style="color:#a94442" class="help-block"><?php echo $model->getFirstError('content');?></div>
    <?php }?>
    <?= $form->field($model, 'position')->textInput([])->hint(Yii::t('app', 'Position in site').': из '.$model::find()->count()) ?>
    <?= $form->field($model, 'status')->dropDownList(
        \backend\models\Record::getStatusesText(),
        ['prompt' => Yii::t('app', 'Select a status')]
    )->hint(Yii::t('app', 'Select a status'));  ?>

    <?= $form->field($model, 'tagsArray')->checkboxList(
        \backend\models\Tag::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['class'=>'checkbox']
    )->hint(Yii::t('app', 'Select or Update tags'));
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create and Leave') : Yii::t('app', 'Update and Leave'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','name'=>'Record[apply]']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
