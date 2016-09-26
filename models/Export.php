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
    public static function make($query, $attributes)
    {
        $records = $query->all();
        $data = [];
        $titles = [];
        foreach ($records as $item) {
            $row = [];
            foreach ($attributes as $attribute) {
                $row[] = $item->$attribute;
            }
            $data[] = $row;
        }
        if ($item) {
            foreach ($attributes as $attribute) {
                if (!$title = $item->getAttributeLabel($attribute)){
                    $title = $attribute;

                }
                $titles[] = $title;
            }
        }
        if ($data && $titles) {
            $file = \Yii::createObject([
                'class' => 'codemix\excelexport\ExcelFile',
                'sheets' => [
                    'Data' => [
                        'data' => $data,
                        'titles' => $titles,
                    ]
                ]
            ]);
            $file->saveAs(\Yii::getAlias('@webroot/res/data.xlsx'));
        }
    }
}