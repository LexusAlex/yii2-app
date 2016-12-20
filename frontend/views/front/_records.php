<?php
/**
 * @var $this \yii\web\View
 * @var $model backend\models\Record
 */
?>
<article class="article" role="article">
        <header>
            <h2><a href="<?php echo \yii\helpers\Url::to(['view', 'slug' => $model->slug]); ?>"><?php echo $model->title; ?></a></h2>
            <div class="row">
                <div class="row__time">
                    <div class="article__time">
                        <em>
                            <time datetime="2014-01-17"><?php echo Yii::$app->formatter->asDate($model->created_at, 'long'); ?></time>
                        </em>
                    </div>
                </div>
                <div class="row__time">
                    <div class="article__category">
                        <em>
                            <a href=""><?php echo $model->category->title; ?></a>
                        </em>
                    </div>
                </div>
            </div>
            <hr>
            <?php echo $model->preview; ?>
        </header>
        <footer>
            <a class="button button--main button--sm button--block" href="">Читать далее</a>
            <div class="alert">
                <span>Теги:</span>
                <?php
                $tags = \yii\helpers\ArrayHelper::map($model->tagArticles, 'id', 'name');
                    foreach ($tags as $tag){ ?>
                        <a class="button button--sm" href=""><?php echo $tag;?></a>
                   <?php }?>
            </div>
        </footer>
    </article>
<?php