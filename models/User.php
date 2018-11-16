<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $uid 管理员id
 * @property string $nickname 用户名
 * @property string $mobile 手机号码
 * @property string $email 邮箱
 * @property int $sex 性别 1 男 2 女
 * @property string $avatar 头像key
 * @property string $login_name 登录用户名
 * @property string $login_pwd 密码
 * @property string $login_salt 加密随机密钥
 * @property int $status 1 有效 0 无效
 * @property string $updated_time 最后一次更新时间
 * @property string $create_time 创建时间
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid', 'sex', 'status'], 'integer'],
            [['updated_time', 'create_time'], 'safe'],
            [['nickname', 'email'], 'string', 'max' => 100],
            [['mobile', 'login_name'], 'string', 'max' => 20],
            [['avatar'], 'string', 'max' => 64],
            [['login_pwd', 'login_salt'], 'string', 'max' => 32],
            [['login_name'], 'unique'],
            [['uid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'nickname' => 'Nickname',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'sex' => 'Sex',
            'avatar' => 'Avatar',
            'login_name' => 'Login Name',
            'login_pwd' => 'Login Pwd',
            'login_salt' => 'Login Salt',
            'status' => 'Status',
            'updated_time' => 'Updated Time',
            'create_time' => 'Create Time',
        ];
    }
}
