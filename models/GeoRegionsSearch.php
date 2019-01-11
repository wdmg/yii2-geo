<?php

namespace wdmg\geo\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use wdmg\geo\models\GeoRegions;
use wdmg\geo\models\GeoCountries;

/**
 * GeoRegionsSearch represents the model behind the search form of `app\models\GeoRegions`.
 */
class GeoRegionsSearch extends GeoRegions
{
    /**
     * @var object, model `GeoCountries`
     */
    public $country;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id'], 'string'],
            [['id', 'is_published'], 'integer'],
            [['title', 'country', 'slug', 'created_at', 'updated_at'], 'safe'],
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
        $query = GeoRegions::find();

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
            'is_published' => $this->is_published,
        ]);

        // custom search: get country_id requested by title
        if(!is_int($this->country_id) && !empty($this->country_id)) {
            $country_id = GeoCountries::find()->andFilterWhere(['like', 'title', $this->country_id])->one();
            $query->andFilterWhere(['country_id' => $country_id]);
        } else {
            $query->andFilterWhere(['country_id' => $this->country_id]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
