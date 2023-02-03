<?php

namespace backend\controllers;

use backend\models\Profil;
use backend\models\User;
use backend\models\UserSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        // if ($droit_user == 1) {
        /*  $searchModel = new UserSearch();
        $additional = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $additional);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); */
        // }
    }

    /**
     * Displays a single User model.
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

    /*    public function actionView($key)
    {
        $droit_user = Utils::have_access('user');
        if ($droit_user == 1) {
            return $this->render('view', [
                'model' => $this->findModelbykey($key),
            ]);
        } else {
            return $this->redirect('index');
        }
    } */

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /*   public function actionCreate()
    {
        $model = new User();

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
    } */

    /* public function actionCreate()
    {
        $droit_user = Utils::have_access('user');
        if ($droit_user == 1) {

            $profil = Profil::find()
                ->where(['statut' => 1])
                ->all();

            $model = new User();
            if (Yii::$app->request->post()) {

                if ($model->load($this->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->status = 10;
                    $model->role = 10;
                    $model->auth_key  = Yii::$app->security->generateRandomString(32);
                    $model->nom = trim($model->nom);
                    $model->prenoms = trim($model->prenoms); 
                    $model->username = trim($model->username);
                    $model->email = trim($model->email);
                    $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);

                    $nom = $model->nom;
                    $prenoms = $model->prenoms;

                    $userFind = User::find()
                        ->where([
                            'nom' => $nom,
                            'prenoms' => $prenoms,
                            'status' => 10
                        ])->one();
                    if ($userFind == null) {
                        /* print_r($model);die; 
                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect('all_user');
                        } else {
                            Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement, veuillez remplir tous les champs obligatoires !');
                            $model->loadDefaultValues();
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Utilisateur déjà existant !');
                        $model->loadDefaultValues();
                    }
                }
            } else {

                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
                'profil' => $profil,

            ]);
        } else {
            return $this->redirect('accueil');
        }
    } */


    public function actionSave_user()
    {
        $droit_user = Utils::have_access('manage_rule');
        if ($droit_user == 1) {

            /*  $profil = Profil::find()
                ->where(['statut' => 1])
                ->all(); */

            $model = new User();
            if (Yii::$app->request->isPost) {
                print_r(Yii::$app->request->isPost);exit;
                $all_data = Yii::$app->request->post();

                // if ($model->load($this->request->post())) {
                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->status = 10;
                $model->role = 10;
                $model->auth_key  = Yii::$app->security->generateRandomString(32);
                $model->username = trim($all_data['username']);
                $model->idProfil = trim($all_data['profil']);
                $model->email = trim($all_data['email']);
                $model->sexe = trim($all_data['sexe']);
                $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($all_data['password_hash']);

                $username = $model->username;

                $userFind = User::find()
                    ->where([
                        'username' => $username,
                        'status' => 10
                    ])->one();
                if ($userFind == null) {

                    if ($model->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                        return $this->redirect('all_user');
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement, veuillez remplir tous les champs obligatoires !');
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Utilisateur déjà existant !');
                    $model->loadDefaultValues();
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
                // 'profil' => $profil,

            ]);
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelbykey($key)
    {
        $model = User::find()
            ->where([
                'auth_key' => $key,
                'status' => 10
            ])->one();
        if ($model != null) {
            return $model;
        } else {
            return null;
        }
    }

    public function returnUserKey($id)
    {
        $user = User::find()->where(['id' => $id, 'status' => 10])->one();
        if ($user != null) {
            return $user->auth_key;
        }
    }

    /*    public function returnUserDemande($auth_key)
    {
        $user = User::find()->where(['auth_key' => $auth_key])->one();
        $demande = Demande::find()->where(['created_by' => $user->id, 'statut' => 1])->all();
        if ($demande != null) {
            return $demande;
        }
    } */
}
