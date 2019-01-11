<?php

namespace wdmg\geo\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use wdmg\geo\models\GeoTranslations;
use wdmg\geo\models\GeoCountries;
use wdmg\geo\models\GeoRegions;
use wdmg\geo\models\GeoCities;

/**
 * GeoTranslationsSearch represents the model behind the search form of `app\models\GeoTranslations`.
 */
class GeoTranslationsSearch extends GeoTranslations
{

    /**
     * @var object, model `GeoCountries`, `GeoRegions` or `GeoCities`
     */
    public $source;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['source_id'], 'string'],
            [['id', 'source_type'], 'integer'],
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        // custom search: get source_id requested by title
        if(!is_int($this->source_id) && !empty($this->source_id)) {

            $source_id = GeoCountries::find()->andFilterWhere(['like', 'title', $this->source_id])->one();
            if(intval($source_id["id"]) > 0)
                $query->orWhere(['AND', ['source_id' => intval($source_id["id"]), 'source_type' => self::TR_COUNTRY]]);

            $source_id = GeoRegions::find()->andFilterWhere(['like', 'title', $this->source_id])->one();
            if(intval($source_id["id"]) > 0)
                $query->orWhere(['AND', ['source_id' => intval($source_id["id"]), 'source_type' => self::TR_REGION]]);

            $source_id = GeoCities::find()->andFilterWhere(['like', 'title', $this->source_id])->one();
            if(intval($source_id["id"]) > 0)
                $query->orWhere(['AND', ['source_id' => intval($source_id["id"]), 'source_type' => self::TR_CITY]]);

        } else {
            $query->andFilterWhere([
                'source_type' => $this->source_type,
                'source_id' => $this->source_id
            ]);
        }


        $query->andFilterWhere(['like', 'language', $this->language])->andFilterWhere(['like', 'translation', $this->translation]);

        return $dataProvider;
    }
}
