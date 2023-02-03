<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Evaluation */

// $this->title = $model->libelle;
$this->params['breadcrumbs'][] = ['label' => 'Evaluations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>EVALUATIONS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_evaluation">Liste des évaluations</a></li>
                <li class="breadcrumb-item active"><a href="#">Détails</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <div class="evaluation-view">

                                <h1><?= Html::encode($this->title) ?></h1>

                                <p>
                                    <?= Html::a(' Modifier', ['update', 'key' => $model->key_eval], ['class' => 'btn btn-primary fa fa-pencil-square fa-8x']) ?>
                                    <?= Html::a(' Supprimer', ['delete', 'key' => $model->key_eval], [

                                        'class' => 'btn btn-danger fa fa-trash-o fa-8x', "data-toggle" => "modal", "data-target" => "#exampleModalCenter",
                                        'onClick' => 'delete_element(\'' . $model->key_eval . '\')',
                                        'data' => [
                                            'confirm' => 'Etes vous sur de vouloir supprimer cette évaluation ?',
                                            'method' => 'post',
                                        ],

                                    ]) ?>
                                </p>

                                <?= DetailView::widget([
                                    'model' => $model,

                                    'options' => [
                                        'class' => ' table-responsive table ',
                                    ],
                                    'attributes' => [

                                        [
                                            'label' => 'Type d\'évaluation',
                                            'value' => function ($data) {
                                                return $data->idTypeevaluation0->libelle;
                                            }
                                        ],
                                        [
                                            'label' => 'Formation',
                                            'value' => function ($data) {
                                                return $data->idFormation0->libelle;
                                            }
                                        ],
                                        [
                                            'label' => 'Spécialité',
                                            'value' => function ($data) {
                                                return $data->idFormation0->idSpectForm0->idSpecialite0->libelle;
                                            }
                                        ],
                                        [
                                            'label' => 'Type de formation',
                                            'value' => function ($data) {
                                                return $data->idFormation0->idSpectForm0->idTypeformation0->libelle;
                                            }
                                        ],
                                        [

                                            'label' => 'date de déroulement',
                                            'format' => ['date', 'php:d-m-Y'],
                                            'attribute' => 'ladate',
                                        ],
                                      
                                        // 'ladate',
                                        //'nb_note',
                                        'h_debut',
                                        'h_fin',
                                        // 'idTypeevaluation',
                                        // 'idFormation',
                                        //'nb_note',
                                        //'ladate',
                                        //'h_debut',
                                        //'h_fin',
                                        //'key_eval',
                                        //'created_by',
                                        //'updated_by',
                                        //'created_at',
                                        //'updated_at',
                                        //'statut',
                                    ],
                                ]) ?>

                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>



<!-- Modal Delete Memo matiere -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDeleteContent">
                ...
            </div>
            <input type="hidden" value="" id="keyTypeeval">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_element()">Valider</button>
            </div>
        </div>
    </div>
</div>





<script>
    function showUpdateModal(key_memomatiere, nbr_heure) {
        document.getElementById('key_memomatiere').value = key_memomatiere;
        document.getElementById('memo_matiere_nbr_h').value = nbr_heure;
    }

    function saveUpdateMatiere() {
        let = document.getElementById('key_memomatiere').value;
        let nbr_heure = document.getElementById('memo_matiere_nbr_h').value;
        if (nbr_heure != '' && nbr_heure > 0) {
            let url = "<?= Yii::$app->homeUrl ?>update_memomatiere";
            $.ajax({
                url: url,
                method: "post",
                data: {
                    key_memomatiere: key_memomatiere,
                    nbr_heure: nbr_heure,
                },
                success: function(result) {
                    document.location.href = "<?php Yii::$app->homeUrl ?>all_evaluation";
                }
            });
        } else {
            document.getElementById('modalAlertContent').innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                'Veuillez renseigner un nombre d\'heure valide' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
        }
    }

    function delete_element(key_element) {
        document.getElementById('keyTypeeval').value = key_element;
        document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de supprimer cette évaluation';
    }

    function vdelete_element() {
        var url = "<?= Yii::$app->homeUrl ?>delete_evaluationf";
        var key_element = document.getElementById('keyTypeeval').value;
        $.ajax({
            url: url,
            method: "get",
            data: {
                key: key_element,
            },
            success: function(result) {
                document.location.href = "<?php Yii::$app->homeUrl ?>all_evaluation";
            }
        });
    }
</script>