<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Apprenant;

/**
 * ApprenantSearch represents the model behind the search form of `backend\models\Apprenant`.
 */
class ApprenantSearch extends Apprenant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idPays', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['nom', 'prenom', 'sexe', 'datenaisse', 'email', 'tel', 'niveau', 'profession', 'chem_photo', 'chem_piece', 'chem_diplome', 'key_apprenant', 'created_at', 'updated_at'], 'safe'],
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
            $query = Apprenant::find()->where(['statut' => 1])->orderBy('id');
        }

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
            'idPays' => $this->idPays,
            'datenaisse' => $this->datenaisse,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'statut' => $this->statut,
        ]);

        $query->andFilterWhere(['like', 'nom', trim($this->nom)])
            ->andFilterWhere(['like', 'prenom', $this->prenom])
            ->andFilterWhere(['like', 'sexe', $this->sexe])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'niveau', $this->niveau])
            ->andFilterWhere(['like', 'profession', $this->profession])
            ->andFilterWhere(['like', 'chem_photo', $this->chem_photo])
            ->andFilterWhere(['like', 'chem_piece', $this->chem_piece])
            ->andFilterWhere(['like', 'chem_diplome', $this->chem_diplome])
            ->andFilterWhere(['like', 'key_apprenant', $this->key_apprenant]);

        return $dataProvider;
    }
}
