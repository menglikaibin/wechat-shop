<?php

namespace app\models\member;

use Yii;

/**
 * This is the model class for table "oauth_member_bind".
 *
 * @property string $id
 * @property int $member_id 会员id
 * @property string $client_type 客户端来源类型。qq,weibo,weixin
 * @property int $type 类型 type 1:wechat 
 * @property string $openid 第三方id
 * @property string $unionid
 * @property string $extra 额外字段
 * @property string $updated_time 最后更新时间
 * @property string $created_time 插入时间
 */
class OauthMemberBind extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oauth_member_bind';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id', 'type'], 'integer'],
            [['extra'], 'required'],
            [['extra'], 'string'],
            [['updated_time', 'created_time'], 'safe'],
            [['client_type'], 'string', 'max' => 20],
            [['openid'], 'string', 'max' => 80],
            [['unionid'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'client_type' => 'Client Type',
            'type' => 'Type',
            'openid' => 'Openid',
            'unionid' => 'Unionid',
            'extra' => 'Extra',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
