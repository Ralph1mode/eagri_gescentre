<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "type_formation".
 *
 * @property int $id
 * @property string $libelle
 * @property string|null $descriptions
 * @property string $key_typeformation
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Spectform[] $spectforms
 * @property User $updatedBy
 */
class TypeFormation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_formation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libelle', 'key_typeformation', 'created_by', 'created_at'], 'required'],
            [['created_by', 'updated_by', 'statut'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['libelle'], 'string', 'max' => 70],
            [['descriptions'], 'string', 'max' => 100],
            [['key_typeformation'], 'string', 'max' => 32],
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
            'key_typeformation' => 'Key Typeformation',
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
     * Gets query for [[Spectforms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpectforms()
    {
        return $this->hasMany(Spectform::className(), ['idTypeformation' => 'id']);
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
