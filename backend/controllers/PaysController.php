<?php

namespace backend\controllers;

use backend\models\Pays;
use backend\models\PaysSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaysController implements the CRUD actions for Pays model.
 */
class PaysController extends Controller
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
                ], */
            ]
        );
    }

    /**
     * Lists all Pays models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $droit_pays = Utils::have_access('manage_country');
        if($droit_pays == 1){
        $searchModel = new PaysSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Pays::find()
                ->where([
                    'statut' => 1
                ])
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }else{
        return $this->redirect('index'); 
     }
    }

    /**
     * Displays a single Pays model.
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

    /**
     * Creates a new Pays model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $droit_pays = Utils::have_access('manage_country');
        if($droit_pays == 1){
        $model = new Pays();

        if (Yii::$app->request->post()) {
            if ($model->load($this->request->post())) {
                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->statut = 1;

                $existant = $model->libelle;
                $donnee = Pays::find()->where(['libelle' => $existant, 'statut' => 1])->one();
                if ($donnee != null) {
                    
                    $model->loadDefaultValues();
                } else {
                    
                    if ($model->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                        return $this->redirect(['index']);
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement, veuillez remplir tout les champs !');
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
    }else{
        return $this->redirect('index'); 
     }
    }

    /**
     * Updates an existing Pays model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $droit_pays = Utils::have_access('manage_country');
        if($droit_pays == 1){
        $model = $this->findModel($id);

        if (Yii::$app->request->post()) {
            if ($model->load($this->request->post())) {

                $model->updated_at = date('Y-m-d H:i:s');
                $model->updated_by = Yii::$app->user->identity->id;
                $model->statut = 1;

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                    return $this->redirect(['/all_pays']);
                } else {
                    $model->loadDefaultValues();
                }
            }
        } else {
            //$model->loadDefaultValues();
            return $this->render('update', [
                'model' => $model,
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }else{
        return $this->redirect('/index'); 
     }
    }

    /**
     * Deletes an existing Pays model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $droit_pays = Utils::have_access('manage_country');
        if($droit_pays == 1){
        $model = $this->findModel($id);
        if ($model != null) {
            $model->statut = 3;
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d H:i:s');
            
            if ($model->save()) {
                return $this->redirect(['/all_pays']);
            } else {
                return $model->getErrors('Type de formation introuvable!');
            }
        } else {
            return $this->redirect(['/all_pays']);
        }
    }else{
        return $this->redirect('/index'); 
     }
    }

    /**
     * Finds the Pays model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pays the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pays::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
