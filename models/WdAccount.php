<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wd_account".
 *
 * @property integer $aid
 * @property integer $mid
 * @property integer $uid
 * @property string $aname
 * @property string $account
 * @property string $appid
 * @property string $appsecret
 * @property string $atoken
 * @property string $atok
 * @property string $aurl
 */
class WdAccount extends \yii\db\ActiveRecord
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
            'aname' => 'Aname',
            'account' => 'Account',
            'appid' => 'Appid',
            'appsecret' => 'Appsecret',
            'atoken' => 'Atoken',
            'atok' => 'Atok',
            'aurl' => 'Aurl',
        ];
    }
}
