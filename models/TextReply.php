<?php

namespace app\models;

use yii\db\ActiveRecord;

class TextReply extends ActiveRecord
{
/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wd_text_reply';
    }

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