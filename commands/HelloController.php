<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Sms;
use yii\console\Controller;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        Yii::$app->mailer->compose()
            ->setFrom('customer-service@eting33.com')
            ->setTo('caoxiang@yeah.net')
            ->setSubject('test')
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
        echo $message . "\n";
    }

    public function actionTest()
    {
        var_dump(Sms::send('13501123150', Sms::SEND_CODE));
    }

    public function actionVerify($code)
    {
        var_dump(Sms::verify('13501123150', $code));
    }
}
