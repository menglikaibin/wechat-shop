<?php

namespace app\models\member;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property string $id
 * @property string $nickname 会员名
 * @property string $mobile 会员手机号码
 * @property int $sex 性别 1：男 2：女
 * @property string $avatar 会员头像
 * @property string $salt 随机salt
 * @property string $reg_ip 注册ip
 * @property int $status 状态 1：有效 0：无效
 * @property string $updated_time 最后一次更新时间
 * @property string $created_time 插入时间
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sex', 'status'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
            [['nickname', 'reg_ip'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 11],
            [['avatar'], 'string', 'max' => 200],
            [['salt'], 'string', 'max' => 32],
            [['mobile'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'Nickname',
            'mobile' => 'Mobile',
            'sex' => 'Sex',
            'avatar' => 'Avatar',
            'salt' => 'Salt',
            'reg_ip' => 'Reg Ip',
            'status' => 'Status',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
