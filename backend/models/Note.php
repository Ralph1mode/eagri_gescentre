<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "note".
 *
 * @property int $id
 * @property int $idEvaluation
 * @property int $idInscription
 * @property int $libelle
 * @property string $key_note
 * @property int $idUser
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Evaluation $idEvaluation0
 * @property Inscription $idInscription0
 * @property User $updatedBy
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEvaluation', 'idInscription', 'libelle', 'key_note', 'created_by', 'created_at'], 'required'],
            [['idEvaluation', 'idInscription', 'libelle', 'idUser', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['key_note'], 'string', 'max' => 32],
            [['idEvaluation'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluation::className(), 'targetAttribute' => ['idEvaluation' => 'id']],
            [['idInscription'], 'exist', 'skipOnError' => true, 'targetClass' => Inscription::className(), 'targetAttribute' => ['idInscription' => 'id']],
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
            'idEvaluation' => 'Id Evaluation',
            'idInscription' => 'Id Inscription',
            'libelle' => 'Libelle',
            'key_note' => 'Key Note',
            'idUser' => 'Id User',
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
     * Gets query for [[IdEvaluation0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvaluation0()
    {
        return $this->hasOne(Evaluation::className(), ['id' => 'idEvaluation']);
    }

    /**
     * Gets query for [[IdInscription0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdInscription0()
    {
        return $this->hasOne(Inscription::className(), ['id' => 'idInscription']);
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
