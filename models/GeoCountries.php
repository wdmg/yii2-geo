<?php

namespace wdmg\geo\models;

use Yii;

/**
 * This is the model class for table "geo_countries".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_published
 *
 * @property GeoCities[] $geoCities
 * @property GeoRegions[] $geoRegions
 */
class GeoCountries extends \yii\db\ActiveRecord
{
/*
    public $id; // Primary key ID
    public $title; // Region title (string)
    public $slug; // Region slug (string)
    public $created_at; // Created date (timestamp)
    public $updated_at; // Updated date (timestamp)
    public $is_published; // Is published flag (0/1)
*/
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['is_published'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 64],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/modules/geo', 'ID'),
            'title' => Yii::t('app/modules/geo', 'Title'),
            'slug' => Yii::t('app/modules/geo', 'Slug'),
            'created_at' => Yii::t('app/modules/geo', 'Created At'),
            'updated_at' => Yii::t('app/modules/geo', 'Updated At'),
            'is_published' => Yii::t('app/modules/geo', 'Is Published'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCities()
    {
        return $this->hasMany(GeoCities::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoRegions()
    {
        return $this->hasMany(GeoRegions::className(), ['country_id' => 'id']);
    }
}
