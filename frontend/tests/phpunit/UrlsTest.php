<?php
namespace frontend\tests\phpunit;

use frontend\controllers\FrontController;
use Yii;

class UrlsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider data
     */
    public function testValidate()
    {
        //var_dump(Yii::$app->request);
        //$controller = new FrontController('front',\Yii::$app);
        //$action = $controller->run('index');
    }

    public function data() {
        return [

        ];
    }
}