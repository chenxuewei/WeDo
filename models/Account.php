<?php

namespace app\models;

use yii\db\ActiveRecord;

class Account extends ActiveRecord
{

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wd_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mid', 'uid'], 'integer'],
            [['aname', 'account', 'appid', 'appsecret'], 'required'],
            [['aname', 'account', 'atok', 'aurl'], 'string', 'max' => 255],
            [['appid', 'appsecret', 'atoken'], 'string', 'max' => 50],
            [['aname'],'unique'],
            [['appid'], 'unique'],
            [['appsecret'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => 'Aid',
            'mid' => 'Mid',
            'uid' => 'Uid',
            'aname' => '公众号名称',
            'account' => '内容',
            'appid' => 'Appid',
            'appsecret' => 'secret',
            'atoken' => 'Atoken',
            'atok' => 'Atok',
            'aurl' => 'Aurl',
        ];
    }
}