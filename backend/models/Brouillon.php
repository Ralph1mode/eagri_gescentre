<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brouillon".
 *
 * @property int $id
 * @property int $idSpectForm
 * @property int $idMatiere
 * @property int $nb_heure
 * @property string $key_brouillon
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Matiere $idMatiere0
 * @property Spectform $idSpectForm0
 * @property User $updatedBy
 */
class Brouillon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brouillon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSpectForm', 'idMatiere', 'nb_heure', 'key_brouillon', 'created_by', 'created_at'], 'required'],
            [['idSpectForm', 'idMatiere', 'nb_heure', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['key_brouillon'], 'string', 'max' => 32],
            [['idMatiere'], 'exist', 'skipOnError' => true, 'targetClass' => Matiere::className(), 'targetAttribute' => ['idMatiere' => 'id']],
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
            'idMatiere' => 'Id Matiere',
            'nb_heure' => 'Nb Heure',
            'key_brouillon' => 'Key Brouillon',
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
     * Gets query for [[IdMatiere0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdMatiere0()
    {
        return $this->hasOne(Matiere::className(), ['id' => 'idMatiere']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
