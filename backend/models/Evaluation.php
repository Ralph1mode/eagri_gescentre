<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "evaluation".
 *
 * @property int $id
 * @property int $idTypeevaluation
 * @property int $idFormation
 * @property int $nb_note
 * @property string $ladate
 * @property string $h_debut
 * @property string $h_fin
 * @property int $idUser
 * @property string $key_eval
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Formation $idFormation0
 * @property TypeEvaluation $idTypeevaluation0
 * @property Note[] $notes
 * @property User $updatedBy
 */
class Evaluation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTypeevaluation', 'idFormation', 'ladate', 'h_debut', 'h_fin', 'key_eval', 'created_by', 'created_at'], 'required'],
            [['idTypeevaluation', 'idFormation', 'nb_note', 'idUser', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['ladate', 'h_debut', 'h_fin', 'created_at', 'updated_at'], 'safe'],
            [['key_eval'], 'string', 'max' => 32],
            [['idFormation'], 'exist', 'skipOnError' => true, 'targetClass' => Formation::className(), 'targetAttribute' => ['idFormation' => 'id']],
            [['idTypeevaluation'], 'exist', 'skipOnError' => true, 'targetClass' => TypeEvaluation::className(), 'targetAttribute' => ['idTypeevaluation' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idTypeevaluation' => 'Id Typeevaluation',
            'idFormation' => 'Id Formation',
            'nb_note' => 'Nombre de Note',
            'ladate' => 'Date de déroulement',
            'h_debut' => 'Heure de début',
            'h_fin' => 'Heure de Fin',
            'idUser' => 'Id User',
            'key_eval' => 'Key Eval',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'statut' => 'Statut',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[IdFormation0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdFormation0()
    {
        return $this->hasOne(Formation::className(), ['id' => 'idFormation']);
    }

    /**
     * Gets query for [[IdTypeevaluation0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypeevaluation0()
    {
        return $this->hasOne(TypeEvaluation::className(), ['id' => 'idTypeevaluation']);
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['idEvaluation' => 'id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
