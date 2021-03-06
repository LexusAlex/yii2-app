<?php

namespace frontend\widgets;

use backend\models\Record;
use yii\base\Widget;
use yii\helpers\Html;

class LastRecordsWidget extends Widget {

    public $countRecords = 5;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }


    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub
        $records = Record::find()
            ->select(['title','slug'])
            ->where(['status'=>10])
            ->orderBy('position DESC, created_at DESC')
            ->limit($this->countRecords)->all();
        foreach ($records as $record) {
            echo Html::tag('p', Html::a($record->title,['/blog/view', 'slug' => $record->slug], ['class'=>'alert__link']));
        }
    }
}