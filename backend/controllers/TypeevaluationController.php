<?php

namespace backend\controllers;

use backend\models\Typeevaluation;
use backend\models\TypeevaluationSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypeevaluationController implements the CRUD actions for Typeevaluation model.
 */
class TypeevaluationController extends Controller
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
     * Lists all Typeevaluation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $droit_typeevaluation = Utils::have_access('manage_type_evaluation');
        if ($droit_typeevaluation == 1) {
            $searchModel = new TypeevaluationSearch();
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
     * Displays a single Typeevaluation model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key)
    {
        $droit_typeevaluation = Utils::have_access('manage_type_evaluation');
        if ($droit_typeevaluation == 1) {

            return $this->render('view', [
                'model' => $this->getModelbykey($key),
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Creates a new Typeevaluation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /*  public function actionCreate()
    {
        $model = new Typeevaluation();

        if (Yii::$app->request->post()) {

            if ($model->load($this->request->post())) {

                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->key_Typeevaluation = Yii::$app->security->generateRandomString(32);
                $model->libelle = trim($model->libelle);
                //print_r('ok');exit;
                $existant = $model->libelle;
                $donnee = Typeevaluation::find()->where(['libelle' => $existant, 'statut' => 1])->one();
                if ($donnee != null) {
                    Yii::$app->getSession()->setFlash('error', 'Le type d\'évaluation existe déjà !');
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
    }
 */

    public function actionCreate()
    {
        $droit_typeevaluation = Utils::have_access('manage_type_evaluation');
        if ($droit_typeevaluation == 1) {

            if ($all_post = Yii::$app->request->post()) {
                $model = new Typeevaluation();
                $model->libelle = trim($all_post['libelle']);
                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->key_Typeevaluation = Yii::$app->security->generateRandomString(32);
                $model->statut = 1;

                $eval_existant = Typeevaluation::find()->where(['statut' => 1, 'libelle' => trim($all_post['libelle'])])->one();
                if ($eval_existant == null) {
                    $model->save();
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Type d\'évaluation ajouté avec succès');
                        return 'ok';
                    } else {
                        Yii::$app->session->setFlash('error', 'Ajout échoué , veuillez réessayé plus tard');
                        return 'ko';
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Ce type d\'évaluation existe déjà ');
                    return 'ko';
                }
            } else {

                Yii::$app->getSession()->setFlash('error', 'Une erreur est survenue. Veuillez reéssayer plus tard');
            }
        } else {
            return $this->redirect('index');
        }
    }
    /**
     * Updates an existing Typeevaluation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*    public function actionUpdate($key)
    {

        $model2 = new Typeevaluation();
        $model2->load($this->request->post());
        $model2->created_at = date('Y-m-d H:i:s');
        $model2->created_by = Yii::$app->user->identity->id;
        $model2->statut = 1;
        $model2->key_Typeevaluation = Yii::$app->security->generateRandomString(32);
        $model2->libelle = trim($model2->libelle);
        $model = $this->getModelbykey($key);

        if ($model != null) {
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d H:i:s');

            $id = $model->id;
            $libelle = $model2->libelle;
            $libelleFind = Typeevaluation::find()
                ->where(['libelle' => $libelle, 'statut' => 1])
                ->andWhere(['<>', 'id', $id])->all();

            if ($libelleFind == null) {
                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                    return $this->redirect('all_typeevaluation');
                } else {
                    $model->loadDefaultValues();
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Le type d\'évaluation existe déjà !');
            }
        } else {
            return $this->redirect(['/all_typeevaluation']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    } */

    public function actionUpdate()
    {
        $droit_typeevaluation = Utils::have_access('manage_type_evaluation');
        if ($droit_typeevaluation == 1) {
            if (Yii::$app->request->post()) {
                $all_post = Yii::$app->request->post();
                $typeeval = Typeevaluation::find()
                    ->where(['key_Typeevaluation' => $all_post['key_Typeevaluation']])
                    ->one();

                if (isset($typeeval)) {
                    $typeeval->libelle = trim($all_post['Tlibelle']);
                    $typeeval->updated_at = date('Y-m-d H:i:s');
                    $typeeval->updated_by = Yii::$app->user->identity->id;
                    $typeeval->key_Typeevaluation = Yii::$app->security->generateRandomString(32);
                    $typeeval->statut = 1;
                    // print_r($all_post['Tlibelle']);exit;

                    // $typeeval->save();
                    if ($typeeval->save()) {
                        Yii::$app->session->setFlash('success', 'Modification effectuée avec succès');
                        return 'ok';
                    } else {
                        Yii::$app->session->setFlash('error', 'Modification échoué , veuillez réessayé plus tard');
                        return 'ko';
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Type d\'évaluation introuvable');
                    return 'ko';
                }
            }
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Deletes an existing Typeevaluation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key)
    {
        $droit_typeevaluation = Utils::have_access('manage_type_evaluation');
        if ($droit_typeevaluation == 1) {
            $model = Typeevaluation::findOne(['key_Typeevaluation' => $key]);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Type d\'évaluation supprimé avec succès!');
                } else {
                    Yii::$app->getSession()->setFlash('error', json_encode($model->getErrors()));
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Une erreur est survenue. Veuillez reéssayer plus tard');
            }
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Finds the Typeevaluation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Typeevaluation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Typeevaluation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getModelbykey($key)
    {

        $Typeformation = Typeevaluation::findOne([
            'key_Typeevaluation' => $key
        ]);

        if ($Typeformation != null) {
            return $Typeformation;
        }
        return null;
    }
}
