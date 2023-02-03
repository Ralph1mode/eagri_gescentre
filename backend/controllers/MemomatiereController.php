<?php

namespace backend\controllers;

use backend\models\Memomatiere;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemomatiereController implements the CRUD actions for Memomatiere model.
 */
class MemomatiereController extends Controller
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
     * Lists all Memomatiere models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Memomatiere::find(),
            
            'pagination' => [
                'pageSize' => 20
            ],
           /*  'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ], */
           
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Memomatiere model.
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
     * Creates a new Memomatiere model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Memomatiere();

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
     * Updates an existing Memomatiere model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
   /*  public function actionUpdate($key)
    {
        $model = $this->getModelbykey($key);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'key_memomatiere' => $model->key_memomatiere]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    } */


    public function actionUpdate($key)
    {
        $droit_formation = Utils::have_access('manage_formation');
        if($droit_formation == 1){
        $model = $this->getModelbykey($key);

        if (Yii::$app->request->post()) {
            if ($model->load($this->request->post())) {

                $model->updated_at = date('Y-m-d H:i:s');
                $model->updated_by = Yii::$app->user->identity->id;
                $model->statut = 1;

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                    return $this->redirect(['/all_formation']);
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
     * Deletes an existing Memomatiere model.
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


   /*  public function actionDelete($key)
    {
        
        $model = $this->getModelbykey($key);

        if (Yii::$app->request->post()) {
            if ($model->load($this->request->post())) {

                $model->updated_at = date('Y-m-d H:i:s');
                $model->updated_by = Yii::$app->user->identity->id;
                $model->statut = 3;

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                    return $this->redirect(['view', 'key_formation' => $model->idFormation0->key_formation]);
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
    
    } */

    /**
     * Finds the Memomatiere model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Memomatiere the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Memomatiere::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
