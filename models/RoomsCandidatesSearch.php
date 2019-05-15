<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RoomsCandidates;

/**
 * RoomsCandidatesSearch represents the model behind the search form of `app\models\RoomsCandidates`.
 */
class RoomsCandidatesSearch extends RoomsCandidates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'room_id', 'candidate_id'], 'integer'],
            [['points'], 'number'],
            [['conclusion'], 'safe'],
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
        $query = RoomsCandidates::find();

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
            'room_id' => $this->room_id,
            'candidate_id' => $this->candidate_id,
            'points' => $this->points,
        ]);

        $query->andFilterWhere(['like', 'conclusion', $this->conclusion]);

        return $dataProvider;
    }
}
