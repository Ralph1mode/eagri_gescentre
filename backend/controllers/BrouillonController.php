<?php

namespace backend\controllers;

use backend\models\Apprenant;
use backend\models\Brouillon;
use backend\models\BrouillonSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BrouillonController implements the CRUD actions for Brouillon model.
 */
class BrouillonController extends Controller
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
     * Lists all Brouillon models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BrouillonSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brouillon model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }






    /*  public function actionSave_brouillon()
    {
      /*   $droit_create_spectform = Utils::have_access('manage_specialite_formation');
        if ($droit_create_spectform == 1) { 

            if (Yii::$app->request->isPost) {
                $all_data = Yii::$app->request->post();

                if ($all_data['type_action'] == "CREATE") {
                    $model = new Brouillon();
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_brouillon = Yii::$app->security->generateRandomString(32);
                } else if ($all_data['type_action'] == "UPDATE") {
                    $model = Brouillon::findOne(['key_spectform' => $_GET['key']]);
                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->updated_by = Yii::$app->user->identity->id;
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
                    if ($i == sizeof($all_data) - 1) {
                        $msg = 'Paramétrage effectué avec succès';
                        Yii::$app->session->setFlash('success', $msg);
                        return json_encode([
                            'status' => 'ok',
                            'message' => $msg,
                        ]);
                    }
                }

                $model->idTypeformation = $all_data['typeformation'];
                $model->idSpecialite = $all_data['specialite'];

                $existant = $model->idTypeformation;
                $existant2 = $model->idSpecialite;
                $donnee = Brouillon::find()->where(['idTypeformation' => $existant, 'idSpecialite' => $existant2, 'statut' => 1])->one();
                if ($donnee != "") {
                    if ($all_data['type_action'] == "CREATE") {
                        return 'koo';
                    } else if ($all_data['type_action'] == "UPDATE") {
                        if ($model->id != $donnee->id) {
                            return 'koo1';
                        }
                    }
                } else {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'successful');
                        return 'ok';
                    } else {
                        Yii::$app->session->setFlash('error', json_encode($model->getErrors()));
                        $model->loadDefaultValue();
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', 'aucune donnee recu en post');
                return 'ko';
            }
         } else {
            return $droit_create_spectform;
        } 
    } */

    /**
     * Creates a new Brouillon model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Brouillon();

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

    /**
     * Updates an existing Brouillon model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Brouillon model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Brouillon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Brouillon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brouillon::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }




}
