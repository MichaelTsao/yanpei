<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

//        $read = $auth->createPermission('read');
//        $read->description = 'Read Data';
//        $auth->add($read);
//
//        $write = $auth->createPermission('write');
//        $write->description = 'Write Data';
//        $auth->add($write);

//        $write = $auth->createPermission('manageArticle');
//        $write->description = "Manage Articles";
//        $auth->add($write);
//
//        $viewer = $auth->createRole('article-editor');
//        $auth->add($viewer);
//        $auth->addChild($viewer, $write);
//
//        $write = $auth->createPermission('manageProduct');
//        $write->description = "Manage Products";
//        $auth->add($write);
//
//        $viewer = $auth->createRole('product-editor');
//        $auth->add($viewer);
//        $auth->addChild($viewer, $write);

//        $write = $auth->createPermission('manageStore');
//        $write->description = "Manage Product's Store";
//        $auth->add($write);

        $write = $auth->getPermission('manageStore');

        $viewer = $auth->createRole('store-editor');
        $auth->add($viewer);
        $auth->addChild($viewer, $write);

//        $write = $auth->createPermission('auditDoctor');
//        $write->description = "Audit Doctors";
//        $auth->add($write);
//
//        $viewer = $auth->createRole('doctor-auditor');
//        $auth->add($viewer);
//        $auth->addChild($viewer, $write);

//        $admin = $auth->createRole('admin');
//        $auth->add($admin);
//        $auth->addChild($admin, $write);
//        $auth->addChild($admin, $viewer);

//        $auth->assign($admin, 1);
//        $auth->assign($admin, 2);
//        $auth->assign($viewer, 2);
    }

    public function actionGet($uid)
    {
        if (!$roles = Yii::$app->authManager->getRolesByUser($uid)){
            echo 0;
        }else{
            echo array_keys($roles)[0];
        }
        echo "\n";
    }
}