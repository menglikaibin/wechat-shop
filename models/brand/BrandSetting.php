<?php

namespace app\models\brand;

use Yii;

/**
 * This is the model class for table "brand_setting".
 *
 * @property string $id
 * @property string $name 品牌名称
 * @property string $description 品牌描述
 * @property string $address 公司地址
 * @property string $mobile 联系电话
 * @property string $logo logo图片
 * @property string $updated_time 最后一次更新时间
 * @property string $created_time 插入时间
 */
class BrandSetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_time', 'created_time'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 2000],
            [['address', 'logo'], 'string', 'max' => 200],
            [['mobile'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'address' => 'Address',
            'mobile' => 'Mobile',
            'logo' => 'Logo',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
