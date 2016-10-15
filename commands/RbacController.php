<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $read = $auth->createPermission('read');
        $read->description = 'Read Data';
        $auth->add($read);

        $write = $auth->createPermission('write');
        $write->description = 'Write Data';
        $auth->add($write);

        $viewer = $auth->createRole('viewer');
        $auth->add($viewer);
        $auth->addChild($viewer, $read);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $write);
        $auth->addChild($admin, $viewer);

        $auth->assign($admin, 1);
        $auth->assign($viewer, 2);
    }
}