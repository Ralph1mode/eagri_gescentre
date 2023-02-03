<?php

namespace backend\controllers;

use backend\models\Evaluation;
use backend\models\EvaluationSearch;
use backend\models\Note;
use backend\models\TypeEvaluation;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EvaluationController implements the CRUD actions for Evaluation model.
 */
class EvaluationController extends Controller
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
     * Lists all Evaluation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) {
            $searchModel = new EvaluationSearch();
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
     * Displays a single Evaluation model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key)
    {
        $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) {

            return $this->render('view', [
                'model' => $this->getModelbykey($key),
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /*   public function actioViewnote($key)
    {
        $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) {

            $evaluation = Evaluation::find()->where(['statut' => 1])->one();
            $model = $evaluation->nb_note;
            return $this->render('note', [
                'model' => $this->getModelbykey($key),
            ]);
        } else {
            return $this->redirect('index');
        }
    } */



    /**
     * Creates a new Evaluation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) {

            $model = new Evaluation();

            if ($model->load($this->request->post())) {
                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->key_typeevaluation = Yii::$app->security->generateRandomString(32);
                $existant = $model->libelle;
                $donnee = Evaluation::find()->where(['libelle' => $existant, 'statut' => 1])->one();


                if ($donnee == null) {
                    if ($model->save()) {

                        Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                        return $this->redirect('all_typeevaluation');
                    } else {
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Le type d\'évaluation existe déjà !');
                    $model->loadDefaultValues();
                }
            } else {

                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,

            ]);
        } else {
            return $this->redirect('index');
        }
    }





    public function actionNote($key)
    {
        $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) {

            $model_evaluation = $this->getModelbykey($key);

            if (Yii::$app->request->post()) {
                $all_data = Yii::$app->request->post();
                $nbr_note = sizeof($all_data) / 2;
                for ($i = 0; $i < $nbr_note; $i++) {
                    $old_model_note = Note::findOne(['idEvaluation' => $model_evaluation->id, 'idInscription' => $all_data['inscription' . $i], 'created_by' => Yii::$app->user->identity->id]);
                    if (isset($old_model_note)) {
                        $old_model_note->libelle = (int)$all_data['note' . $i] ?? 0;
                        $old_model_note->save();
                    } else {
                        $new_model_note = new Note();
                        $new_model_note->created_at = date('Y-m-d H:i:s');
                        $new_model_note->created_by = Yii::$app->user->identity->id;
                        // $new_model_note->idUser = Yii::$app->user->identity->id;
                        $new_model_note->statut = 1;
                        $new_model_note->key_note = Yii::$app->security->generateRandomString(32);
                        $new_model_note->idEvaluation = $model_evaluation->id;
                        $new_model_note->idInscription = $all_data['inscription' . $i];
                        $new_model_note->libelle = (int)$all_data['note' . $i] ?? 0;
                        $new_model_note->save();
                    }

                    if ($i == $nbr_note - 1) {
                        Yii::$app->session->setFlash('success', 'Enregistrement des notes effectué avec succès');
                        return $this->redirect('all_evaluation');
                    }
                }
            }

            return $this->render('note', [
                'model' => $model_evaluation,
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    public function actionSeteval()
    {
        $session = Yii::$app->getSession();
        $session->set('evaluation', $_GET['evaluation']);
    }


    public function actionSaveevaluation()
    {
        $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) {
            if (Yii::$app->request->isPost) {
                $all_data = Yii::$app->request->post();
                if ($all_data['type_action'] == "CREATE") {
                    $model = new Evaluation();
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_eval = Yii::$app->security->generateRandomString(32);
                    $model->idTypeevaluation = $all_data['idTypeevaluation'];
                    $model->idFormation = $all_data['idFormation'];
                    // $model->nb_note = $all_data['nb_note'];
                    $model->ladate = $all_data['date'];
                    $model->h_debut = $all_data['heure_d'];
                    $model->h_fin = $all_data['heure_f'];
                } else if ($all_data['type_action'] == "UPDATE") {
                    $model = Evaluation::findOne(['key_evaluation' => $_GET['key']]);
                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->idTypeevaluation = $all_data['idTypeevaluation'];
                    $model->idFormation = $all_data['idFormation'];
                    // $model->nb_note = $all_data['nb_note'];
                    $model->ladate = $all_data['ladate'];
                    $model->h_debut = $all_data['heure_d'];
                    $model->h_fin = $all_data['heure_f'];
                }

                $eval_existant = $all_data['idTypeevaluation'];
                $form_existant =  $all_data['idFormation'];

              /*   if (($model->ladate > date('Y-m-d')) || ($model->ladate == date('Y-m-d'))) {
                    if ($model->h_debut < time() || $model->h_debut == time()) {
                        if ($model->h_fin > time()) {
                            if ($model->h_debut  != $model->h_fin) { */
                                $result = Evaluation::find()->where(['idTypeevaluation' => $eval_existant, 'idFormation' => $form_existant, 'statut' => 1])->one();
                                if ($result == null) {
                                    if ($model->save()) {
                                        $msg = 'Evaluation ajouté avec succès';
                                        Yii::$app->session->setFlash('success', $msg);
                                        return json_encode([
                                            'status' => 'ok',
                                            'message' => $msg,
                                        ]);
                                    } else {
                                        $msg = 'Echec d\'ajout, veuillez réessayer plus tard';
                                        Yii::$app->session->setFlash('error', $msg);
                                        return json_encode([
                                            'status' => 'ko',
                                            'message' => $msg,
                                        ]);
                                    }
                                } else if ($result != null) {
                                    if ($all_data['type_action'] == "CREATE") {

                                        $msg = 'Cette évaluation existe déjà pour la formation';
                                        Yii::$app->session->setFlash('error', $msg);
                                        return json_encode([
                                            'status' => 'ko',
                                            'message' => $msg,
                                        ]);
                                    } else if ($all_data['type_action'] == "UPDATE") {

                                        $msg = 'Evaluation modifiée ajouté avec succès';
                                        Yii::$app->session->setFlash('success', $msg);
                                        $model->loadDefaultValues();
                                        return json_encode([
                                            'status' => 'ok',
                                            'message' => $msg,
                                        ]);
                                    }
                                }
                           /*  } else {
                                $msg = 'Désolé, impossible de programmé une évaluation pour une même heure de début et de fin!';
                                Yii::$app->session->setFlash('error', $msg);
                                $model->loadDefaultValues();
                                return json_encode([
                                    'status' => 'ko',
                                    'message' => $msg,
                                ]);
                            }
                        } else {
                            $msg = 'Veuillez renseigner une heure de fin valide !';
                            Yii::$app->session->setFlash('error', $msg);
                            $model->loadDefaultValues();
                            return json_encode([
                                'status' => 'ko',
                                'message' => $msg,
                            ]);
                        }
                    } else {
                        $msg = 'Veuillez renseigner une heure de début valide !';
                        Yii::$app->session->setFlash('error', $msg);
                        $model->loadDefaultValues();
                        return json_encode([
                            'status' => 'ko',
                            'message' => $msg,
                        ]);
                    }
                } else {
                    $msg = 'Veuillez renseigner une date de déroulement valide !';
                    Yii::$app->session->setFlash('error', $msg);
                    $model->loadDefaultValues();
                    return json_encode([
                        'status' => 'ko',
                        'message' => $msg,
                    ]);
                } */
            } else {
                return $this->redirect('index');
            }
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Updates an existing Evaluation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) {

            if (Yii::$app->request->post()) {
                $all_post = Yii::$app->request->post();
                $eval = Evaluation::find()
                    ->where(['key_eval' => $all_post['key']])
                    ->one();

                if (isset($eval)) {
                    $eval->ladate = $all_post['ladate'];
                    $eval->h_debut = $all_post['h_debut'];
                    $eval->h_fin = $all_post['h_fin'];
                    $eval->updated_at = date('Y-m-d H:i:s');
                    $eval->updated_by = Yii::$app->user->identity->id;
                    $eval->key_eval = Yii::$app->security->generateRandomString(32);
                    $eval->statut = 1;
                    // print_r($all_post['Tlibelle']);exit;

                    // $typeeval->save();
                    if ($eval->save()) {
                        Yii::$app->session->setFlash('success', 'Modification effectuée avec succès');
                        return 'ok';
                    } else {
                        Yii::$app->session->setFlash('error', 'Modification échoué , veuillez réessayé plus tard');
                        return 'ko';
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Evaluation introuvable');
                    return 'ko';
                }


                /* $model2 = new Evaluation();
            $model2->load($this->request->post());
            $all_data = $model2->load($this->request->post());
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->statut = 1;
            $model2->key_eval = Yii::$app->security->generateRandomString(32);
            $model2->ladate = $all_data['ladate'];
            $model2->h_debut = $all_data['h_debut'];
            $model2->h_fin = $all_data['h_fin'];
            $model = $this->getModelbykey($all_data['key']);
            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

              
            } else {
                return $this->redirect(['/all_evaluation']);
            }

            return $this->render('update', [
                'model' => $model,
            
            ]); */
            }
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Deletes an existing Evaluation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key)
    {
        $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) {
            $model = $this->getModelbykey($key);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    return $this->redirect(['/all_evaluation']);
                } else {
                    return $model->getErrors('Evaluation introuvable!');
                }
            } else {
                return $this->redirect(['/all_evaluation']);
            }
        } else {
            return $this->redirect('index');
        }
    }

    public function actionDelete_evaluationf($key)
    {
        $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) {
            $model = Evaluation::findOne(['key_eval' => $key]);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Evaluation supprimée avec succès!');
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
     * Finds the Evaluation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Evaluation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evaluation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function getModelbykey($key)
    {

        $evaluation = Evaluation::findOne([
            'key_eval' => $key,

        ]);

        if ($evaluation != null) {
            return $evaluation;
        }
        return null;
    }
}
