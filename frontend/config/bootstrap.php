<?php
\Yii::$container->set('yii\widgets\LinkPager', [
            'registerLinkTags'=> true,
            'options' => ['class' => 'pagination'], //ul
            'pageCssClass'=>'pagination__item', // li
            'firstPageCssClass' => 'pagination__item pagination__item_first', //first
            'prevPageCssClass' =>  'pagination__item pagination__item_prev', // prev
            'nextPageCssClass' =>  'pagination__item pagination__item_next', // next
            'lastPageCssClass' =>  'pagination__item pagination__item_last', // last
            'activePageCssClass' => 'pagination__item_current', // active
            'disabledPageCssClass' => 'pagination__item_disabled', // disabled
            'linkOptions' => ['class'=> 'pagination__link'], //a
            'firstPageLabel' => 'Первая',
            'lastPageLabel' => 'Последняя',
            'nextPageLabel' => 'Следующая',
            'prevPageLabel' => 'Предыдущая',
            'maxButtonCount' => 5,
]);