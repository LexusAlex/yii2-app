<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Sporthock',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Records'), 'url' => ['/record/index'], 'visible' => !Yii::$app->user->isGuest],
        ['label' => Yii::t('app', 'Categories'), 'url' => ['/category/index'], 'visible' => !Yii::$app->user->isGuest],
        ['label' => Yii::t('app', 'Tags'), 'url' => ['/tag/index'], 'visible' => !Yii::$app->user->isGuest],
        ['label' => Yii::t('app', 'Uploaded Images'), 'url' => ['/site/upload-image'], 'visible' => !Yii::$app->user->isGuest],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(Yii::t('app', 'Logout'),
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="container">
            <?= \lavrentiev\widgets\toastr\NotificationFlash::widget([
                'options' => [
                    "closeButton" => false,
                    "debug" => false,
                    "newestOnTop" => false,
                    "progressBar" => false,
                    "positionClass" => "toast-top-right",
                    "preventDuplicates" => false,
                    "onclick" => null,
                    "showDuration" => "300",
                    "hideDuration" => "1000",
                    "timeOut" => "5000",
                    "extendedTimeOut" => "1000",
                    "showEasing" => "swing",
                    "hideEasing" => "linear",
                    "showMethod" => "fadeIn",
                    "hideMethod" => "fadeOut"
                ]
            ]) ?>
        </div>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><?php echo Yii::t('app', 'Time of servers')?> : <?php echo date('d F Y G:i:s'); ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
