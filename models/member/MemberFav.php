<?php

namespace app\models\member;

use Yii;

/**
 * This is the model class for table "member_fav".
 *
 * @property string $id
 * @property int $member_id 会员id
 * @property int $book_id 书籍id
 * @property string $created_time 插入时间
 */
class MemberFav extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_fav';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id', 'book_id'], 'integer'],
            [['created_time'], 'safe'],
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
            'created_time' => 'Created Time',
        ];
    }
}
