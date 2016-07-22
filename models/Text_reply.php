<?php

namespace app\models;

use yii\db\ActiveRecord;

class Text_reply extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trcontent'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trcontent' => 'Trcontent',
        ];
    }
}