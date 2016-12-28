<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $page string*/
$p = !is_null($page) ? ' - Страница '.$page : '';
$this->title = Yii::$app->name .' - Разработка сервисов, программирование, самосовершенствование'. $p;
$this->registerMetaTag(['name' => 'description','content' => Yii::$app->name. ' – Профессиональное самосовершенствование,технические статьи и заметки.'. $p]);
?>
<section class="row__left">
    <?php
    echo \frontend\widgets\AllRecordsWidget::widget();
    ?>
</section>
