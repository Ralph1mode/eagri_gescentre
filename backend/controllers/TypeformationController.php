<?php

namespace backend\controllers;

use backend\models\TypeFormation;
use backend\models\TypeformationSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypeformationController implements the CRUD actions for TypeFormation model.
 */
class TypeformationController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                /* 'access' => [
                    'class' => AccessControl::className(),
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'allow' => true,
                    ],
                ], */]
        );
    }

    /**
     * Lists all TypeFormation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $droit_read_typeform = Utils::have_access('manage_type_formation');
        if ($droit_read_typeform == 1) {

            $searchModel = new TypeformationSearch();
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
     * Displays a single TypeFormation model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key)
    {
        $droit_read_typeform = Utils::have_access('manage_type_formation');
        if ($droit_read_typeform == 1) {

            return $this->render('view', [
                'model' => $this->getModelbykey($key),

            ]);
        } else {
            return $this->redirect('index');
        }
    }


    /**
     * Creates a new TypeFormation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $droit_create_typeform = Utils::have_access('manage_type_formation');
        if ($droit_create_typeform == 1) {

            $model = new TypeFormation();

            if (Yii::$app->request->post()) {

                if ($model->load($this->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_typeformation = Yii::$app->security->generateRandomString(32);
                    $model->libelle = trim($model->libelle);
                    $existant = $model->libelle;
                    $donnee = TypeFormation::find()->where(['libelle' => $existant, 'statut' => 1])->one();


                    if ($donnee == null) {
                        if ($model->save()) {

                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect('all_typeformation');
                        } else {
                            Yii::$app->getSession()->setFlash('error', 'Veuillez bien remplir les champs !');
                            $model->loadDefaultValues();
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Le type de formation existe déjà !');
                        $model->loadDefaultValues();
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
     * Updates an existing TypeFormation model.
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
        $droit_update_typeform = Utils::have_access('manage_type_formation');
        if ($droit_update_typeform == 1) {

            $model2 = new Typeformation();
            $model2->load($this->request->post());
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->statut = 1;
            $model2->key_typeformation = Yii::$app->security->generateRandomString(32);
            $model2->libelle = trim($model2->libelle);
            $model = $this->getModelbykey($key);

            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                $id = $model->id;
                $libelle = $model2->libelle;
                $libelleFind = TypeFormation::find()
                    ->where(['libelle' => $libelle, 'statut' => 1])
                    ->andWhere(['<>', 'id', $id])->all();

                if ($libelleFind == null) {
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {

                        Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                        return $this->redirect('all_typeformation');
                    } else {

                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Le type de formation existe déjà !');
                }
            } else {
                return $this->redirect(['/all_typeforation']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Deletes an existing TypeFormation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*     public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    } */

    public function actionDelete($key)
    {
        $droit_delete_typeform = Utils::have_access('manage_type_formation');
        if ($droit_delete_typeform == 1) {
            $model = TypeFormation::findOne(['key_typeformation' => $key]);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Type de formation supprimée avec succès!');
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
     * Finds the TypeFormation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TypeFormation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TypeFormation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getModelbykey($key)
    {

        $Typeformation = Typeformation::findOne([
            'key_typeformation' => $key
        ]);

        if ($Typeformation != null) {
            return $Typeformation;
        }
        return null;
    }
}
