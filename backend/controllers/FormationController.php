<?php

namespace backend\controllers;

use backend\models\Brouillon;
use backend\models\Formation;
use backend\models\FormationSearch;
use backend\models\Matiere;
use backend\models\Memomatiere;
use backend\models\Spectform;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormationController implements the CRUD actions for Formation model.
 */
class FormationController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                /* 'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ], */]
        );
    }

    /**
     * Lists all Formation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $droit_formation = Utils::have_access('manage_formation');
        $lecture_formation = Utils::have_access('read_formation');

        if ($droit_formation == 1 || $lecture_formation) {
            $searchModel = new FormationSearch();
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

    public function actionIndex1()
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            $searchModel = new FormationSearch();
            // $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider = new ActiveDataProvider([
                'query' => Formation::find()
                    ->where([
                        'statut' => 1
                    ])
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
     * Displays a single Formation model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key)
    {
        $droit_formation = Utils::have_access('manage_formation');

        if ($droit_formation == 1) {
            $formation = $this->getModelbykey($key);
            $dataProvider = new ActiveDataProvider([
                'query' => Memomatiere::find()
                    ->where([
                        'statut' => 1,
                        'idFormation' => $formation->id,
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
     * Creates a new Formation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {

            $model = new Formation();
            if ($model->load($this->request->post())) {

                $session = Yii::$app->getSession();
                $spec = $session->get('specialite');
                print_r($spec);
                exit;
                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->key_formation = Yii::$app->security->generateRandomString(32);
                $existant = $model->libelle;
                $donnee = Formation::find()->where(['libelle' => $existant, 'statut' => 1])->one();

                if ($donnee == null) {
                    if ($model->save()) {

                        Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                        return $this->redirect('all_formation');
                    } else {
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'La formation existe déjà !');
                    $model->loadDefaultValues();
                }
            } else {

                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
                //'dataProvider' => $dataProvider,

            ]);
        } else {
            return $this->redirect('index');
        }
    }

    public function actionCreatemat($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            $model = new Memomatiere();
            return $this->render('createmat', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect('index');
        }
    }




    public function actionSave_matiere()
    {
        if (Yii::$app->request->post()) {
            $all_post = Yii::$app->request->post();
            $formation = Formation::find()
                ->where(['statut' => 1, 'key_formation' => $all_post['key_formation']])
                ->one();

            if (isset($formation)) {
                $all_detail_matieres = $all_post['all_detail_added'];
                $r = str_replace("###", "", $all_detail_matieres) . '+';
                $e = explode("***+", $r)[0];

                $all_data = explode("***", $e);
                for ($i = 0; $i < sizeof($all_data); $i++) {
                    $final_selected_value = explode(";;;", $all_data[$i]);

                    $model2 = new Memomatiere();
                    $model2->created_at = date('Y-m-d H:i:s');
                    $model2->created_by = Yii::$app->user->identity->id;
                    $model2->statut = 1;
                    $model2->idMatiere = $final_selected_value[0];
                    $model2->nb_heure = $final_selected_value[1];
                    $model2->idFormation = $formation->id;
                    $model2->key_memomatiere = Yii::$app->security->generateRandomString(32);

                    $existant = Memomatiere::find()->where(['statut' => 1, 'idMatiere' => $final_selected_value[0]])->one();
                    if ($existant == null) {

                        $model2->save();

                        if ($i == sizeof($all_data) - 1) {
                            $msg = 'Matière(s) enregistrée(s) avec succès';
                            Yii::$app->session->setFlash('success', $msg);
                            return 'ok';
                        }
                    } else {
                        $msg = 'Cette matière existe déjà une cette formation';
                        Yii::$app->session->setFlash('error', $msg);
                        return 'ok';
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', 'Formation introuvable');
                return 'ko';
            }
        }
    }


    public function actionUpdate_memomatiere()
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            $all_data = Yii::$app->request->post();
            $model2 = Memomatiere::findOne(['key_memomatiere' => $all_data['key_memomatiere']]);
            if ($model2 != null) {
                $model2->nb_heure = $all_data['nbr_heure'];
                $model2->statut = 1;
                $model2->updated_by = Yii::$app->user->identity->id;
                $model2->updated_at = date('Y-m-d H:i:s');

                if ($model2->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Matière modifiée avec succès !');
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





    public function actionUpdatemat($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            /*chercher liste de matiere*/
            $matiere = Matiere::find()
                ->where(['statut' => 1])->all();

            //trouvons la ligne ou il y'a le key de parametre
            $model = Formation::find()->where(['statut' => 1, 'key_formation' => $key])->one();
            //prenon la formation dans la ligne de memomatiere
            $formation = Memomatiere::find()->where(['statut' => 1, 'idFormation' => $model->id])->one();

            //$model = $this->getModelbykey($key);

            $model2 = new memomatiere();
            if (Yii::$app->request->post()) {
                $model2->load($this->request->post());
                $model2->updated_at = date('Y-m-d H:i:s');
                $model2->updated_by = Yii::$app->user->identity->id;
                $model2->statut = 1;
                $model2->key_memomatiere = Yii::$app->security->generateRandomString(32);
                // print_r($model2->nb_heure);
                // exit;
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                    return $this->redirect(['view', 'key' => $model->key_formation]);
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Modification échoué, veuillez réessayé plus tard.');
                    $model->loadDefaultValues();
                }
            } else {
                //$model->loadDefaultValues();
                return $this->render('updatemat', [
                    'model' => $model,
                    'model2' => $model2,
                    'formation' => $formation,
                    'matiere' => $matiere,
                ]);
            }

            return $this->render('updatemat', [
                'model' => $model,
                'model2' => $model2,
                'formation' => $formation,
                'matiere' => $matiere,
            ]);
        } else {
            Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
        }
    }


    public function actionDeletemat($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            //trouvons la ligne ou il y'a le key de parametre
            $model = Memomatiere::find()->where(['statut' => 1, 'key_memomatiere' => $key])->one();
            //prenon la formation dans la ligne de memomatiere
            $formation = Memomatiere::find()->where(['statut' => 1, 'id' => $model->idFormation])->one();

            //$model = $this->getModelbykey($key);
            $model2 = new memomatiere();

            if (Yii::$app->request->post()) {
                if ($model2->load($this->request->post())) {

                    $model2->updated_at = date('Y-m-d H:i:s');
                    $model2->updated_by = Yii::$app->user->identity->id;
                    $model2->statut = 3;

                    if ($model->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                        return $this->redirect(['view', 'key' => $model->key_formation]);
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Modification échoué, veuillez réessayé plus tard.');
                        $model->loadDefaultValues();
                    }
                }
            } else {
                //$model->loadDefaultValues();
                return $this->render('update', [
                    'model' => $model,
                    'model2' => $model2,
                    'formation' => $formation,
                ]);
            }

            return $this->render('update', [
                'model' => $model,
                'model2' => $model2,
                'formation' => $formation,
            ]);
        } else {
            Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
        }
    }


    /*  public function actionUpdatemat($key)
    {
        $model = $this->getModelbykey($key);

        if (Yii::$app->request->post()) {

            if ($model->load($this->request->post())) {

                $model->updated_at = date('Y-m-d H:i:s');
                $model->updated_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->key_memomatiere = Yii::$app->security->generateRandomString(32);
                print_r('ok');
                exit;
                if ($model->save()) {
                    // return $this->redirect(['view', 'key' => $model->key_formation]);
                    Yii::$app->getSession()->setFlash('success', 'Ajout de matière réussie !');
                    return $this->redirect(['index']);
                } else {

                    $model->loadDefaultValues();
                }
            }
        }
        return $this->render('updatemat', [
            'model' => $model,
        ]);
    } */


    public function actionSetspecialite()
    {
        $session = Yii::$app->getSession();
        $session->set('specialite', $_GET['specialite']);
    }
    public function actionSave_formation()
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {

            if (Yii::$app->request->isPost) {
                $all_data = Yii::$app->request->post();
                $exist = Formation::find()->where(['idSpectform' => $all_data['specialite'], 'libelle' => $all_data['libelle'], 'statut' => 1])->one();

                if ($all_data['type_action'] == 'CREATE') {

                    if ($exist != "" && $exist != null) {
                        return json_encode([
                            'statut' => 'ko',
                            'message' => 'Cette formation exite déjà',
                        ]);
                    } else {


                        $decision_brouillon = $all_data['decision_brouillon'];
                        if ($decision_brouillon == "Oui") {
                            $model = new Formation();
                            $model->created_at = date('Y-m-d H:i:s');
                            $model->created_by = Yii::$app->user->identity->id;
                            $model->statut = 1;
                            $model->cloture = 1;
                            $model->key_formation = Yii::$app->security->generateRandomString(32);
                            $model->idSpectForm = $all_data['specialite'];
                            $model->libelle = $all_data['libelle'];
                            $model->frais = $all_data['frais'];
                            $model->descriptions = $all_data['descriptions'];
                            $model->date_debut = $all_data['date_debut'];
                            $model->date_fin = $all_data['date_fin'];

                            if ($model->frais > 0) {
                                if (($model->date_debut > date('Y-m-d')) || ($model->date_debut == date('Y-m-d'))) {
                                    if (($model->date_fin > date('Y-m-d')) || ($model->date_fin == date('Y-m-d'))) {
                                        if ($model->date_debut < $model->date_fin) {


                                            //la formation est enregistrer

                                            //transférons les données (les matières et le nb_heure) de brouillons vers memomatiere
                                            //vérifions si l'id de spectform reçu existe dans brouillon
                                            $data_brouillon = Brouillon::find()->where(['statut' => 1, 'idSpectForm' => $all_data['specialite']])->all();

                                            if ($data_brouillon != null) {
                                                $existe_result = 1;
                                                $model->save();
                                            } else $existe_result = 0;

                                            if ($existe_result == 1) {
                                                foreach ($data_brouillon as $data_brouillons) {


                                                    $model2 = new Memomatiere();
                                                    $model2->created_at = date('Y-m-d H:i:s');
                                                    $model2->created_by = Yii::$app->user->identity->id;
                                                    $model2->statut = 1;
                                                    $model2->idMatiere = $data_brouillons->idMatiere;
                                                    $model2->nb_heure = $data_brouillons->nb_heure;
                                                    $model2->idFormation = $model->id;
                                                    $model2->key_memomatiere = Yii::$app->security->generateRandomString(32);
                                                    $model2->save();
                                                    $n = 1;
                                                }
                                                //les données de brouillons sont transférés à memomatiere
                                                if ($n == 1) {
                                                    $msg = 'Formation enregistrée avec succès';
                                                    Yii::$app->session->setFlash('success', $msg);
                                                    return json_encode([
                                                        'status' => 'ok',
                                                        'message' => $msg,
                                                    ]);
                                                } else {
                                                    return json_encode([
                                                        'statut' => 'ko',
                                                        'message' => 'Echec g\'enregistrement',
                                                    ]);
                                                }
                                            } else {
                                                return json_encode([
                                                    'statut' => 'ko',
                                                    'message' => 'Aucun brouillon pour cette formation, Veuillez réessayer sans le brouillon en cliquant sur l\'option "Non"',
                                                ]);
                                            }
                                        } else {
                                            $msg = 'Veuillez renseigner des dates valides';
                                            // Yii::$app->session->setFlash('error', $msg);
                                            return json_encode([
                                                'status' => 'ko',
                                                'message' => $msg,
                                            ]);
                                        }
                                    } else {
                                        $msg = 'Veuillez renseigner des dates valides';
                                        // Yii::$app->session->setFlash('error', $msg);
                                        return json_encode([
                                            'status' => 'ko',
                                            'message' => $msg,
                                        ]);
                                    }
                                } else {
                                    $msg = 'Veuillez renseigner une dates valides';
                                    // Yii::$app->session->setFlash('error', $msg);
                                    return json_encode([
                                        'status' => 'ko',
                                        'message' => $msg,
                                    ]);
                                }
                            } else {
                                $msg = 'Frais de formation invalide, les frais de formation ne peuvent pas être moins de zéro Fr CFA';
                                return json_encode([
                                    'status' => 'ko',
                                    'message' => $msg,
                                ]);
                            }
                        }


                        if ($decision_brouillon == "Non") {
                            $model = new Formation();
                            $model->created_at = date('Y-m-d H:i:s');
                            $model->created_by = Yii::$app->user->identity->id;
                            $model->statut = 1;
                            $model->cloture = 1;
                            $model->key_formation = Yii::$app->security->generateRandomString(32);
                            $model->idSpectForm = $all_data['specialite'];
                            $model->libelle = $all_data['libelle'];
                            $model->frais = $all_data['frais'];
                            $model->descriptions = $all_data['descriptions'];
                            if ($model->descriptions == "") {
                                $model->descriptions = "Aucune description";
                            }
                            $model->date_debut = $all_data['date_debut'];
                            $model->date_fin = $all_data['date_fin'];
                            if ($model->frais > 0) {
                                if (($model->date_debut > date('Y-m-d')) || ($model->date_debut == date('Y-m-d'))) {
                                    if (($model->date_fin > date('Y-m-d')) || ($model->date_fin == date('Y-m-d'))) {
                                        if ($model->date_debut < $model->date_fin) {
                                            $model->save();
                                            //la formation est enregistrer

                                            if ($model->save()) {
                                                $msg = 'Formation enregistrée avec succès';
                                                Yii::$app->session->setFlash('success', $msg);
                                                return json_encode([
                                                    'status' => 'ok',
                                                    'message' => $msg,
                                                ]);
                                            } else {
                                                return json_encode([
                                                    'statut' => 'ko',
                                                    'message' => 'Echec g\'enregistrement',
                                                ]);
                                            }
                                        } else {
                                            $msg = 'Veuillez renseigner une dates valides';
                                            return json_encode([
                                                'status' => 'ko',
                                                'message' => $msg,
                                            ]);
                                        }
                                    } else {
                                        $msg = 'Veuillez renseigner une dates valides';
                                        return json_encode([
                                            'status' => 'ko',
                                            'message' => $msg,
                                        ]);
                                    }
                                } else {
                                    $msg = 'Veuillez renseigner une dates valides';
                                    return json_encode([
                                        'status' => 'ko',
                                        'message' => $msg,
                                    ]);
                                }
                            } else {
                                $msg = 'Frais de formation invalide, les frais de formation ne peuvent pas être moins de zéro Fr CFA';
                                return json_encode([
                                    'status' => 'ko',
                                    'message' => $msg,
                                ]);
                            }
                        }


                        if ($decision_brouillon == null) {
                            $msg = 'Veuillez renseigner les champs obligatoires';
                            return json_encode([
                                'status' => 'ko',
                                'message' => $msg,
                            ]);
                        }
                    }
                } else if ($all_data['type_action'] == 'UPDATE') {


                    $model = Formation::findOne(['key_formation' => $all_data['key_formation']]);
                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->updated_by = Yii::$app->user->identity->id;

                    $model->idSpectForm = $all_data['specialite'];
                    $model->libelle = $all_data['libelle'];
                    $model->frais = $all_data['frais'];
                    $model->descriptions = $all_data['descriptions'];
                    $model->date_debut = $all_data['date_debut'];
                    $model->date_fin = $all_data['date_fin'];
                    $model->save();


                    if ($model->save()) {
                        $msg = 'Formation modifiée avec succès';
                        Yii::$app->session->setFlash('success', $msg);
                        return json_encode([
                            'status' => 'ok',
                            'message' => $msg,
                        ]);
                    } else {
                        $msg = 'Echec d\'enregistrement, veuillez réessayé plus tard';
                        Yii::$app->session->setFlash('error', $msg);
                        return json_encode([
                            'status' => 'ko',
                            'message' => $msg,
                        ]);
                    }
                }
            }
        } else {
            return $droit_formation;
        }
    }

    /**
     * Updates an existing Formation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            $model = $this->getModelbykey($key);

            if (Yii::$app->request->post()) {

                if ($model->load($this->request->post())) {

                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->cloture = true;
                    $model->key_formation = Yii::$app->security->generateRandomString(32);

                    $existant = $model->libelle;
                    $donnee = Formation::find()->where(['libelle' => $existant, 'statut' => 1])->one();
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
     * Deletes an existing Formation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            //  $model = $this->getModelbykey($key);
            $model = Formation::findOne(['key_formation' => $key]);
            if ($model != null) {

                $model->updated_at = date('Y-m-d H:i:s');
                $model->updated_by = Yii::$app->user->identity->id;
                $model->statut = 3;
                $model->save();

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Formation supprimée avec succès!');
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Echec de suppression !');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Echec !');
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
        }
    }

    public function actionDeletepro($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            //  $model = $this->getModelbykey($key);
            $model = Formation::findOne(['key_formation' => $key]);
            if ($model != null) {

                $model->updated_at = date('Y-m-d H:i:s');
                $model->updated_by = Yii::$app->user->identity->id;
                $model->statut = 3;
                $model->save();

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Formation supprimée avec succès!');
                    return json_encode([
                        'statut' => 'ko',

                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Echec de suppression !');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Echec !');
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
        }
    }


    public function actionClose_formation($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {

            $model = $this->getModelbykey($key);

            // if (Yii::$app->request->post()) {

            if ($model != null) {

                $model->updated_at = date('Y-m-d H:i:s');
                $model->updated_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->cloture = 0;
                $model->save();

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Formation clôturée avec succès!');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Echec de clôture !');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Echec !');
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Action non autorisée');
        }
    }




    public function actionDelete_memomatiere($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            $model = Memomatiere::findOne(['key_memomatiere' => $key]);
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



    /**
     * Finds the Formation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Formation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Formation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getModelbykey($key)
    {

        $formation = Formation::findOne([
            'key_formation' => $key
        ]);

        if ($formation != null) {
            return $formation;
        }
        return null;
    }
}
