<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pays".
 *
 * @property int $id
 * @property string $libelle
 * @property string|null $code
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property Apprenant[] $apprenants
 * @property User $createdBy
 * @property User $updatedBy
 */
class Pays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pays';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libelle', 'created_by', 'created_at'], 'required'],
            [['created_by', 'updated_by', 'statut'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['libelle'], 'string', 'max' => 70],
            [['code'], 'string', 'max' => 6],
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
            'code' => 'Code',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'statut' => 'Statut',
        ];
    }

    /**
     * Gets query for [[Apprenants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApprenants()
    {
        return $this->hasMany(Apprenant::className(), ['idPays' => 'id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
