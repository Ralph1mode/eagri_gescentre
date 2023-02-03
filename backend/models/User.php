<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property int $idProfil
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $sexe
 * @property string $email
 * @property string $telephone
 * @property int $status
 * @property int $role
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $verification_token
 *
 * @property Apprenant[] $apprenants
 * @property Apprenant[] $apprenants0
 * @property Brouillon[] $brouillons
 * @property Brouillon[] $brouillons0
 * @property Evaluation[] $evaluations
 * @property Evaluation[] $evaluations0
 * @property Fonctionnalite[] $fonctionnalites
 * @property Fonctionnalite[] $fonctionnalites0
 * @property Formation[] $formations
 * @property Formation[] $formations0
 * @property Inscription[] $inscriptions
 * @property Inscription[] $inscriptions0
 * @property Matiere[] $matieres
 * @property Matiere[] $matieres0
 * @property Memomatiere[] $memomatieres
 * @property Memomatiere[] $memomatieres0
 * @property Note[] $notes
 * @property Note[] $notes0
 * @property Payement[] $payements
 * @property Payement[] $payements0
 * @property Pays[] $pays
 * @property Pays[] $pays0
 * @property ProfilFonctionnalite[] $profilFonctionnalites
 * @property ProfilFonctionnalite[] $profilFonctionnalites0
 * @property Profil[] $profils
 * @property Profil[] $profils0
 * @property Specialite[] $specialites
 * @property Specialite[] $specialites0
 * @property Spectform[] $spectforms
 * @property Spectform[] $spectforms0
 * @property TypeFormation[] $typeFormations
 * @property TypeFormation[] $typeFormations0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'idProfil', 'auth_key', 'password_hash', 'sexe', 'email', 'telephone', 'role', 'created_by', 'created_at'], 'required'],
            [['idProfil', 'status', 'role', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'telephone', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['sexe'], 'string', 'max' => 1],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['telephone'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'idProfil' => 'Id Profil',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'sexe' => 'Sexe',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'status' => 'Status',
            'role' => 'Role',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * Gets query for [[Apprenants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApprenants()
    {
        return $this->hasMany(Apprenant::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Apprenants0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApprenants0()
    {
        return $this->hasMany(Apprenant::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Brouillons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrouillons()
    {
        return $this->hasMany(Brouillon::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Brouillons0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrouillons0()
    {
        return $this->hasMany(Brouillon::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Evaluations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations()
    {
        return $this->hasMany(Evaluation::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Evaluations0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations0()
    {
        return $this->hasMany(Evaluation::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Fonctionnalites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFonctionnalites()
    {
        return $this->hasMany(Fonctionnalite::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Fonctionnalites0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFonctionnalites0()
    {
        return $this->hasMany(Fonctionnalite::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Formations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormations()
    {
        return $this->hasMany(Formation::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Formations0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormations0()
    {
        return $this->hasMany(Formation::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Inscriptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscriptions()
    {
        return $this->hasMany(Inscription::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Inscriptions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscriptions0()
    {
        return $this->hasMany(Inscription::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Matieres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMatieres()
    {
        return $this->hasMany(Matiere::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Matieres0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMatieres0()
    {
        return $this->hasMany(Matiere::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Memomatieres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemomatieres()
    {
        return $this->hasMany(Memomatiere::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Memomatieres0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemomatieres0()
    {
        return $this->hasMany(Memomatiere::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Notes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes0()
    {
        return $this->hasMany(Note::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Payements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayements()
    {
        return $this->hasMany(Payement::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Payements0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayements0()
    {
        return $this->hasMany(Payement::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Pays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPays()
    {
        return $this->hasMany(Pays::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Pays0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPays0()
    {
        return $this->hasMany(Pays::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[ProfilFonctionnalites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfilFonctionnalites()
    {
        return $this->hasMany(ProfilFonctionnalite::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[ProfilFonctionnalites0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfilFonctionnalites0()
    {
        return $this->hasMany(ProfilFonctionnalite::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Profils]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfils()
    {
        return $this->hasMany(Profil::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Profils0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfils0()
    {
        return $this->hasMany(Profil::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Specialites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialites()
    {
        return $this->hasMany(Specialite::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Specialites0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialites0()
    {
        return $this->hasMany(Specialite::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Spectforms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpectforms()
    {
        return $this->hasMany(Spectform::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Spectforms0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpectforms0()
    {
        return $this->hasMany(Spectform::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[TypeFormations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeFormations()
    {
        return $this->hasMany(TypeFormation::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[TypeFormations0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeFormations0()
    {
        return $this->hasMany(TypeFormation::className(), ['updated_by' => 'id']);
    }
}
