<?php

use backend\models\Matiere;
use common\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Formation */

$this->title = 'Ajout d\'une fonctionnalité';
$this->params['breadcrumbs'][] = ['label' => 'Memomatieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                <li class="breadcrumb-item active"><a href="all_profil">Liste des profils</a></li>
                <li class="breadcrumb-item active">Ajout d'une fonctionnalité</li>
            </ol>
        </div>
    </div>
    <?= Alert::widget() ?>
    <div id="alert_place" class="content"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <div class="memomatiere-create">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h1 style="text-align: center; color:blue"><?= Html::encode($this->title) ?></h1>
                                        <input type="hidden" id="type_action" value="UPDATE">
                                        <div class="memomatiere-form">

                                            <?php $form = ActiveForm::begin(); ?>

                                            <div class=" text-white bg-primary">
                                                <table class="table primary-table-bg-hover">
                                                    <div id="alert_place" class="content"></div>
                                                    <tr>
                                            </div>
                                            <td>

                                                <div class="form-group">
                                                    <label class="form-label">
                                                        <h5>Profil :</h5>
                                                    </label>
                                                    <input type="text" size="40" value=" <?= $this->title = $profil->libelle; ?>" disabled="true" name="fee" />
                                                </div>
                                                <div class="form-group">
                                                    <?= $form->field($model, 'idFonctionnalite')->dropDownList(
                                                        ArrayHelper::map($fonctionnalite, 'id', 'libelle'),
                                                        ['prompt' => 'Choisir une fonctionnalité', 'required' => true,]
                                                    )->error(false)->label('<h5>Fonctionnalité:<span class="text-danger">**</span></h5>');
                                                    ?>
                                                </div>


                                            </td>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </table>

                        <div class="form-group">
                            <div class="card-footer">
                            </div>
                            <center>
                                <?= Html::resetButton(' Annuler', ['class' => 'btn btn-dark btn-lg fa fa fa-undo fx-8']) ?>
                                <!-- <= Html::submitButton(' Enregistrer', ['class' => 'btn btn-primary btn-lg ']) ?> -->
                                <input type="button" value="Valider" class="btn btn-primary btn-lg " onclick="validate_form()">


                            </center>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <textarea name="" id="all_detail_added" cols="30" rows="10" style="display: none;"></textarea>
                    </div>
                </div>
            </div>
            </table>
        </div>
    </div>
</div>

<script>
    function validate_form() {
        let url = "<?= Yii::$app->homeUrl ?>create_detail";
        let fonctionnalite = $("#fonctionnalite-idFonctionnalite").val();
        // let fonctionnalite = document.getElementById('fonctionnalite-idFonctionnalite').value;
        let url_string = window.location.href
        let url0 = new URL(url_string);
        key_fonctionnalite = url0.searchParams.get("key");

        if (fonctionnalite != "") {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    fonctionnalite: fonctionnalite,
                    key_fonctionnalite: key_fonctionnalite,
                }, //
                success: function(result) {
                    if (result == "0") {
                        document.location.href = "<?= Yii::$app->homeUrl ?>";
                    } else if (result == "ok") {
                        document.location.href = "<?= Yii::$app->homeUrl ?>all_profil";
                    } else {
                        document.location.reload();
                    }
                }
            });
        } else {

        }
    }
</script>