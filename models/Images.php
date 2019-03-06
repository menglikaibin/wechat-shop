<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property string $id
 * @property string $bucket
 * @property string $file_key 文件名
 * @property string $created_time 插入时间
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_time'], 'safe'],
            [['bucket'], 'string', 'max' => 20],
            [['file_key'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bucket' => 'Bucket',
            'file_key' => 'File Key',
            'created_time' => 'Created Time',
        ];
    }
}
