<?php

namespace app\models\member;

use Yii;

/**
 * This is the model class for table "member_cart".
 *
 * @property string $id
 * @property string $member_id 会员id
 * @property int $book_id 图书id
 * @property int $quantity 数量
 * @property string $updated_time 最后一次更新时间
 * @property string $created_time 插入时间
 */
class MemberCart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id', 'book_id', 'quantity'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
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
            'book_id' => 'Book ID',
            'quantity' => 'Quantity',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
