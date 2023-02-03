<?php

use backend\models\Apprenant;
use backend\models\Inscription;
use backend\models\Payement;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */   
/* @var $model backend\models\Apprenant */

$this->title = $model->nom . ' ' . $model->prenom;
$this->params['breadcrumbs'][] = ['label' => 'Apprenants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$formatter = \Yii::$app->formatter;

$apprenant = Apprenant::find()->where(['statut' => 1, 'nom' => $model->nom, 'prenom' => $model->prenom])->one();
$inscription = Inscription::find()->where(['statut' => 1, 'idApprenant' => $model->id])->one();
$Payement = Payement::find()->where(['statut' => 1, 'idInscription' => $inscription->id])->one();

?>

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>APPRENANTS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_apprenant">Liste des apprenants</a></li>
                <li class="breadcrumb-item active">Détails</li>
            </ol>
        </div>
    </div>

    <?= Alert::widget() ?>
    <div class="formation-view">
        <div class="col-sm-6 p-md-0 list-group list-group-flush">
        </div>
        <div class="row">
            <div class="col-xl-3 col-xxl-4 col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="text-center p-3 overlay-box" style="background-image: url(template/images/img1.jpg);">
                                <div class="profile-photo">
                                    <?php
                                    if ($model->nom == null) { ?>
                                        <img src="" width="40%" class="img-fluid rounded-circle" alt="">
                                    <?php } ?>
                                    <?php
                                    if ($model->nom != null) { ?>
                                    <a href="uploads/photos/<?php echo $apprenant->chem_photo ?>">

                                        <img src="uploads/photos/<?php echo $apprenant->chem_photo ?>" width="40%" class="img-fluid rounded-circle" alt="">
                                    </a>
                                    <?php } ?>
                                </div>
                                <h3 class=" text-white"><?= Html::encode($this->title) ?><br>Inscrit pour la formation suivante:</h3>

                            </div>
                            <ul class="list-group list-group-flush">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'options' => [

                                        'class' => ' table-responsive table primary-table-bg-hover',
                                    ],
                                    'attributes' => [
                                        [
                                            'label' => 'Formation',
                                            'value' => $inscription->idFormation0->libelle

                                        ],
                                        [
                                            'label' => 'Type de formation',
                                            'value' => $inscription->idFormation0->idSpectForm0->idTypeformation0->libelle

                                        ],
                                        [
                                            'label' => 'Spécialité',
                                            'value' => $inscription->idFormation0->idSpectForm0->idSpecialite0->libelle

                                        ],
                                        [
                                            'label' => 'Frais de formation',
                                            'value' => $inscription->idFormation0->frais . ' CFA'

                                        ],
                                        [
                                            'label' => 'Déjà payé',
                                            'value' => $Payement->montant_paye . ' CFA'

                                        ],
                                        [
                                            'label' => 'Moyenne de payement',
                                            'value' => $Payement->moypay

                                        ],

                                        
                                        //  'id',
                                        //'idPays',
                                        //'nom',
                                        //'prenom',
                                        //'sexe',
                                        //'datenaisse',
                                        //'email:email',
                                        //'tel',
                                        //'niveau',
                                        //'profession',
                                        //'chem_photo:ntext',
                                        //'chem_piece:ntext',
                                        //'chem_diplome:ntext',
                                        // 'key_apprenant',
                                        // 'created_by',
                                        // 'updated_by',
                                        // 'created_at',
                                        //'updated_at',
                                        //'statut',
                                    ],
                                ]) ?>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-9 col-xxl-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">

                                <div class="tab-content">
                                    <div id="about-me" class="tab-pane fade active show">
                                        <div class="profile-personal-info pt-4">
                                            <h4 class="text-primary mb-4">A propos de <?= Html::encode($this->title) ?></h4>
                                            <div class="row mb-4">
                                                <div class="card-body">
                                                    <p>
                                                        <?= Html::a(' Modifier', ['update', 'key' => $model->key_apprenant], ['class' => 'btn btn-primary fa fa-pencil-square fa-8x']) ?>
                                                        <!--  <= Html::a(' Supprimer', ['delete', 'key' => $model->key_apprenant], [
                                                            'class' => 'btn btn-danger fa fa-trash-o fa-8x',
                                                            "data-toggle" => "modal", "data-target" => "#exampleModalCenter",
                                                            'onClick' => 'delete_element(\'' . $model->key_apprenant . '\')',
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],
                                                        ]) ?> -->
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-responsive-sm" style="min-width: 845px">
                                                            <?= DetailView::widget([
                                                                'model' => $model,
                                                                'attributes' => [

                                                                    //  'id',
                                                                    'nom',
                                                                    'prenom',
                                                                    [
                                                                        'label' => 'Pays de provenance',
                                                                        'value' => function ($data) {
                                                                            return $data->idPays0->libelle;
                                                                        },

                                                                    ],

                                                                    'sexe',
                                                                    [
                                                                        'label' => 'Date de naissance',
                                                                        'attribute' => 'datenaisse',
                                                                        'format' => ['date', 'php:d-m-Y']

                                                                    ],


                                                                    'email:email',
                                                                    'tel',
                                                                    'niveau',
                                                                    'profession',
                                                                    //'chem_photo:ntext',
                                                                    //'chem_piece:ntext',
                                                                    [

                                                                        'attribute' => 'chem_photo',
                                                                        'value' => function ($model) {
                                                                            return Html::a(
                                                                                $model->chem_piece,
                                                                                ['uploads/photos/' . $model->chem_photo],
                                                                                [
                                                                                    'title' => 'View',
                                                                                ]
                                                                            );
                                                                        },
                                                                        'format' => 'raw',
                                                                    ],

                                                                    [

                                                                        'attribute' => 'chem_piece',
                                                                        'value' => function ($model) {
                                                                            return Html::a(
                                                                                $model->chem_piece,
                                                                                ['uploads/pieces/' . $model->chem_piece],
                                                                                [
                                                                                    'title' => 'View',
                                                                                ]
                                                                            );
                                                                        },
                                                                        'format' => 'raw',
                                                                    ],
                                                                    [

                                                                        'attribute' => 'chem_diplome',
                                                                        'value' => function ($model) {
                                                                            return Html::a(
                                                                                $model->chem_piece,
                                                                                ['uploads/diplomes/' . $model->chem_diplome],
                                                                                [
                                                                                    'title' => 'View',
                                                                                    'Attr.AllowedFrameTargets' => ['_blank'],
                                                                                ],
                                                                                ['Attr.AllowedFrameTargets' => ['_blank']]
                                                                            );
                                                                        },
                                                                        'format' => 'raw',
                                                                    ],
                                                                    // 'key_apprenant',
                                                                    // 'created_by',
                                                                    // 'updated_by',
                                                                    // 'created_at',
                                                                    //'updated_at',
                                                                    //'statut',
                                                                ],
                                                            ]) ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Delete Memo matiere -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterDel" aria-hidden="true">
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
            <input type="hidden" value="" id="keyappr">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_element()">Valider</button>
            </div>
        </div>
    </div>
</div>

<script>
    function delete_element(key_element) {
        document.getElementById('keyappr').value = key_element;
        document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de supprimer cet apprenant, cette action est irréverssible';
    }

    function vdelete_element() {
        var url = "<?= Yii::$app->homeUrl ?>delete_apprenant";
        var key_element = document.getElementById('keyappr').value;
        $.ajax({
            url: url,
            method: "get",
            data: {
                key: key_element,
            },
            success: function(result) {
                document.location.reload();
            }
        });
    }
</script>