<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Inscription;

/**
 * InscriptionSearch represents the model behind the search form of `backend\models\Inscription`.
 */
class InscriptionSearch extends Inscription
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idFormation', 'idApprenant', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['code_carte', 'key_inscription', 'created_at', 'updated_at'], 'safe'],
            [['moyenne'], 'number'],
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
        $query = Inscription::find();

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
            'idFormation' => $this->idFormation,
            'idApprenant' => $this->idApprenant,
            'moyenne' => $this->moyenne,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'statut' => $this->statut,
        ]);

        $query->andFilterWhere(['like', 'code_carte', $this->code_carte])
            ->andFilterWhere(['like', 'key_inscription', $this->key_inscription]);

        return $dataProvider;
    }
}
