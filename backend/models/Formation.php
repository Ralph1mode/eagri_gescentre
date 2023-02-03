<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "formation".
 *
 * @property int $id
 * @property int $idSpectForm
 * @property string $libelle
 * @property float $frais
 * @property string|null $descriptions
 * @property string $date_debut
 * @property string $date_fin
 * @property int|null $cloture
 * @property string $key_formation
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Evaluation[] $evaluations
 * @property Spectform $idSpectForm0
 * @property Inscription[] $inscriptions
 * @property Memomatiere[] $memomatieres
 * @property User $updatedBy
 */
class Formation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'formation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSpectForm', 'libelle', 'frais', 'date_debut', 'date_fin', 'key_formation', 'created_by', 'created_at'], 'required'],
            [['idSpectForm', 'cloture', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['frais'], 'number'],
            [['descriptions'], 'string'],
            [['date_debut', 'date_fin', 'created_at', 'updated_at'], 'safe'],
            [['libelle'], 'string', 'max' => 255],
            [['key_formation'], 'string', 'max' => 32],
            [['idSpectForm'], 'exist', 'skipOnError' => true, 'targetClass' => Spectform::className(), 'targetAttribute' => ['idSpectForm' => 'id']],
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
            'idSpectForm' => 'Id Spect Form',
            'libelle' => 'Libelle',
            'frais' => 'Frais',
            'descriptions' => 'Descriptions',
            'date_debut' => 'Date Debut',
            'date_fin' => 'Date Fin',
            'cloture' => 'Cloture',
            'key_formation' => 'Key Formation',
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
     * Gets query for [[Evaluations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations()
    {
        return $this->hasMany(Evaluation::className(), ['idFormation' => 'id']);
    }

    /**
     * Gets query for [[IdSpectForm0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSpectForm0()
    {
        return $this->hasOne(Spectform::className(), ['id' => 'idSpectForm']);
    }

    /**
     * Gets query for [[Inscriptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscriptions()
    {
        return $this->hasMany(Inscription::className(), ['idFormation' => 'id']);
    }

    /**
     * Gets query for [[Memomatieres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemomatieres()
    {
        return $this->hasMany(Memomatiere::className(), ['idFormation' => 'id']);
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
