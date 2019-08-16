<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%available_fertilizer}}".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $n_content
 * @property int $p_content
 * @property int $k_content
 * @property int $weight
 * @property string $price
 * @property string $country
 * @property bool $available
 * @property bool $custom
 * @property string $created_at
 * @property string $updated_at
 */
class AvailableFertilizer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%available_fertilizer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'n_content', 'p_content', 'k_content'], 'required'],
            [['n_content', 'p_content', 'k_content', 'weight'], 'integer'],
            [['available', 'custom'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'type'], 'string', 'max' => 50],
            [['price', 'country'], 'string', 'max' => 5],
            [['name'], 'unique'],
            [['type'], 'unique'],
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
            'type' => 'Type',
            'n_content' => 'N Content',
            'p_content' => 'P Content',
            'k_content' => 'K Content',
            'weight' => 'Weight',
            'price' => 'Price',
            'country' => 'Country',
            'available' => 'Available',
            'custom' => 'Custom',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
