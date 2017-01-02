<?php
\Yii::$container->set('yii\widgets\LinkPager', [
    'registerLinkTags'=> true,
    //'options' => ['class' => 'pagination'], //ul
    //'pageCssClass'=>'pagination__item', // li
    'firstPageLabel' => 'Первая',
    'lastPageLabel' => 'Последняя',
    'nextPageLabel' => 'Следующая',
    'prevPageLabel' => 'Предыдущая',
    //'maxButtonCount' => 5,
]);
