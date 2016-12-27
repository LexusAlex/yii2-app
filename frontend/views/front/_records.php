<?php
/**
 * @var $this \yii\web\View
 * @var $model backend\models\Record
 */
use yii\helpers\Html;
?>
<article class="article" role="article">
    <header>
        <h2><?php echo Html::a($model->title,['/blog/view', 'slug' => $model->slug]);?></h2>
        <div class="row">
            <div class="row__time">
                <div class="article__time">
                    <em>
                        <time datetime="<?php echo Yii::$app->formatter->asDate($model->created_at, 'php:yy-m-d'); ?>"><?php echo Yii::$app->formatter->asDate($model->created_at, 'long'); ?></time>
                    </em>
                </div>
            </div>
            <div class="row__time">
                <div class="article__category">
                    <em>
                        <?php echo Html::a($model->category->title,['/blog/category', 'id' => $model->category->id]);?>
                    </em>
                </div>
            </div>
        </div>
        <hr>
        <?php echo Html::decode($model->preview); ?>
    </header>
    <footer>
        <?php echo Html::a(Yii::t('app', 'Read more'),['/blog/view', 'slug' => $model->slug],['class' =>'button button--main button--sm button--block']);?>
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