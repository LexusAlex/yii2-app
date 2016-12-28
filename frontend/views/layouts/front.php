<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
nezhelskoy\highlight\HighlightAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <header class="header" role="banner">
        <h2 class="container header__logo">
            <?php echo Html::a('{ '.Yii::$app->name.' }',['front/index'],['style'=>'text-decoration:none;color:#333333']);?>
        </h2>
        <nav class="main-nav" role="navigation">
            <?php
            echo \yii\widgets\Menu::widget([
                'items' => [
                    ['label' => Yii::t('app', 'About'), 'url' => ['front/about'],],
                ],
                'activeCssClass'=> 'main-nav__item--active',
                'itemOptions' => ['class' => 'main-nav__item',],
                'linkTemplate' => '<a class="main-nav__link" href="{url}">{label}</a>',
                'options' => ['class' => 'main-nav__list'],
            ]);
            ?>
        </nav>
    </header>
    <main class="container" role="main">
        <div class="row">
            <?= $content ?>
            <aside class="row__right">
                <div class="alert">
                    <div class="alert__header"><?php echo Yii::t('app', 'Last records');?></div>
                    <?php echo \frontend\widgets\LastRecordsWidget::widget();?>
                </div>

                <div class="alert">
                    <div class="alert__header"><?php echo Yii::t('app', 'Categories');?></div>
                    <?php echo \frontend\widgets\CategoriesWidget::widget();?>
                </div>
            </aside>
        </div>
    </main>
    <footer class="header" role="contentinfo">
        <h3 class="container header__logo">
            { <?php echo Yii::$app->name;?> } <small><?php echo date('Y');?></small>
        </h3>
    </footer>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
