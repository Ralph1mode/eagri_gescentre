<?php

namespace backend\controllers;

use backend\models\Matiere;
use backend\models\MatiereSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MatiereController implements the CRUD actions for Matiere model.
 */
class MatiereController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                /*   'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ], */]
        );
    }

    /**
     * Lists all Matiere models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $droit_matiere = Utils::have_access('manage_lessons');
        if ($droit_matiere == 1) {

            $searchModel = new MatiereSearch();
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
     * Displays a single Matiere model.
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
     * Creates a new Matiere model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $droit_matiere = Utils::have_access('manage_lessons');
        if ($droit_matiere == 1) {
            $model = new Matiere();

            if (Yii::$app->request->post()) {
                /* if ($model->load($this->request->post()) && $model->save()) */
                if ($model->load($this->request->post())) {
                    if($model->descriptions == ""){
                        $model->descriptions = "Aucune description";
                    }
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_matiere = Yii::$app->security->generateRandomString(32);
                    $model->libelle = trim($model->libelle);
                    $existant = $model->libelle;
                    $donnee = Matiere::find()->where(['libelle' => $existant, 'statut' => 1])->one();
                    if ($donnee != null) {
                        Yii::$app->getSession()->setFlash('error', 'La matière existe déjà !');
                        $model->loadDefaultValues();
                    } else {

                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect(['index']);
                        } else {
                            Yii::$app->getSession()->setFlash('error', 'Veuillez bien remplir les champs !');
                            $model->loadDefaultValues();
                        }
                    }
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

    /**
     * Updates an existing Matiere model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($key)
    {
        $droit_matiere = Utils::have_access('manage_lessons');
        if ($droit_matiere == 1) {
            $model2 = new Matiere();
            $model2->load($this->request->post());
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->statut = 1;
            $model2->key_matiere = Yii::$app->security->generateRandomString(32);
            $model2->libelle = trim($model2->libelle);
            $model = $this->getModelbykey($key);

            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                $id = $model->id;
                $libelle = $model2->libelle;
                $libelleFind = Matiere::find()
                    ->where(['libelle' => $libelle, 'statut' => 1])
                    ->andWhere(['<>', 'id', $id])->all();

                if ($libelleFind == null) {
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {

                        Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                        return $this->redirect('all_matiere');
                    } else {
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'La matière existe déjà !');
                    $model->loadDefaultValues();
                }
            } else {
                return $this->redirect(['/all_matiere']);
            }

            return $this->render('update', [
                'model' => $model,

            ]);
        } else {
            return $this->redirect('index');
        }
    }




    /**
     * Deletes an existing Matiere model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key)
    {
        $droit_matiere = Utils::have_access('manage_lessons');
        if ($droit_matiere == 1) {
            $model = $this->getModelbykey($key);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    return $this->redirect(['/all_matiere']);
                } else {
                    return $model->getErrors('Matière introuvable!');
                }
            } else {
                return $this->redirect(['/all_matiere']);
            }
        } else {
            return $this->redirect('index');
        }
    }

    public function actionDelete_matiere($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if ($droit_formation == 1) {
            $model = Matiere::findOne(['key_matiere' => $key]);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Matière supprimée avec succès!');
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
     * Finds the Matiere model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Matiere the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Matiere::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getModelbykey($key)
    {

        $matiere = Matiere::findOne([
            'key_matiere' => $key
        ]);

        if ($matiere != null) {
            return $matiere;
        }
        return null;
    }
}
