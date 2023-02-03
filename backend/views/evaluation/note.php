<?php

use backend\models\Apprenant;
use backend\models\Formation;
use backend\models\Inscription;
use backend\models\Note;
use backend\models\TypeEvaluation;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Notes des apprenants évalués en ' . $model->idTypeevaluation0->libelle;
$this->params['breadcrumbs'][] = $this->title;

$inscription = Inscription::find()->where(['statut' => 1, 'idFormation' => $model->idFormation])->all();

$all_apprenant = Apprenant::find()->where(['statut' => 1])->all();

$all_typeevaluation = TypeEvaluation::find()->where(['statut' => 1, 'id' => $model->idTypeevaluation])->one();

?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4><?= Html::encode($this->title) ?></h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_evaluation">Liste des évaluations</a></li>
                <li class="breadcrumb-item active">Notes</li>
            </ol>
        </div>
    </div>
    <?= Alert::widget() ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <div class="note-index">

                                <!-- <p> -->
                                <form action="" method="post">

                                    <!-- <button type="submit" name="submit" class="btn btn-primary fa fa-plus-square fa-8x"> Enregistrer</button> -->

                                    <!-- <= Html::a(' Enregistrer', ['/savenote'], ['name' => 'submit', 'class' => 'btn btn-primary fa fa-plus-square fa-8x']) ?> -->
                                    <!-- </p> -->

                                    <?php // echo $this->render('_search', ['model' => $searchModel]); 
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="card">

                                            <table border="2">

                                            </table>
                                            <div class="table-responsive">
                                                <table class="table primary-table-bordered">
                                                    <thead class="thead-primary">

                                                        <tr style="text-align: center;">
                                                            <th scope="col">#</th>
                                                            <th scope="col">Apprenant</th>


                                                            <th scope="col">Note</th>

                                                        </tr>


                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        foreach ($inscription as $inscriptions) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $inscriptions->idApprenant0->id ?></th>
                                                                <td>
                                                                    <center><?= $inscriptions->idApprenant0->nom . ' ' . $inscriptions->idApprenant0->prenom ?></center>
                                                                </td>
                                                                <td>
                                                                    <center>
                                                                        <div class="">
                                                                            <?php $note = Note::findOne(['idEvaluation' => $model->id, 'idInscription' => $inscriptions->id, 'created_by' => Yii::$app->user->identity->id]) ?>
                                                                            <input type="number" name="note<?= $i ?>" style="background-color:green ; color:aliceblue" id="" style="width: 20%;" value="<?= isset($note) ? $note->libelle : '' ?>">
                                                                            <input type="hidden" name="inscription<?= $i ?>" value="<?= $inscriptions->id ?>">
                                                                        </div>
                                                                    </center>

                                                                </td>

                                                            </tr>
                                                        <?php $i++;
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">

                                        </div>
                                        <div class="col-md-4">

                                        </div>
                                        <div class="col-md-4">
                                            <?= Html::submitButton(' Enregistrer', ['class' => 'btn btn-primary fa fa-plus-square fa-8x pull-right']) ?>
                                        </div>
                                    </div>
                                </form>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>