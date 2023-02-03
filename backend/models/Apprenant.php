<?php

namespace backend\models;


use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "apprenant".
 *
 * @property int $id
 * @property int $idPays
 * @property string $nom
 * @property string $prenom
 * @property string $sexe
 * @property string $datenaisse
 * @property string $email
 * @property string $tel
 * @property string $niveau
 * @property string|null $profession
 * @property string|null $chem_photo
 * @property string $chem_piece
 * @property string $chem_diplome
 * @property string $key_apprenant
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $statut
 *
 * @property User $createdBy
 * @property Pays $idPays0
 * @property Inscription[] $inscriptions
 * @property Note[] $notes
 * @property User $updatedBy
 */
class Apprenant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apprenant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPays', 'nom', 'prenom', 'sexe', 'datenaisse', 'email', 'tel', 'niveau', 'chem_piece', 'chem_diplome', 'key_apprenant', 'created_by', 'created_at'], 'required'],
            [['idPays', 'created_by', 'updated_by', 'statut'], 'integer'],
            [['datenaisse', 'created_at', 'updated_at'], 'safe'],
            // [['chem_photo', 'chem_piece', 'chem_diplome'], 'string'],
            // [['chem_piece', 'chem_diplome'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf'],
            // [['chem_photo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg'],
            [['nom', 'profession'], 'string', 'max' => 50],
            [['prenom'], 'string', 'max' => 70],
            [['sexe'], 'string', 'max' => 9],
            [['email'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 10],
            [['niveau'], 'string', 'max' => 30],
            [['key_apprenant'], 'string', 'max' => 32],
            [['idPays'], 'exist', 'skipOnError' => true, 'targetClass' => Pays::className(), 'targetAttribute' => ['idPays' => 'id']],
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
            'idPays' => 'Pays de provenance',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'sexe' => 'Sexe',
            'datenaisse' => 'Date de naissance',
            'email' => 'Email',
            'tel' => 'Contact',
            'niveau' => 'Niveau d\'étude',
            'profession' => 'Profession',
            'chem_photo' => 'Photo d\'identité',
            'chem_piece' => 'Pièce d\'identité',
            'chem_diplome' => 'Diplome',
            'key_apprenant' => 'Key Apprenant',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'statut' => 'Statut',
        ];
    }


    /*     public function upload()
    {
        if ($this->validate()) {
            $this->chem_photo->saveAs('../uploads/' . $this->chem_photo->baseName . '.' . $this->chem_photo->extension);
            $this->chem_piece->saveAs('../uploads/' . $this->chem_piece->baseName . '.' . $this->chem_piece->extension);
            $this->chem_diplome->saveAs('../uploads/' . $this->image->baseName . '.' . $this->chem_diplome->extension);
            return true;
        } else {
            return false;
        }
    } */

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
     * Gets query for [[IdPays0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPays0()
    {
        return $this->hasOne(Pays::className(), ['id' => 'idPays']);
    }

    /**
     * Gets query for [[Inscriptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscriptions()
    {
        return $this->hasMany(Inscription::className(), ['idApprenant' => 'id']);
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['idApprenant' => 'id']);
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
