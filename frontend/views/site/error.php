<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<section class="row__left">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert--danger">
        <div class="alert__header"><?= nl2br(Html::encode($message)) ?></div>
    </div>

</section>
