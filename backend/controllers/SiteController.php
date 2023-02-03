<?php

namespace backend\controllers;

use backend\models\Apprenant;
use backend\models\Evaluation;
use backend\models\EvaluationSearch;
use backend\models\Formation;
use backend\models\Inscription;
use backend\models\Note;
use backend\models\Specialite;
use backend\models\TypeFormation;
use backend\models\User;
use backend\models\UserSearch;
use common\models\LoginForm;
use Yii;
// use kartik\mpdf\Pdf;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,

                    ],
                    [
                        'actions' => ['logout', 'index', 'historique', 'pdf', 'fichenote', 'listnote', 'formacheve', 'formcours', 'filtre'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /* 'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ], */
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    /*  public function actionIndex()
    {

        return $this->render('index');
    } */

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        // $model = User::find()->where(['statut' => 1]);

        // $nowYear = date('Y');

        // $total_ancien = Apprenant::find()->where(['AND',['statut' => 1], ['>', ['created_at', date('Y-m-d')]]])->one();
        $total_stud = Apprenant::find()->where(['statut' => 1])->count();
        // return $total_ancien;    





        $formation_encour = Formation::find()->where(['statut' => 1, 'cloture' => 1])->count();
        $formation_cour = Formation::find()->where(['statut' => 1, 'cloture' => 1])->all();
        $formation_cloture = Formation::find()->where(['statut' => 1, 'cloture' => 0])->count();

        $total_specialite = Specialite::find()->where(['statut' => 1])->count();
        $total_formation = TypeFormation::find()->where(['statut' => 1])->count();
        $nb = 0;
        foreach ($formation_cour as $forma_encour) {
            $total_evalu = Evaluation::find()->where(['statut' => 1, 'idFormation' => $forma_encour->id])->all();

            if ($total_evalu != null) {
                $nb += 1;
            }
            // return $nb;
        }

        $max_spect = Formation::find()->where(['statut' => 1])->max('idSpectform');
        // return $max_spect;



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'total_stud' => $total_stud,
            'formation_encour' => $formation_encour,
            'formation_cloture' => $formation_cloture,
            'total_specialite' => $total_specialite,
            'total_formation' => $total_formation,
            'nb' => $nb,
        ]);
    }



    public function actionHistorique()
    {
        if (isset($_POST['submit'])) {

            if (isset($_POST['datedebut']) && isset($_POST['datefin'])) {
                $date_debut = $_POST['datedebut'];
                $date_fin = $_POST['datefin'];

                $all_inscrit = Apprenant::find()->where(['statut' => 1])->andWhere(['>=', 'created_at', $date_debut])->andWhere(['=<', 'created_at', $date_fin])->all();
            }
        } else {
            $all_inscrit = Apprenant::find()->where(['statut' => 1])->orderBy('nom')->all();
            /*  return $this->render('historique', [
                'all_inscrit' => $all_inscrit,
            ]); */
        }
        return $this->render('historique', [
            'all_inscrit' => $all_inscrit,
        ]);
    }
    public function actionFormacheve()
    {


        /* return $this->render('formacheve', [
            'nb_inscrit' => $nb_inscrit,
        ]); */
        return $this->render('formacheve');
    }
    public function actionFormcours()
    {


        /* return $this->render('formacheve', [
            'nb_inscrit' => $nb_inscrit,
        ]); */
        return $this->render('formcours');
    }

    public function actionFichenote()
    {
        /* $all_inscrit = Apprenant::find()->where(['statut' => 1])->orderBy('nom')->all();
        return $this->render('fichenote', [
            'all_inscrit' => $all_inscrit,
        ]); */

        $searchModel = new EvaluationSearch();
        $additional = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $additional);

        return $this->render('fichenote', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListnote($key)
    {
        /*      $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) { */

        $model_evaluation = $this->getModelbykey($key);



        return $this->render('listnote', [
            'model' => $model_evaluation,
        ]);
        /* } else {
            return $this->redirect('index');
        } */
    }


    public function actionFiltre()
    {
        /*      $droit_evaluation = Utils::have_access('manage_evaluation');
        if ($droit_evaluation == 1) { */
    }



    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


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
