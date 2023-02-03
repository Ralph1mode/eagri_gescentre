<?php

namespace backend\controllers;

use backend\models\Brouillon;
use backend\models\Matiere;
use backend\models\Memomatiere;
use backend\models\Specialite;
use backend\models\Spectform;
use backend\models\SpectformSearch;
use backend\models\TypeFormation;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpectformController implements the CRUD actions for Spectform model.
 */
class SpectformController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                /*'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],]*/],
        );
    }

    /**
     * Lists all Spectform models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $droit_create_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_create_spectform == 1) {
            $searchModel = new SpectformSearch();
            //$dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider = new ActiveDataProvider([
                'query' => Spectform::find()
                    ->where([
                        'statut' => 1
                    ]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Displays a single Spectform model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key)
    {
        $droit_create_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_create_spectform == 1) {
            $spectform = $this->getModelbykey($key);
            $dataProvider = new ActiveDataProvider([
                'query' => Brouillon::find()
                    ->where([
                        'statut' => 1,
                        'idSpectform' => $spectform->id,
                    ])
            ]);
            return $this->render('view', [
                'model' => $this->getModelbykey($key),
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Creates a new Spectform model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /*  public function actionCreate()
    {
        $model = new Spectform();

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

    public function actionCreate()
    {
        $droit_create_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_create_spectform == 1) {
            $model = new Spectform();
            $typeform = TypeFormation::find()->where(['statut' => 1])->all();
            $specialite = Specialite::find()->where(['statut' => 1])->all();

            //var_dump(Yii::$app->request->post());exit;
            if (Yii::$app->request->isPost) {
                // $test = Yii::$app->request->post()['Spectform']['idTypeformation'];
                print_r($_POST);
                exit;
                /* if ($model->load($this->request->post()) && $model->save()) */
                if ($model->load($this->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_spectform = Yii::$app->security->generateRandomString(32);

                    $existant = $model->libelle;
                    $donnee = Spectform::find()->where(['libelle' => $existant, 'statut' => 1])->one();
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
                return $this->render('create', [
                    'model' => $model,
                    'typeform' => $typeform,
                    'specialite' => $specialite,
                ]);
            }
        } else {
            return $this->redirect('index');
        }
    }
    public function actionSetparam()
    {
        $session = Yii::$app->getSession();
        $session->set('spectform', $_GET['spectform']);
    }

    public function actionSave_specf()
    {
        $droit_create_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_create_spectform == 1) {

            if (Yii::$app->request->isPost) {
                $all_data = Yii::$app->request->post();

                if ($all_data['type_action'] == "CREATE") {
                    $model = new Spectform();
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_spectform = Yii::$app->security->generateRandomString(32);
                } else if ($all_data['type_action'] == "UPDATE") {
                    $model = Spectform::findOne(['key_spectform' => $all_data['key_brouillon']]);
                    // $model->key_spectform = Yii::$app->security->generateRandomString(32);
                    $model = Spectform::findOne(['key_spectform' => $_GET['key']]);
                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->updated_by = Yii::$app->user->identity->id;
                }

                $model->idTypeformation = $all_data['typeformation'];
                $model->idSpecialite = $all_data['specialite'];
                // $model->save();
                $donnee = Spectform::find()->where(['idTypeformation' => $all_data['typeformation'], 'idSpecialite' => $all_data['specialite'], 'statut' => 1])->one();
                if ($donnee != null) {
                    if ($all_data['type_action'] == "CREATE") {
                        return 'ko';
                    } else if ($all_data['type_action'] == "UPDATE") {
                        if ($model->id != $donnee->id) {
                            return 'ko';
                        }
                    }
                } else if ($donnee == null) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Paramètre enrégistrer avec succès');
                        return 'ok';
                    } else {
                        Yii::$app->session->setFlash('error', json_encode($model->getErrors()));
                        $model->loadDefaultValue();
                    }
                }


                $all_detail_matieres = $all_data['all_detail_added'];
                $r = str_replace("###", "", $all_detail_matieres) . '+';
                $e = explode("***+", $r)[0];

                $all_data = explode("***", $e);
                for ($i = 0; $i < sizeof($all_data); $i++) {
                    $final_selected_value = explode(";;;", $all_data[$i]);

                    $model2 = new Brouillon();
                    $model2->created_at = date('Y-m-d H:i:s');
                    $model2->created_by = Yii::$app->user->identity->id;
                    $model2->statut = 1;
                    $model2->idMatiere = $final_selected_value[0];
                    $model2->nb_heure = $final_selected_value[1];
                    $model2->idSpectForm = $model->id;
                    $model2->key_brouillon = Yii::$app->security->generateRandomString(32);
                    $model2->save();
                    if ($i == sizeof($all_data) - 1 && $model->save) {
                        $msg = 'Paramétrage effectué avec succès';
                        Yii::$app->session->setFlash('success', $msg);
                        return json_encode([
                            'status' => 'ok',
                            // 'message' => $msg,
                        ]);
                    } else {
                        $msg = 'Ce paramètre existe déjà';
                        Yii::$app->session->setFlash('error', $msg);
                        return json_encode([
                            'status' => 'koo',
                            'message' => $msg,
                        ]);
                    }
                }

                // $model->idTypeformation = $all_data['typeformation'];
                // $model->idSpecialite = $all_data['specialite'];



            } else {
                Yii::$app->session->setFlash('error', 'aucune donnee recu en post');
                return 'ko';
            }
        } else {
            return $droit_create_spectform;
            //    return $this->redirect('index');
        }
    }

    public function actionCreatemat($key)
    {
        $droit_create_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_create_spectform == 1) {
            $model = new Brouillon();
            return $this->render('createmat', [
                'model' => $model,
            ]);
        } else {
            return $this->render('index');
        }
    }

    public function actionSave_matiere()
    {
        $droit_create_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_create_spectform == 1) {
            if (Yii::$app->request->post()) {
                $all_post = Yii::$app->request->post();
                $formation = Spectform::find()
                    ->where(['statut' => 1, 'key_spectform' => $all_post['key_spectform']])
                    ->one();

                if (isset($formation)) {
                    $all_detail_matieres = $all_post['all_detail_added'];
                    $r = str_replace("###", "", $all_detail_matieres) . '+';
                    $e = explode("***+", $r)[0];

                    $all_data = explode("***", $e);
                    for ($i = 0; $i < sizeof($all_data); $i++) {
                        $final_selected_value = explode(";;;", $all_data[$i]);

                        $model2 = new Brouillon();
                        $model2->created_at = date('Y-m-d H:i:s');
                        $model2->created_by = Yii::$app->user->identity->id;
                        $model2->statut = 1;
                        $model2->idMatiere = $final_selected_value[0];
                        $model2->nb_heure = $final_selected_value[1];
                        $model2->idSpectForm = $formation->id;
                        $model2->key_brouillon = Yii::$app->security->generateRandomString(32);

                        $exist = Brouillon::find()->where(['statut' => 1, 'idMatiere' => $model2->idMatiere, 'idSpectform' => $formation->id])->one();
                        if ($exist == "") {

                            $model2->save();

                            if (($model2->save()) && ($i == sizeof($all_data) - 1)) {
                                $msg = 'Matières enregistrées avec succès';
                                Yii::$app->session->setFlash('success', $msg);
                                return 'ok';
                            }
                        } else {
                            $msg = 'Cette matiere existe déjà';
                            $model2->loadDefaultValues();
                            Yii::$app->session->setFlash('error', $msg);
                            return 'ko';
                        }
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Paramètre introuvable');
                    return 'ko';
                }
            } else {
                Yii::$app->session->setFlash('error', 'Aucune données reçu en post');
                return 'ko';
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
        }
    }


    public function actionUpdate_brouillon()
    {

        $droit_param = Utils::have_access('manage_specialite_formation');
        if ($droit_param == 1) {
            $all_data = Yii::$app->request->post();
            $model2 = Brouillon::findOne(['key_brouillon' => $all_data['key_brouillon']]);
            if ($model2 != null) {
                $model2->nb_heure = $all_data['nbr_heure'];
                $model2->statut = 1;
                $model2->updated_by = Yii::$app->user->identity->id;
                $model2->updated_at = date('Y-m-d H:i:s');

                if ($model2->save()) {
                    // Yii::$app->getSession()->setFlash('success', 'Matière modifiée avec succès !');
                    // return $this->redirect(['view', 'key' => $model->key_spectform]);


                } else {
                    Yii::$app->getSession()->setFlash('error', json_encode($model2->getErrors()));
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Une erreur est survenue. Veuillez reéssayer plus tard');
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
        }
    }




    /**
     * Updates an existing Spectform model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*     public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    } */

    public function actionUpdate0($key)
    {
        $droit_update_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_update_spectform == 1) {
            $model = $this->getModelbykey($key);
            $typeform = TypeFormation::find()->where(['statut' => 1])->all();
            $specialite = Specialite::find()->where(['statut' => 1])->all();

            if (Yii::$app->request->post()) {
                /* if ($model->load($this->request->post()) && $model->save()) */
                if ($model->load($this->request->post())) {

                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_spectform = Yii::$app->security->generateRandomString(32);

                    if ($model->save()) {

                        return $this->redirect(['view', 'key' => $model->key_spectform]);
                    } else {
                        print_r($model->geterrors());
                        die;
                    }
                }
            } else {
                //$model->loadDefaultValues();
                return $this->render('update', [
                    'model' => $model,
                    'typeform' => $typeform,
                    'specialite' => $specialite,
                ]);
            }

            return $this->render('update', [
                'model' => $model,
                'typeform' => $typeform,
                'specialite' => $specialite,
            ]);
        } else {
            return $this->redirect('index');
        }
    }


    /*Action update personnalisé */
    public function actionUpdate()
    {
        $droit_create_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_create_spectform == 1) {
            $model = Spectform::findOne(['key_spectform' => $_GET['key']]);
            $typeform = TypeFormation::find()->where(['statut' => 1])->all();
            $specialite = Specialite::find()->where(['statut' => 1])->all();

            if (Yii::$app->request->isPost) {
                $all_data = Yii::$app->request->post();

                $model->idTypeformation = $all_data['typeformation'];
                $model->idSpecialite = $all_data['specialite'];
                $model->updated_at = date('Y-m-d H:i:s');
                $model->updated_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->key_spectform = Yii::$app->security->generateRandomString(32);

                $existant = $model->idTypeformation;
                $existant2 = $model->idSpecialite;
                $donnee = Spectform::find()->where(['idTypeformation' => $existant, 'statut' => 1])->one();
                $donnee2 = Spectform::find()->where(['idSpecialite' => $existant2, 'statut' => 1])->one();
                //($donnee == "" && $donnee2 == "") || ($donnee == "" && $donnee2 != "") || ($donnee != "" && $donnee2 == "")
                if ($donnee != "" && $donnee2 != "") {
                    Yii::$app->session->setFlash('error', 'Ce paramètre existe déjà !');
                    $model->loadDefaultValues();
                } else {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'successful');
                        return 'ok';
                    } else {
                        Yii::$app->session->setFlash('error', json_encode($model->getErrors()));
                        $model->loadDefaultValue();
                    }
                }
            }

            return $this->render('update', [
                'model' => $model,
                'typeform' => $typeform,
                'specialite' => $specialite,
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Deletes an existing Spectform model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionDelete($key)
    {
        $this->getModelbykey($key)->delete();

        return $this->redirect(['/all_spectform']);
    } */

    public function actionDelete($key)
    {
        $droit_delete_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_delete_spectform == 1) {
            // $model = $this->getModelbykey($key);
            $model = Spectform::findOne(['key_spectform' => $key]);
            //$model = $this->findModel($id);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    return $this->redirect(['/all_spectform']);
                } else {
                    return $model->getErrors('Type de formation introuvable!');
                }
            } else {
                return $this->redirect(['/all_spectform']);
            }
        } else {
            return $this->redirect('index');
        }
    }

    public function actionDeletemat($key)
    {
        $droit_delete_specialite = Utils::have_access('manage_specialite_formation');
        if ($droit_delete_specialite == 1) {
            $model = Brouillon::findOne(['key_brouillon' => $key]);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Matière supprimée avec succès !');
                    // return $this->redirect(['view', 'key' => $model->key_formation]);
                    // return $this->redirect(['index']);
                    //Yii::$app->getSession()->setFlash('success', 'Matière supprimée avec succès!');
                } else {
                    Yii::$app->getSession()->setFlash('error', json_encode($model->getErrors()));
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Une erreur est survenue. Veuillez reéssayer plus tard');
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
        }
    }


    public function actionDelete_spectf($key)
    {
        $droit_delete_specialite = Utils::have_access('manage_specialite_formation');
        if ($droit_delete_specialite == 1) {

            // $model = $this->getModelbykey($key);
            $model = Spectform::findOne(['key_spectform' => $key]);

            //$model = Specialite::find()->where(['statut' => 1, 'key_spectform' => $key])->one();
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Paramètre supprimé avec succès!');
                } else {
                    Yii::$app->getSession()->setFlash('error', json_encode($model->getErrors()));
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Une erreur est survenue. Veuillez reéssayer plus tard');
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
        }
    }

    /**
     * Finds the Spectform model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Spectform the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Spectform::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getModelbykey($key)
    {
        $spectform = Spectform::findOne([
            'key_spectform' => $key
        ]);

        if ($spectform != null) {
            return $spectform;
        }
        return null;
    }
}
