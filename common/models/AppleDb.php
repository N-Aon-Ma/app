<?php

namespace common\models;

use yii\db\ActiveRecord;


class AppleDb extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%apple}}';
    }

    public function rules()
    {
        return [
            [
                [
                    'id',
                    'color',
                    'date_create',
                    'date_fall',
                    'status',
                    'size',
                    'created_at',
                    'updated_at'
                ], 'safe'],
        ];
    }


    public function saveItem($item)
    {

    }
}