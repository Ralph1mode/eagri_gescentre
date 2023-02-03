<?php

use common\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Apprenant */

$this->title = 'Modification: ' . $model->nom;
$this->params['breadcrumbs'][] = ['label' => 'Apprenants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
                            <div class="apprenant-update">
                                <input type="hidden" id="type_action" value="UPDATE">
                                <center>
                                    <h1><?= Html::encode($this->title) ?></h1>
                                </center>

                                <?= $this->render('_form', [
                                    'model' => $model,
                                ]) ?>
                            </div>
                    </div>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>