<?php

namespace backend\controllers;

use backend\models\Brouillon;
use backend\models\Matiere;
use backend\models\Specialite;
use backend\models\SpecialiteSearch;
use backend\models\Spectform;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpecialiteController implements the CRUD actions for Specialite model.
 */
class SpecialiteController extends Controller
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
     * Lists all Specialite models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $droit_read_specialite = Utils::have_access('manage_specialite');
        if ($droit_read_specialite == 1) {

            $searchModel = new SpecialiteSearch();
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
     * Displays a single Specialite model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    } */
    public function actionView($key)
    {
        return $this->render('view', [
            'model' => $this->getModelbykey($key),
        ]);
    }

    /**
     * Creates a new Specialite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */


    public function actionCreate()
    {
        $droit_create_specialite = Utils::have_access('manage_specialite');
        if ($droit_create_specialite == 1) {
            $model = new Specialite();
            if (Yii::$app->request->post()) {
                /* if ($model->load($this->request->post()) && $model->save()) */
                if ($model->load($this->request->post())) {
                    if ($model->descriptions == "") {
                        $model->descriptions = "Aucune description";
                    }
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_specialite = Yii::$app->security->generateRandomString(32);
                    $model->libelle = trim($model->libelle);

                    $existant = $model->libelle;
                    $donnee = Specialite::find()->where(['libelle' => $existant, 'statut' => 1])->one();
                    if ($donnee != null) {
                        Yii::$app->getSession()->setFlash('error', 'La spécialité existe déjà !');
                        $model->loadDefaultValues();
                    } else {

                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect(['index']);
                        } else {

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
     * Updates an existing Specialite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionUpdate($id)
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
        $droit_update_specialite = Utils::have_access('manage_specialite');
        if ($droit_update_specialite == 1) {

            $model2 = new Specialite();
            $model2->load($this->request->post());
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->statut = 1;
            $model2->key_specialite = Yii::$app->security->generateRandomString(32);
            $model2->libelle = trim($model2->libelle);
            $model = $this->getModelbykey($key);

            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                $id = $model->id;
                $libelle = $model2->libelle;
                $libelleFind = Specialite::find()
                    ->where(['libelle' => $libelle, 'statut' => 1])
                    ->andWhere(['<>', 'id', $id])->all();

                if ($libelleFind == null) {
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {

                        Yii::$app->getSession()->setFlash('success', 'Modification effectuée avec succès !');
                        return $this->redirect('all_specialite');
                    } else {
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Spécialité inexistant, impossible d\'éffectuer une modification !');
                }
            } else {
                return $this->redirect(['/all_specialite']);
            }

            return $this->render('update', [
                'model' => $model,

            ]);
        } else {
            return $this->redirect('index');
        }
    }


    public function actionUpdatemat($key)
    {
        $droit_update_specialite = Utils::have_access('manage_specialite');
        if ($droit_update_specialite == 1) {
            /*chercher liste de matiere*/
            $matiere = Matiere::find()
                ->where(['statut' => 1])->all();

            //trouvons la ligne ou il y'a le key de parametre
            $model = Spectform::find()->where(['statut' => 1, 'key_spectform' => $key])->one();
            //prenon la formation dans la ligne de memomatiere
            $spectform = Brouillon::find()->where(['statut' => 1, 'idSpectForm' => $model->id])->one();

            //$model = $this->getModelbykey($key);

            $model2 = new Brouillon();
            if (Yii::$app->request->post()) {
                $model2->load($this->request->post());
                $model2->updated_at = date('Y-m-d H:i:s');
                $model2->updated_by = Yii::$app->user->identity->id;
                $model2->statut = 1;
                $model2->key_brouillon = Yii::$app->security->generateRandomString(32);
                // print_r($model2->nb_heure);
                // exit;
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                    return $this->redirect(['view', 'key' => $model->key_spectform]);
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Modification échoué, veuillez réessayé plus tard.');
                    $model->loadDefaultValues();
                }
            } else {
                //$model->loadDefaultValues();
                return $this->render('updatemat', [
                    'model' => $model,
                    'model2' => $model2,
                    'spectform' => $spectform,
                    'matiere' => $matiere,
                ]);
            }

            return $this->render('updatemat', [
                'model' => $model,
                'model2' => $model2,
                'spectform' => $spectform,
                'matiere' => $matiere,
            ]);
        } else {
            return $this->redirect('index');
        }
    }


    /**
     * Deletes an existing Specialite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    } */

    /* public function actionDelete($key)
    {
        $this->getModelbykey($key)->delete();

        return $this->redirect(['/all_specialite']);
    } */

    /*   public function actionDelete($key)
    {
        $droit_delete_specialite = Utils::have_access('manage_specialite');
        if($droit_delete_specialite == 1){

        $model = $this->getModelbykey($key);
        //$model = $this->findModel($id);
        if ($model != null) {
            $model->statut = 3;
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d H:i:s');
            
            if ($model->save()) {
                return $this->redirect(['/all_specialite']);
            } else {
                return $model->getErrors('Type de formation introuvable!');
            }
        } else {
            return $this->redirect(['/all_specialite']);
        }
    }else{
        return $this->redirect('index'); 
     } 
    } */

    public function actionDelete_mat($key)
    {
        $droit_delete_specialite = Utils::have_access('manage_specialite');
        if ($droit_delete_specialite == 1) {

            $model = $this->getModelbykey($key);
            $model = Specialite::findOne(['key_specialite' => $key]);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Spécialité supprimée avec succès!');
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
     * Finds the Specialite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Specialite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Specialite::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getModelbykey($key)
    {
        /* print_r('ok');
        exit; */
        $specialite = specialite::findOne([
            'key_specialite' => $key
        ]);

        if ($specialite != null) {
            return $specialite;
        }
        return null;
    }
}
