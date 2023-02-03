<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "memomatiere".
 *
 * @property int $id
 * @property int $idMatiere
 * @property int $idFormation
 * @property int $nb_heure
 * @property string $key_memomatiere
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Formation $idFormation0
 * @property Matiere $idMatiere0
 * @property User $updatedBy
 */
class Memomatiere extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memomatiere';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idMatiere', 'idFormation', 'nb_heure', 'key_memomatiere', 'created_by', 'created_at'], 'required'],
            [['idMatiere', 'idFormation', 'nb_heure', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['key_memomatiere'], 'string', 'max' => 32],
            [['idFormation'], 'exist', 'skipOnError' => true, 'targetClass' => Formation::className(), 'targetAttribute' => ['idFormation' => 'id']],
            [['idMatiere'], 'exist', 'skipOnError' => true, 'targetClass' => Matiere::className(), 'targetAttribute' => ['idMatiere' => 'id']],
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
            'idMatiere' => 'Id Matiere',
            'idFormation' => 'Id Formation',
            'nb_heure' => 'Nb Heure',
            'key_memomatiere' => 'Key Memo Matiere',
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
     * Gets query for [[IdFormation0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdFormation0()
    {
        return $this->hasOne(Formation::className(), ['id' => 'idFormation']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
