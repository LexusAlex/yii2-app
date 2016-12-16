<?php
namespace backend\tests\phpunit\models;

use backend\models\Record;
use Yii;

class RecordTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Валидируем заведомо ложные данные
     * @dataProvider data
     */
    public function testNotValidate($category,$title,$preview,$content)
    {
        $model = new Record();
        $model->category_id = $category; // проверяем на существование данной категории в таблице Category
        $model->title = $title;
        $model->preview = $preview;
        $model->content = $content;
        $this->assertFalse($model->validate(),'validate!');
    }

    public function data() {
        return [
            [[], 'Заголово', 'Превью', 'Контент'],
            ['string', 'Заголово', 'Превью', 'Контент'],
            [1, 1, 'Превью', 'Контент'],
            [1, 'title', 'Превью', []],
            [1155, 'title', 'Превью', 'Preview'], // так как нет такой категории
        ];
    }
}