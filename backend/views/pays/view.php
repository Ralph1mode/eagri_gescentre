<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pays */

$this->title = $model->libelle;
$this->params['breadcrumbs'][] = ['label' => 'Pays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Les pays</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="#">Pays</a></li>
                <li class="breadcrumb-item active"><a href="all_pays">Liste des pays</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <div class="pays-view">

                                <h1><?= Html::encode($this->title) ?></h1>

                                <p>
                                    <?= Html::a(' Modifier', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-rounded fa fa-pencil-square fa-8x']) ?>
                                    <?= Html::a(' Supprimer', ['delete', 'id' => $model->id], [
                                        'class' => 'btn btn-danger btn-rounded fa fa-trash-o fa-8x',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                            'class' => 'sweetalert mt-5',
                                        ],
                                    ]) ?>
                                </p>

                                <?= DetailView::widget([
                                    'model' => $model,
                                    'class' => 'table',
                                    'attributes' => [
                                        //'id',
                                        'libelle',
                                        'code',
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