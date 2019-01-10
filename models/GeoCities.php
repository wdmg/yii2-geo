<?php

namespace wdmg\geo\models;

use Yii;

/**
 * This is the model class for table "geo_cities".
 *
 * @property int $id
 * @property int $country_id
 * @property int $region_id
 * @property string $title
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_capital
 * @property int $is_published
 *
 * @property GeoCountries $country
 * @property GeoRegions $region
 */
class GeoCities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'region_id', 'is_capital', 'is_published'], 'integer'],
            [['slug'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 64],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeoCountries::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeoRegions::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/modules/geo', 'ID'),
            'country_id' => Yii::t('app/modules/geo', 'Country ID'),
            'region_id' => Yii::t('app/modules/geo', 'Region ID'),
            'title' => Yii::t('app/modules/geo', 'Title'),
            'slug' => Yii::t('app/modules/geo', 'Slug'),
            'created_at' => Yii::t('app/modules/geo', 'Created At'),
            'updated_at' => Yii::t('app/modules/geo', 'Updated At'),
            'is_capital' => Yii::t('app/modules/geo', 'Is Capital'),
            'is_published' => Yii::t('app/modules/geo', 'Is Published'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(GeoCountries::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(GeoRegions::className(), ['id' => 'region_id']);
    }
}