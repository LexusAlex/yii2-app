<?php
namespace frontend\tests\phpunit;

use frontend\controllers\FrontController;
use Yii;

class UrlsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Проверка регулярных выражений
     * @dataProvider data
     */
    public function testValidate($rg, $string)
    {
        //var_dump(Yii::$app->request);
        //$controller = new FrontController('front',\Yii::$app);
        //$action = $controller->run('index');
        $this->assertEquals(preg_match($rg, $string),1);
    }

    public function data() {
        return [
            ['/^\d+$/','2'],
            ['/^\d+$/','678'],
            ['/^\d+$/','678'],
            ['/[a-zа-я0-9-]+/','текст'],
            ['/[a-zа-я0-9-]+/','testтест'],
            ['/[a-zа-я0-9-]+/','testтест1234567890'],
            ['/^([a-zа-я0-9-])+/','abcdifghihklmopqrstwuyzабвгдеёжзиклмнопрстуфхчшщэюя1234567890'],
        ];
    }
}