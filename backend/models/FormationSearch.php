<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Formation;

/**
 * FormationSearch represents the model behind the search form of `backend\models\Formation`.
 */
class FormationSearch extends Formation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idSpectForm', 'cloture', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['libelle', 'descriptions', 'date_debut', 'date_fin', 'key_formation', 'created_at', 'updated_at'], 'safe'],
            [['frais'], 'number'],
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
    public function search($params, $additional = 0)
    {
        if ($additional == 1) {
            $query = Formation::find()->where(['statut' => 1]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
           
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
            'idSpectForm' => $this->idSpectForm,
            'frais' => $this->frais,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
            'cloture' => $this->cloture,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'statut' => $this->statut,
        ]);

        $query->andFilterWhere(['like', 'libelle', trim($this->libelle)])
            ->andFilterWhere(['like', 'descriptions', $this->descriptions])
            ->andFilterWhere(['like', 'key_formation', $this->key_formation]);

        return $dataProvider;
    }
}
