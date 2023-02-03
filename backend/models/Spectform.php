<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spectform".
 *
 * @property int $id
 * @property int $idTypeformation
 * @property int $idSpecialite
 * @property string $key_spectform
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property Brouillon[] $brouillons
 * @property User $createdBy
 * @property Formation[] $formations
 * @property Specialite $idSpecialite0
 * @property TypeFormation $idTypeformation0
 * @property User $updatedBy
 */
class Spectform extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spectform';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTypeformation', 'idSpecialite', 'key_spectform', 'created_by', 'created_at'], 'required'],
            [['idTypeformation', 'idSpecialite', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['key_spectform'], 'string', 'max' => 32],
            [['idSpecialite'], 'exist', 'skipOnError' => true, 'targetClass' => Specialite::className(), 'targetAttribute' => ['idSpecialite' => 'id']],
            [['idTypeformation'], 'exist', 'skipOnError' => true, 'targetClass' => TypeFormation::className(), 'targetAttribute' => ['idTypeformation' => 'id']],
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
            'idTypeformation' => 'Id Typeformation',
            'idSpecialite' => 'Id Specialite',
            'key_spectform' => 'Key Spectform',
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
        return $this->hasMany(Brouillon::className(), ['idSpectForm' => 'id']);
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
     * Gets query for [[Formations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormations()
    {
        return $this->hasMany(Formation::className(), ['idSpectForm' => 'id']);
    }

    /**
     * Gets query for [[IdSpecialite0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSpecialite0()
    {
        return $this->hasOne(Specialite::className(), ['id' => 'idSpecialite']);
    }

    /**
     * Gets query for [[IdTypeformation0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypeformation0()
    {
        return $this->hasOne(TypeFormation::className(), ['id' => 'idTypeformation']);
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
