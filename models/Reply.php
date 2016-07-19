<?php

namespace app\models;

use yii\db\ActiveRecord;

class Reply extends ActiveRecord
{

/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wd_reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'rename', 'rekeyword'], 'required'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => 'Aid',
            'rename' => 'Rename',
            'rekeyword' => 'Rekeyword',
            
        ];
    

}

}