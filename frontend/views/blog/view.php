<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Record */

use yii\helpers\Html;

$this->title = $model->title;
$this->registerMetaTag(['name' => 'description','content' => \yii\helpers\StringHelper::truncateWords(strip_tags($model->preview),20 , '')]);
?>
<section class="row__left">
    <article class="article" role="article">
        <header>
            <h2><?php echo $model->title;?></h2>
            <hr>
            <?php echo Html::decode($model->preview); ?>
            <br>
            <?php echo Html::decode($model->content); ?>
        </header>
        <footer>
            <div class="row">
                <div class="row__time">
                    <div class="article__time">
                        <em>
                            <time datetime="<?php echo Yii::$app->formatter->asDate($model->created_at, 'php:yy-m-d'); ?>"><?php echo Yii::$app->formatter->asDate($model->created_at, 'long'); ?></time>
                        </em>
                    </div>
                </div>
            </div>
            <div class="alert">
                <?php
                if (!empty($model->tagArticles)){
                    echo Html::tag('span', Yii::t('app', 'Tags').': ');
                }
                $tags = \yii\helpers\ArrayHelper::map($model->tagArticles, 'id', 'name');
                foreach ($tags as $id=>$tag){ ?>
                    <?php echo Html::a($tag,['/blog/tag', 'name' => $tag],['class'=>'button button--sm']);?>
                <?php }?>
            </div>
        </footer>
    </article>
</section>