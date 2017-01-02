<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
?>
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
        'emptyText' => '<div class="alert">
                        <div class="alert__header">Список пуст</div>
                       </div>',
    ]);
?>