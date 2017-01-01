<?php
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'About');
$this->registerMetaTag(['name' => 'description','content' => Yii::$app->name. ' – Профессиональное самосовершенствование,технические статьи и заметки.']);
?>

<section class="row__left">
    <h2><?php echo Yii::t('app', 'About');?></h2>
    <p>Меня зовут Алексей, в блоге буду делится своим мнением и опытом про технологии, веб разработку, операционные системы</p>
    <p>Так же блог - это место для хранения информации для себя</p>
    <p>Если у вас есть вопрос, предложение, мнение то пишите на почту <a href="mailto:alex@sporthock.ru">alex@sporthock.ru</a></p>
</section>

