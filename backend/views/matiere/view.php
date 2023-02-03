<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Matiere */

$this->title = $model->libelle;
$this->params['breadcrumbs'][] = ['label' => 'Matieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>MATIERES</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_matiere">Matières</a></li>
                <li class="breadcrumb-item active">Détails</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <div class="matiere-view">

                                <h1><?= Html::encode($this->title) ?></h1>

                                <p>
                                    <?= Html::a(' Modifier', ['update', 'key' => $model->key_matiere], ['class' => 'btn btn-primary btn-rounded fa fa-pencil-square fa-8x']) ?>
                                    <?= Html::a(' Supprimer', ['delete', 'key' => $model->key_matiere], [
                                        'class' => 'btn btn-danger btn-rounded fa fa-trash-o fa-8x',
                                        'data' => [
                                            'confirm' => 'Voulez-vous vraiment supprimer cette matiere ?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </p>

                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        //'id',
                                        'libelle',
                                        'descriptions',
                                        //'key_matiere',
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