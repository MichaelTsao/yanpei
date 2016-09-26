<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 2016/9/26
 * Time: 上午9:29
 */

namespace app\models;


class Export
{
    public static function make($query)
    {
        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'Data' => [
                    'class' => 'codemix\excelexport\ActiveExcelSheet',
                    'query' => $query,
                ]
            ]
        ]);
        $file->saveAs(\Yii::getAlias('@webroot/res/data.xlsx'));
    }
}