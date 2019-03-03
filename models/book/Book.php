<?php

namespace app\models\book;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property string $id
 * @property int $cat_id 分类id
 * @property string $name 书籍名称
 * @property string $price 售卖金额
 * @property string $main_image 主图
 * @property string $summary 描述
 * @property int $stock 库存量
 * @property string $tags tag关键字，以","连接
 * @property int $status 状态 1：有效 0：无效
 * @property int $month_count 月销售数量
 * @property int $total_count 总销售量
 * @property int $view_count 总浏览次数
 * @property int $comment_count 总评论量
 * @property string $updated_time 最后更新时间
 * @property string $created_time 最后插入时间
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'stock', 'status', 'month_count', 'total_count', 'view_count', 'comment_count'], 'integer'],
            [['price'], 'number'],
            [['updated_time', 'created_time'], 'safe'],
            [['name', 'main_image'], 'string', 'max' => 100],
            [['summary'], 'string', 'max' => 2000],
            [['tags'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Cat ID',
            'name' => 'Name',
            'price' => 'Price',
            'main_image' => 'Main Image',
            'summary' => 'Summary',
            'stock' => 'Stock',
            'tags' => 'Tags',
            'status' => 'Status',
            'month_count' => 'Month Count',
            'total_count' => 'Total Count',
            'view_count' => 'View Count',
            'comment_count' => 'Comment Count',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
