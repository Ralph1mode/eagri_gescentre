<?php

namespace backend\controllers;

use backend\models\ApprenantSearch;
use backend\models\Apprenant;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\controllers\Utils;
use backend\models\Inscription;
use backend\models\Payement;
use yii\data\ActiveDataProvider;

/**
 * ApprenantController implements the CRUD actions for Apprenant model.
 */
class ApprenantController extends Controller
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
     * Lists all Apprenant models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ApprenantSearch();
        $additional = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $additional);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Apprenant model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key)
    {
        return $this->render('view', [
            'model' => $this->getModelbykey($key),
        ]);
    }


    /**
     * Creates a new Apprenant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Apprenant();

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
    }



    public function actionSetapprenant()
    {
        $droit_apprenant = Utils::have_access('manage_students');
        if ($droit_apprenant == 1) {
            $session = Yii::$app->getSession();
            $session->set('apprenant', $_GET['apprenant']);
        } else {
            return $droit_apprenant;
        }
    }


    public function actionSaveapprenant()
    {
        $droit_apprenant = Utils::have_access('manage_students');
        if ($droit_apprenant == 1) {

            if (Yii::$app->request->isPost) {
                $all_data = Yii::$app->request->post();

                if ($all_data['type_action'] == "CREATE") {

                    $model = new Apprenant();
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_apprenant = Yii::$app->security->generateRandomString(32);
                } else if ($all_data['type_action'] == "UPDATE") {
                    $model = Apprenant::find()->where(['key_apprenant' => $all_data['key_apprenant']])->one();
                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->updated_by = Yii::$app->user->identity->id;
                }

                $diplomePath =  'uploads/diplomes';
                $photosPath =  'uploads/photos';
                $piecesPath = 'uploads/pieces';

                $files = $_FILES;

                $namePhoto  = time() . '-' . $files['photo']['name']; // File name
                $tmp_namePhoto  = $files['photo']['tmp_name'];

                $namePieces  = time() . '-' . $files['piece']['name']; // File name
                $tmp_namePiece  = $files['piece']['tmp_name'];

                $nameDiplome  = time() . '-' . $files['diplome']['name']; // File name
                $tmp_nameDiplome  = $files['diplome']['tmp_name'];

                if (!is_dir($diplomePath)) {
                    mkdir($diplomePath, 0777);
                }

                if (!is_dir($piecesPath)) {
                    mkdir($piecesPath, 0777);
                }

                if (!is_dir($photosPath)) {
                    mkdir($photosPath, 0777);
                }

                move_uploaded_file($tmp_namePhoto, $photosPath . '/' . $namePhoto);
                move_uploaded_file($tmp_namePiece, $piecesPath . '/' . $namePieces);
                move_uploaded_file($tmp_nameDiplome, $diplomePath . '/' . $nameDiplome);


                $model->idPays = $all_data['pays'];
                $model->nom = strtoupper($all_data['nom']);
                $model->prenom = $all_data['prenom'];
                $model->sexe = $all_data['sexe'];
                $model->datenaisse = $all_data['date_naiss'];
                $model->email = $all_data['email'];
                $model->tel = $all_data['num_tel'];
                $model->niveau = $all_data['niv_etude'];
                $model->profession = $all_data['profession'];
                $model->chem_photo = $namePhoto;
                $model->chem_piece = $namePieces;
                $model->chem_diplome = $nameDiplome;


                $model2 = new Inscription();
                $model2->created_by = Yii::$app->user->identity->id;
                $model2->created_at = date('Y-m-d H:i:s');
                $model2->statut = 1;
                $model2->key_inscription = Yii::$app->security->generateRandomString(32);

                $model2->idFormation = $all_data['formation'];
                $model2->code_carte = null;
                $model2->moyenne = null;

                $model3 = new Payement();
                $model3->created_by = Yii::$app->user->identity->id;
                $model3->created_at = date('Y-m-d H:i:s');
                $model3->statut = 1;
                $model3->key_payement = Yii::$app->security->generateRandomString(32);

                $model3->moypay = $all_data['moyen_pay'];
                $model3->reference = $all_data['reference'];
                $model3->montant_paye = $all_data['somme_deja_pay'];
                $model3->datepay = $all_data['paye_le'];

                $limite_age = 18;
                $age = date('Y') - date('Y', strtotime($model->datenaisse));
                // if ($age < $limite_age) {
                //$age = date('Y') - $model->datenaisse;

                if ($all_data['type_action'] == "CREATE") {
                    $existant = Apprenant::find()->where(['statut' => 1, 'nom' => $model->nom, 'prenom' => $model->prenom])->one();
                    if ($existant == null) {
                        //if ($model->datenaisse != null) {
                        if ($age > $limite_age) {
                            if ($model3->datepay >= date('Y-d-m')) {
                                if ($model->save()) {
                                    $model2->idApprenant = $model->id;
                                    $model2->code_carte = date('dmY') . 'eagri00' . $model->id;

                                    if ($model2->save()) {
                                        $model3->idInscription = $model2->id;
                                        if ($model3->save()) {


                                            $msg = 'Inscription effectuée avec succès';
                                            Yii::$app->session->setFlash('success', ($msg));
                                            return 'ok';
                                        } else {
                                            $msg = json_encode($model3->getErrors());
                                            Yii::$app->session->setFlash('error', ($msg));
                                            $model->loadDefaultValues();
                                            return 'ko';
                                        }
                                    } else {
                                        $msg = json_encode($model2->getErrors());
                                        Yii::$app->session->setFlash('error', ($msg));
                                        $model->loadDefaultValues();
                                        return 'ko';
                                    }
                                } else {
                                    $msg = json_encode($model->getErrors());
                                    Yii::$app->session->setFlash('error', ($msg));
                                    $model->loadDefaultValues();
                                    return 'ko';
                                }
                                /*  } else {
                                $msg = 'Apprenant trop jeune pour un inscription à EagriBusiness';
                                Yii::$app->session->setFlash('error', ($msg));
                                $model->loadDefaultValues();
                                return 'ko';
                            } */
                            } else {
                                $msg = 'Les payements ou frais d\'inscriptions s\'éffectuent avant ou lors de l\'inscription';
                                Yii::$app->session->setFlash('error', ($msg));
                                $model->loadDefaultValues();
                                return 'ko';
                            }
                        } else {
                            $msg = 'L\'apprenant doit avoir au moins 18 ans';
                            Yii::$app->session->setFlash('error', ($msg));
                            $model->loadDefaultValues();
                            return 'ko';
                        }
                    } else {
                        $msg = 'Apprenant déjà inscrit';
                        Yii::$app->session->setFlash('error', ($msg));
                        $model->loadDefaultValues();
                        return 'ko';
                    }
                } else if ($all_data['type_action'] == "UPDATE") {
                    $existant = Apprenant::find()->where(['statut' => 1, 'nom' => $model->nom, 'prenom' => $model->prenom])->one();

                    // if ($model->datenaisse > date('Y-m-d H:i:s')) {
                    if ($model->save()) {
                       /*  $model2->idApprenant = $existant->id;
                        $model2->code_carte = date('dmY') . 'eagri00' . $model->id; 

                         if ($model2->save()) {
                            $model3->idInscription = $model2->id;
                            if ($model3->save()) {*/

                                $msg = 'Modification effectuée avec succès';
                                Yii::$app->session->setFlash('success', ($msg));
                                return 'ok';/*
                            } else {
                                $msg = json_encode($model3->getErrors());
                                Yii::$app->session->setFlash('error', ($msg));
                                $model->loadDefaultValues();
                                return 'ko';
                            }
                        } else {
                            $msg = json_encode($model2->getErrors());
                            Yii::$app->session->setFlash('error', ($msg));
                            $model->loadDefaultValues();
                            return 'ko';
                        } */
                    } else {
                        $msg = json_encode($model->getErrors());
                        Yii::$app->session->setFlash('error', ($msg));
                        $model->loadDefaultValues();
                        return 'ko';
                    }
                    /*  } else {
                            $msg = 'Apprenant trop jeune pour un inscription à EagriBusiness';
                            Yii::$app->session->setFlash('error', ($msg));
                            $model->loadDefaultValues();
                            return 'ko';
                        } */
                    // } else {
                    //     $msg = 'L\'apprenant doit avoir au moins 18 ans';
                    //     Yii::$app->session->setFlash('error', ($msg));
                    //     $model->loadDefaultValues();
                    //     return 'ko';
                    // }
                }
            } else {
                Yii::$app->session->setFlash('error', 'aucune donnée reçu en post');
                //$model->loadDefaultValues();
                // return 'ko';
            }
        } else {
            return $droit_apprenant;
        }
    }


    /**
     * Updates an existing Apprenant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionUpdate($id)
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
        $droit_apprenant = Utils::have_access('manage_students');
        if ($droit_apprenant == 1) {
            $model = $this->getModelbykey($key);

            if (Yii::$app->request->post()) {

                if ($model->load($this->request->post())) {

                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_apprenant = Yii::$app->security->generateRandomString(32);

                    $nom_existant = $model->nom;
                    $prenom_existant = $model->prenom;
                    $donnee = Apprenant::find()->where(['nom' => $nom_existant, 'prenom' => $prenom_existant, 'statut' => 1])->one();
                    if ($donnee != null) {

                        $model->loadDefaultValues();
                    } else {

                        if ($model->save()) {

                            return $this->redirect(['index']);
                        } else {

                            $model->loadDefaultValues();
                        }
                    }
                }
            } else {
                //$model->loadDefaultValues();
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->redirect('index');
        }
    }


    /**
     * Deletes an existing Apprenant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    } */


    public function actionDelete($key)
    {
        $droit_apprenant = Utils::have_access('manage_students');
        if ($droit_apprenant == 1) {
            $droit_formation = Utils::have_access('manage_formation');
            if ($droit_formation == 1) {
                $model = Apprenant::findOne(['key_apprenant' => $key]);
                if ($model != null) {
                    $model->statut = 3;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->updated_at = date('Y-m-d H:i:s');

                    if ($model->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Apprenant supprimé avec succès!');
                        return 'ok';
                    } else {
                        Yii::$app->getSession()->setFlash('error', json_encode($model->getErrors()));
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Une erreur est survenue. Veuillez reéssayer plus tard');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
            }
        } else {
            return $droit_apprenant;
        }
    }


    /**
     * Finds the Apprenant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Apprenant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apprenant::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getModelbykey($key)
    {

        $Apprenant = Apprenant::findOne([
            'key_apprenant' => $key
        ]);

        if ($Apprenant != null) {
            return $Apprenant;
        }
        return null;
    }
}
