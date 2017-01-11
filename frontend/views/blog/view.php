<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Record */

use yii\helpers\Html;

$this->title = $model->title;
$this->registerMetaTag(['name' => 'description','content' => $model->description]);
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
            <?php if(YII_ENV === 'prod'){ ?>
                <div id="hypercomments_widget"></div>
                <script type="text/javascript">
                    _hcwp = window._hcwp || [];
                    _hcwp.push({widget:"Stream", widget_id: 85071});
                    (function() {
                        if("HC_LOAD_INIT" in window)return;
                        HC_LOAD_INIT = true;
                        var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
                        var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true;
                        hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://w.hypercomments.com/widget/hc/85071/"+lang+"/widget.js";
                        var s = document.getElementsByTagName("script")[0];
                        s.parentNode.insertBefore(hcc, s.nextSibling);
                    })();
                </script>
            <?php } ?>
        </footer>
    </article>
</section>