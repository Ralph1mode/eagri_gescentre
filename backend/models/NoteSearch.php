<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Note;

/**
 * NoteSearch represents the model behind the search form of `backend\models\Note`.
 */
class NoteSearch extends Note
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idEvaluation', 'idInscription', 'libelle', 'idUser', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['key_note', 'created_at', 'updated_at'], 'safe'],
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
    public function search($params, $additional)
    {
        $query = Note::find();

        // add conditions that should always apply here

        $additional == 0;
        if ($additional == 1) {
            $query = Note::find()->where(['statut' => 1,]);
        }

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
            'idEvaluation' => $this->idEvaluation,
            'idInscription' => $this->idInscription,
            'libelle' => $this->libelle,
            'idUser' => $this->idUser,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'statut' => $this->statut,
        ]);

        $query->andFilterWhere(['like', 'key_note', $this->key_note]);

        return $dataProvider;
    }
}
