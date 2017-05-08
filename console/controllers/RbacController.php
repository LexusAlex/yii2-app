<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    // ./yii rbac/init 34
    public function actionInit($id = null)
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $createRecord = $auth->createPermission('createRecord');
        $auth->add($createRecord);

        $updateRecord = $auth->createPermission('updateRecord');
        $auth->add($updateRecord);

        $deleteRecord = $auth->createPermission('deleteRecord');
        $auth->add($deleteRecord);

        $readRecord = $auth->createPermission('readRecord');
        $auth->add($readRecord);

        $user = $auth->createRole('user');
        $auth->add($user);

        $writer = $auth->createRole('writer');
        $auth->add($writer);

        $WriterManager = $auth->createRole('WriterManager');
        $auth->add($WriterManager);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $auth->addChild($user, $readRecord);

        $auth->addChild($writer, $createRecord);
        $auth->addChild($writer, $updateRecord);
        $auth->addChild($writer, $user);

        $auth->addChild($WriterManager, $deleteRecord);
        $auth->addChild($WriterManager, $writer);

        $auth->addChild($admin, $WriterManager);

        $auth->assign($admin, 2);

        //$this->stdout("Hello?\n", Console::BOLD);
    }
}