<?php

namespace wdmg\geo\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use wdmg\geo\models\GeoTranslations;

/**
 * GeoTranslationsSearch represents the model behind the search form of `app\models\GeoTranslations`.
 */
class GeoTranslationsSearch extends GeoTranslations
{
    /**
     * @var string the title of source (geo_countries.title, geo_regions.title or geo_cities.title)
     */
    public $source;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'source_id', 'source_type'], 'integer'],
            [['language', 'source', 'translation', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = GeoTranslations::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'source_id' => $this->source_id,
            'source_type' => $this->source_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'translation', $this->translation]);

        return $dataProvider;
    }
}