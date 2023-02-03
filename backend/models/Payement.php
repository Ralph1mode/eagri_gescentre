<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payement".
 *
 * @property int $id
 * @property int $idInscription
 * @property string $moypay
 * @property string|null $reference
 * @property float $montant_paye
 * @property string $datepay
 * @property string $key_payement
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Inscription $idInscription0
 * @property User $updatedBy
 */
class Payement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idInscription', 'moypay', 'montant_paye', 'datepay', 'key_payement', 'created_by', 'created_at'], 'required'],
            [['idInscription', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['montant_paye'], 'number'],
            [['datepay', 'created_at', 'updated_at'], 'safe'],
            [['moypay'], 'string', 'max' => 50],
            [['reference'], 'string', 'max' => 70],
            [['key_payement'], 'string', 'max' => 32],
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
            'idInscription' => 'Id Inscription',
            'moypay' => 'Moypay',
            'reference' => 'Reference',
            'montant_paye' => 'Montant Paye',
            'datepay' => 'Datepay',
            'key_payement' => 'Key Payement',
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
