<?php

use common\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Profil */

$this->title = 'Update Profil: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profils', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>PROFILS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_matiere">Liste des profils</a></li>
                <li class="breadcrumb-item active">Modification</li>
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
                            <div class="profil-update">

                                <h1><?= Html::encode($this->title) ?></h1>

                                <?= $this->render('_form', [
                                    'model' => $model,
                                ]) ?>

                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>