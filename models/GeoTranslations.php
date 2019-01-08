<?php

namespace wdmg\geo\models;

use Yii;

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
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_translations';
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
}
