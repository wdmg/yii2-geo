<?php

namespace wdmg\geo\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use wdmg\geo\models\GeoCities;
use wdmg\geo\models\GeoCountries;
use wdmg\geo\models\GeoRegions;

/**
 * GeoCitiesSearch represents the model behind the search form of `app\models\GeoCities`.
 */
class GeoCitiesSearch extends GeoCities
{
    /**
     * @var string the title of geo_countries table
     */
    public $country;

    /**
     * @var string the title of geo_regions table
     */
    public $region;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'region_id'], 'string'],
            [['id', 'is_capital', 'is_published'], 'integer'],
            [['title', 'country', 'region', 'slug', 'created_at', 'updated_at'], 'safe'],
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
        $query = GeoCities::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_capital' => $this->is_capital,
            'is_published' => $this->is_published,
        ]);

        // custom search: get country_id requested by title
        if(!is_int($this->country_id) && !empty($this->country_id)) {
            $country_id = GeoCountries::find()->andFilterWhere(['like', 'title', $this->country_id])->one();
            $query->andFilterWhere(['country_id' => $country_id]);
        } else {
            $query->andFilterWhere(['country_id' => $this->country_id]);
        }

        // custom search: get region_id requested by title
        if(!is_int($this->region_id) && !empty($this->region_id)) {
            $region_id = GeoRegions::find()->andFilterWhere(['like', 'title', $this->region_id])->one();
            $query->andFilterWhere(['region_id' => $region_id]);
        } else {
            $query->andFilterWhere(['region_id' => $this->region_id]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
