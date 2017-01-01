<?php
namespace backend\models\forms;

use common\helpers\Generator;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class ImageForm
 * @package backend\models\forms
 */
class ImageForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            $path = \Yii::$app->params['path.images'];
            foreach ($this->imageFiles as $file) {
                $fileName = Generator::fileName($file->extension, $path);// генерируем имя
                $file->saveAs($path . DIRECTORY_SEPARATOR . $fileName);
            }
            return true;
        } else {
            return false;
        }
    }
}