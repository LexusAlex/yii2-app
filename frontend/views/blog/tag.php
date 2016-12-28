<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $tag string */
/* @var $page string*/
$p = !is_null($page) ? ' - Страница '.$page : '';
$this->title = 'Записи c меткой ' . $tag . $p;
$this->registerMetaTag(['name' => 'description','content' => 'Записи c меткой ' . $tag . $p]);
?>
<section class="row__left">
    <h1>Записи c тегом "<?php echo $tag;?>"</h1>
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '@frontend/views/front/_records',
        //'summary' => '<div>Показано {count} из {totalCount} Страница {page} из {pageCount}</div>',
        'summary' => false,
        'summaryOptions' => [
            'tag' => 'span',
            'class' => 'my-summary'
        ],
        //'emptyText' => 'Список пуст',
    ]);
    ?>
</section>