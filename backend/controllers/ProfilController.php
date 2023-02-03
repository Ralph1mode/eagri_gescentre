<?php

namespace backend\controllers;

use backend\models\Fonctionnalite;
use backend\models\Profil;
use backend\models\ProfilFonctionnalite;
use backend\models\ProfilSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfilController implements the CRUD actions for Profil model.
 */
class ProfilController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                /*  'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ], */]
        );
    }

    /**
     * Lists all Profil models.
     *
     * @return string
     */
    /*   public function actionIndex()
    {
        $searchModel = new ProfilSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } */

    public function actionIndex()
    {
        $droit_profil = Utils::have_access('manage_rule');
        if ($droit_profil == 1) {
            $searchModel = new ProfilSearch();
            $additional = 1;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $additional);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Displays a single Profil model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    } */

    public function actionView($key)
    {
        $droit_profil = Utils::have_access('manage_rule');
        if ($droit_profil == 1) {
            $mProfil = $this->getModelbykey($key);
            $dataProvider = new ActiveDataProvider([
                'query' => ProfilFonctionnalite::find()
                    ->where(['idProfil' => $mProfil->id])->andWhere(['<>', 'statut', 3]), 'pagination' => ['pageSize' => 5]
            ]);


            return $this->render('view', [
                'model' => $this->getModelbykey($key),
                'dataProvider' => $dataProvider,
                /* 'auteur' => $mDemande-> */
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Creates a new Profil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /*  public function actionCreate()
    {
        $model = new Profil();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    } */
    /*  public function actionCreate()
    {
        if ($all_post = Yii::$app->request->post()) {

            $model = new Profil();
            $model->libelle = trim($all_post['libelle']);
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;
            $model->key_profil = Yii::$app->security->generateRandomString(32);
            $model->statut = 1;

            $eval_existant = Profil::find()->where(['statut' => 1, 'libelle' => trim($all_post['libelle'])])->one();
            if ($eval_existant == null) {
                $model->save();
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Profil ajouté avec succès');
                    return 'ok';
                } else {
                    Yii::$app->session->setFlash('error', 'Ajout échoué , veuillez réessayé plus tard');
                    return 'ko';
                }
            } else {
                Yii::$app->session->setFlash('error', 'Ce profil existe déjà ');
                return 'ko';
            }
        } else {

            Yii::$app->getSession()->setFlash('error', 'Une erreur est survenue. Veuillez reéssayer plus tard');
        }
    } */

    public function actionCreate()
    {
        $model = new Profil();

        if (Yii::$app->request->post()) {

            if ($model->load($this->request->post())) {
                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->key_demande = Yii::$app->security->generateRandomString(32);


                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                    return $this->redirect('all_profil');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement, veuillez remplir tous les champs obligatoires !');
                    $model->loadDefaultValues();
                }
            }
        } else {

            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionSave_profil()
    {
        if (Yii::$app->request->get()) {
            $all_data = Yii::$app->request->get();
            $libelle = urldecode($all_data['libelle']);
            $all_detail_added = urldecode($all_data['all_detail_added']);

            if ($this->findModelLibelle($libelle) == 0) {
                $model = new Profil();
                $model->libelle = $libelle;
                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->key_profil = Yii::$app->security->generateRandomString(32);
                $model->save();

                $r = str_replace("###", "", $all_detail_added) . '+';
                $e = explode("*+", $r)[0];

                $all_data = explode("*", $e);
                for ($i = 0; $i < sizeof($all_data); $i++) {
                    $final_selected_value = explode(";;;", $all_data[$i]);

                    $idFonctionnatile = $final_selected_value[0];
                    /* print_r($model->id . '' . $model->libelle);
                    die; */
                    $profil_fonctionnatile = new ProfilFonctionnalite();
                    $profil_fonctionnatile->idFonctionnalite = $idFonctionnatile;
                    $profil_fonctionnatile->idProfil = $model->id;
                    $profil_fonctionnatile->created_at = date('Y-m-d H:i:s');
                    $profil_fonctionnatile->created_by = Yii::$app->user->identity->id;
                    $profil_fonctionnatile->statut = 1;
                    $profil_fonctionnatile->key_profilfonctionnalite = Yii::$app->security->generateRandomString(32);
                    print_r($profil_fonctionnatile);
                    $profil_fonctionnatile->save();

                    if ($i == sizeof($all_data) - 1) {
                        Yii::$app->session->setFlash('success', 'Profil enregistrée avec succès');
                        return 'ok';
                    }
                }
            }
        }
    }


    public function actionSave_fonction($key)
    {
        $droit_profil = Utils::have_access('manage_rule');
        if ($droit_profil == 1) {
            $fonctionnalite = Fonctionnalite::find()
                ->where(['statut' => 1])
                ->all();

            $profil = Profil::find()
                ->where(['key_profil' => $key])
                ->andWhere(['<>', 'statut', 3])
                ->one();

            $model = new ProfilFonctionnalite();

            if ($model->load($this->request->post())) {
                $all_data = Yii::$app->request->get();
                $fonctionnalite = Fonctionnalite::find()
                    ->where(['statut' => 1, 'key_fonctionnalite' => $all_data['key_fonctionnalite']])
                    ->one();
                $model->idFonctionnalite = $fonctionnalite->id;
                $model->idProfil = $profil->id;
                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->key_profilfonctionnalite = Yii::$app->security->generateRandomString(32);

                $mDoublon = ProfilFonctionnalite::find()
                    ->where(['idProfil' => $model->idProfil, 'idFonctionnalite' => $model->idFonctionnalite])
                    ->andWhere(['<>', 'statut', 3])
                    ->all();
                if ($mDoublon == null) {
                    if ($model->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                        return $this->redirect(['view', 'key' => $profil->key_profil]);
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement, veuillez remplir tous les champs obligatoires !');
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Fonctionnalité déjà attribuée !');
                    $model->loadDefaultValues();
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('createdetail', [
                'model' => $model,
                'fonctionnalite' => $fonctionnalite,
                'profil' => $profil
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    public function actionUpdatedetail($key)
    {
        $droit_profil = Utils::have_access('manage_rule');
        if ($droit_profil == 1) {

            $fonctionnalite = Fonctionnalite::find()
                ->where(['statut' => 1])
                ->all();


            $model = ProfilFonctionnalite::find()->where(['key_profilfonctionnalite' => $key])->andWhere(['<>', 'statut', 3])->one();

            $profil = Profil::find()
                ->where(['id' => $model->idProfil])
                ->andWhere(['<>', 'statut', 3])
                ->one();

            if ($model->load($this->request->post())) {

                $model->updated_at = date('Y-m-d H:i:s');
                $model->updated_by = Yii::$app->user->identity->id;

                $mDoublon = ProfilFonctionnalite::find()
                    ->where(['idProfil' => $model->idProfil, 'idFonctionnalite' => $model->idFonctionnalite])
                    ->andWhere(['<>', 'statut', 3])
                    ->all();
                if ($mDoublon == null) {
                    if ($model->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                        return $this->redirect(['view', 'key' => $profil->key_profil]);
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement, veuillez remplir tous les champs obligatoires !');
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Fonctionnalité déjà attribuée !');
                    $model->loadDefaultValues();
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('updatedetail', [
                'model' => $model,
                'fonctionnalite' => $fonctionnalite,
                'profil' => $profil
            ]);
        } else {
            return $this->redirect('index');
        }
    }



    /**
     * Updates an existing Profil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    } */

    public function actionUpdate($key)
    {
        $droit_profil = Utils::have_access('manage_rule');
        if ($droit_profil == 1) {
            $model2 = new Profil();
            $model2->load($this->request->post());
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->statut = 1;
            $model2->key_profil = Yii::$app->security->generateRandomString(32);

            $model2->libelle = trim($model2->libelle);
            $model = $this->getModelbykey($key);

            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                $id = $model->id;
                $libelle = $model2->libelle;
                $libelleFind = Profil::find()
                    ->where(['libelle' => $libelle, 'statut' => 1])
                    ->andWhere(['<>', 'id', $id])->all();

                if ($libelleFind == null) {
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                        return $this->redirect('all_profil');
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Profil déjà existant !');
                    $model2->loadDefaultValues();
                }
            } else {
                return $this->redirect(['/all_profil']);
            }

            return $this->render('update', [
                'model' => $model,
                'model2' => $model2,
            ]);
        } else {
            return $this->redirect('index');
        }
    }



    public function actionDelete1($key)
    {
        $model = Profil::findOne(['key_profil' => $key]);
        if ($model != null) {
            $model->statut = 3;
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d H:i:s');

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Profil supprimé avec succès!');
            } else {
                Yii::$app->getSession()->setFlash('error', json_encode($model->getErrors()));
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Une erreur est survenue. Veuillez reéssayer plus tard');
        }
    }

    public function actionDeletedetail($key_element)
    {

        $model = ProfilFonctionnalite::find()->where(['key_profilfonctionnalite' => $key_element])->andWhere(['<>', 'statut', 3])->one();



        $model->statut = 3;
        $model->updated_by = Yii::$app->user->identity->id;
        $model->updated_at = date('Y-m-d H:i:s');
        if ($model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Suppression réussie !');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Erreur lors du traitement !');
        }
    }

    public function actionDelete($key_element)
    {
        $droit_profil = Utils::have_access('profil');
        if ($droit_profil == 1) {
            $model = $this->getModelbykey($key_element);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Suppression réussie !');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Profil introuvable !');
                return $this->redirect(['/all_profil']);
            }
        } else {
            return $this->redirect('accueil');
        }
    }
    /**
     * Deletes an existing Profil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    } */

    /**
     * Finds the Profil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Profil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profil::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelLibelle($libelle)
    {

        $model = Profil::find()
            ->where([
                'libelle' => $libelle,
                'statut' => 1
            ])->one();

        if ($model != null) {
            return 1;
        } else {
            return 0;
        }
    }


    protected function getModelbykey($key)
    {

        $profil = Profil::findOne([
            'key_profil' => $key
        ]);

        if ($profil != null) {
            return $profil;
        }
        return null;
    }
}
