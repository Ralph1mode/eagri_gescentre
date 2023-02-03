<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Brouillon;

/**
 * BrouillonSearch represents the model behind the search form of `backend\models\Brouillon`.
 */
class BrouillonSearch extends Brouillon
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idSpectForm', 'idMatiere', 'nb_heure', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['key_brouillon', 'created_at', 'updated_at'], 'safe'],
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
        $query = Brouillon::find();

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
            'idSpectForm' => $this->idSpectForm,
            'idMatiere' => $this->idMatiere,
            'nb_heure' => $this->nb_heure,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'statut' => $this->statut,
        ]);

        $query->andFilterWhere(['like', 'key_brouillon', $this->key_brouillon]);

        return $dataProvider;
    }
}
