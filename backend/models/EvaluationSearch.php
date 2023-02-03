<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Evaluation;
use Yii;

/**
 * EvaluationSearch represents the model behind the search form of `backend\models\Evaluation`.
 */
class EvaluationSearch extends Evaluation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idTypeevaluation', 'idFormation', 'nb_note', 'idUser', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['ladate', 'h_debut', 'h_fin', 'key_eval', 'created_at', 'updated_at'], 'safe'],
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
        $additional == 0;
        $user = Yii::$app->user->identity->id;
        if ($additional == 1) {
            $query = Evaluation::find()->where(['statut' => 1,]);
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
            'idTypeevaluation' => $this->idTypeevaluation,
            'idFormation' => $this->idFormation,
            'nb_note' => $this->nb_note,
            'ladate' => $this->ladate,
            'h_debut' => $this->h_debut,
            'h_fin' => $this->h_fin,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'statut' => $this->statut,
        ]);

        $query->andFilterWhere(['like', 'key_eval', $this->key_eval]);

        return $dataProvider;
    }
}
