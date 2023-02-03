<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "profil_fonctionnalite".
 *
 * @property int $id
 * @property int $idProfil
 * @property int $idFonctionnalite
 * @property string $key_profilfonctionnalite
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Fonctionnalite $idFonctionnalite0
 * @property Profil $idProfil0
 * @property User $updatedBy
 */
class ProfilFonctionnalite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profil_fonctionnalite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProfil', 'idFonctionnalite', 'key_profilfonctionnalite', 'created_by', 'created_at'], 'required'],
            [['idProfil', 'idFonctionnalite', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['key_profilfonctionnalite'], 'string', 'max' => 32],
            [['idFonctionnalite'], 'exist', 'skipOnError' => true, 'targetClass' => Fonctionnalite::className(), 'targetAttribute' => ['idFonctionnalite' => 'id']],
            [['idProfil'], 'exist', 'skipOnError' => true, 'targetClass' => Profil::className(), 'targetAttribute' => ['idProfil' => 'id']],
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
            'idProfil' => 'Id Profil',
            'idFonctionnalite' => 'Id Fonctionnalite',
            'key_profilfonctionnalite' => 'Key Profilfonctionnalite',
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
     * Gets query for [[IdFonctionnalite0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdFonctionnalite0()
    {
        return $this->hasOne(Fonctionnalite::className(), ['id' => 'idFonctionnalite']);
    }

    /**
     * Gets query for [[IdProfil0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdProfil0()
    {
        return $this->hasOne(Profil::className(), ['id' => 'idProfil']);
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
