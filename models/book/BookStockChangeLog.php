<?php

namespace app\models\book;

use Yii;

/**
 * This is the model class for table "book_stock_change_log".
 *
 * @property string $id
 * @property int $book_id 书籍商品id
 * @property int $unit 变更多少
 * @property int $total_stock 变更之后总量
 * @property string $note 备注字段
 * @property string $created_time 插入时间
 */
class BookStockChangeLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_stock_change_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id'], 'required'],
            [['book_id', 'unit', 'total_stock'], 'integer'],
            [['created_time'], 'safe'],
            [['note'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'unit' => 'Unit',
            'total_stock' => 'Total Stock',
            'note' => 'Note',
            'created_time' => 'Created Time',
        ];
    }
}
