<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "matiere".
 *
 * @property int $id
 * @property string $libelle
 * @property string|null $descriptions
 * @property string $key_matiere
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property Brouillon[] $brouillons
 * @property User $createdBy
 * @property Memomatiere[] $memomatieres
 * @property User $updatedBy
 */
class Matiere extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'matiere';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libelle', 'key_matiere', 'created_by', 'created_at'], 'required'],
            [['created_by', 'updated_by', 'statut'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['libelle'], 'string', 'max' => 70],
            [['descriptions'], 'string', 'max' => 100],
            [['key_matiere'], 'string', 'max' => 32],
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
            'libelle' => 'Libelle',
            'descriptions' => 'Descriptions',
            'key_matiere' => 'Key Matiere',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'statut' => 'Statut',
        ];
    }

    /**
     * Gets query for [[Brouillons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrouillons()
    {
        return $this->hasMany(Brouillon::className(), ['idMatiere' => 'id']);
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
     * Gets query for [[Memomatieres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemomatieres()
    {
        return $this->hasMany(Memomatiere::className(), ['idMatiere' => 'id']);
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
