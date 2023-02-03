<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inscription".
 *
 * @property int $id
 * @property int $idFormation
 * @property int $idApprenant
 * @property string|null $code_carte
 * @property float|null $moyenne
 * @property string $key_inscription
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Apprenant $idApprenant0
 * @property Formation $idFormation0
 * @property Note[] $notes
 * @property Payement[] $payements
 * @property User $updatedBy
 */
class Inscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idFormation', 'idApprenant', 'key_inscription', 'created_by', 'created_at'], 'required'],
            [['idFormation', 'idApprenant', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['moyenne'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['code_carte', 'key_inscription'], 'string', 'max' => 32],
            [['idApprenant'], 'exist', 'skipOnError' => true, 'targetClass' => Apprenant::className(), 'targetAttribute' => ['idApprenant' => 'id']],
            [['idFormation'], 'exist', 'skipOnError' => true, 'targetClass' => Formation::className(), 'targetAttribute' => ['idFormation' => 'id']],
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
            'idFormation' => 'Id Formation',
            'idApprenant' => 'Id Apprenant',
            'code_carte' => 'Code Carte',
            'moyenne' => 'Moyenne',
            'key_inscription' => 'Key Inscription',
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
     * Gets query for [[IdApprenant0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdApprenant0()
    {
        return $this->hasOne(Apprenant::className(), ['id' => 'idApprenant']);
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
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['idInscription' => 'id']);
    }

    /**
     * Gets query for [[Payements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayements()
    {
        return $this->hasMany(Payement::className(), ['idInscription' => 'id']);
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
