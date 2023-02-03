<?php

namespace backend\controllers;

use backend\models\Apprenant;
use backend\models\Formation;
use backend\models\Inscription;
use backend\models\InscriptionSearch;
use backend\models\Note;
use QRcode;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\phpqrcode\qrlib;

// include('phpqrcode/qrlib.php');
/**
 * InscriptionController implements the CRUD actions for Inscription model.
 */
class InscriptionController extends Controller
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
     * Lists all Inscription models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $manage_carte = Utils::have_access('manage_carte');
        if ($manage_carte == 1) {
            $searchModel = new InscriptionSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            $all_inscrit = Apprenant::find()->where(['statut' => 1])->orderBy('nom')->all();


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'all_inscrit' => $all_inscrit,
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    public function actionQrcode($key)
    {
        $manage_carte = Utils::have_access('manage_carte');
        if ($manage_carte == 1) {
            $model = $this->getModelbykey($key);
            $model = Inscription::find()->where(['statut' => 1, 'key_inscription' => $key])->one();
            $code = $model->code_carte;


            $model = $this->getModelbykey($key);
            $model = Inscription::find()->where(['statut' => 1, 'key_inscription' => $key])->one();
            $code = $model->code_carte;
            $formation = Formation::find()->where(['statut' => 1, 'id' => $model->idFormation])->one();


            return $this->render('qrcode', ['code' => $code, 'model' => $model, 'key' => $model->key_inscription]);
        } else {
            return $this->redirect('index');
        }
    }




    /**
     * Displays a single Inscription model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $manage_carte = Utils::have_access('manage_carte');
        if ($manage_carte == 1) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Creates a new Inscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $manage_carte = Utils::have_access('manage_carte');
        if ($manage_carte == 1) {
            $model = new Inscription();

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
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Updates an existing Inscription model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $manage_carte = Utils::have_access('manage_carte');
        if ($manage_carte == 1) {
            $model = $this->findModel($id);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Deletes an existing Inscription model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $manage_carte = Utils::have_access('manage_carte');
        if ($manage_carte == 1) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Finds the Inscription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Inscription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inscription::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getModelbykey($key)
    {

        $inscription = Inscription::findOne([
            'key_inscription' => $key,

        ]);

        if ($inscription != null) {
            return $inscription;
        }
        return null;
    }
}
