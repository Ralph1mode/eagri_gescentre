<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Profilfonctionnalite;

/**
 * ProfilfonctionnaliteSearch represents the model behind the search form of `backend\models\Profilfonctionnalite`.
 */
class ProfilfonctionnaliteSearch extends Profilfonctionnalite
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idProfil', 'idFonctionnalite', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['key_profilfonctionnalite', 'created_at', 'updated_at'], 'safe'],
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
        $query = Profilfonctionnalite::find();

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
            'idProfil' => $this->idProfil,
            'idFonctionnalite' => $this->idFonctionnalite,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'statut' => $this->statut,
        ]);

        $query->andFilterWhere(['like', 'key_profilfonctionnalite', $this->key_profilfonctionnalite]);

        return $dataProvider;
    }
}
