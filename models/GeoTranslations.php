<?php

namespace wdmg\geo\models;

use Yii;
use \yii\behaviors\TimeStampBehavior;

/**
 * This is the model class for table "geo_translations".
 *
 * @property int $id
 * @property string $language
 * @property int $source_id
 * @property int $source_type
 * @property string $translation
 * @property string $created_at
 * @property string $updated_at
 */
class GeoTranslations extends \yii\db\ActiveRecord
{
    /**
     * @const int the code of translation type (countries, regions or cities)
     */
    const TR_COUNTRY = 10;
    const TR_REGION = 20;
    const TR_CITY = 30;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'created_at',
                    self::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function() {
                    return date("Y-m-d H:i:s");
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['source_id', 'source_type'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['language'], 'string', 'max' => 16],
            [['translation'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/modules/geo', 'ID'),
            'language' => Yii::t('app/modules/geo', 'Language'),
            'source_id' => Yii::t('app/modules/geo', 'Source ID'),
            'source_type' => Yii::t('app/modules/geo', 'Source Type'),
            'translation' => Yii::t('app/modules/geo', 'Translation'),
            'created_at' => Yii::t('app/modules/geo', 'Created At'),
            'updated_at' => Yii::t('app/modules/geo', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        if($this->source_type == 10)
            return $this->hasOne(GeoCountries::className(), ['id' => 'source_id']);
        elseif ($this->source_type == 20)
            return $this->hasOne(GeoRegions::className(), ['id' => 'source_id']);
        elseif ($this->source_type == 30)
            return $this->hasOne(GeoCities::className(), ['id' => 'source_id']);
        else
            return '';
    }
}
