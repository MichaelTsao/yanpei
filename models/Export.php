<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 2016/9/26
 * Time: 上午9:29
 */

namespace app\models;


use yii\db\ActiveQuery;

class Export
{
    public static function make(ActiveQuery $query, array $attributes, $subs = [])
    {
        $records = $query->all();
        $data = [];
        $subData = [];
        $titles = [];
        $item = null;
        foreach ($records as $item) {
            $row = [];
            foreach ($attributes as $attribute) {
                $row[] = $item->$attribute;
            }
            $data[] = $row;

            if ($subs) {
                $t = [];
                $key = '';
                foreach ($subs as $sub) {
                    if (isset($item->$sub)) {
                        $t[] = $item->$sub;
                    }
                    $key = implode('-', $t);
                }
                if ($key) {
                    if (!isset($subData[$key])) {
                        $subData[$key] = [];
                    }
                    $subData[$key][] = $row;
                }
            }
        }
        if ($item) {
            foreach ($attributes as $attribute) {
                if (!$title = $item->getAttributeLabel($attribute)) {
                    $title = $attribute;

                }
                $titles[] = $title;
            }
        }
        static::makeRaw($data, $titles, $subData);
    }

    public static function makeRaw($data, $titles, $subData = [])
    {
        if ($data && $titles) {
            $sheets = [
                '全部' => [
                    'data' => $data,
                    'titles' => $titles,
                ]
            ];
            if ($subData) {
                foreach ($subData as $item => $value) {
                    $sheets[$item] = [
                        'data' => $value,
                        'titles' => $titles,
                    ];
                }
            }
            $file = \Yii::createObject([
                'class' => 'codemix\excelexport\ExcelFile',
                'sheets' => $sheets,
            ]);
            $file->saveAs(\Yii::getAlias('@webroot/res/data.xlsx'));
        }
    }
}