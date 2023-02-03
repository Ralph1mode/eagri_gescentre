<?php

use backend\models\Fonctionnalite;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Profil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--  <= $form->field($model, 'libelle')->textInput(['maxlength' => true]) ?>

    <= $form->field($model, 'key_profil')->textInput(['maxlength' => true]) ?>

    <= $form->field($model, 'created_by')->textInput() ?>

    <= $form->field($model, 'updated_by')->textInput() ?>

    <= $form->field($model, 'created_at')->textInput() ?>

    <= $form->field($model, 'updated_at')->textInput() ?>

    <= $form->field($model, 'statut')->textInput() ?>

    <div class="form-group">
        <= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div> -->



    <?= Alert::widget() ?>
    <div id="alert_place" class="content"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">


                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" id="type_action" value="UPDATE">
                        <div class="memomatiere-form">

                            <?php $form = ActiveForm::begin(); ?>

                            <div class=" text-white bg-primary">
                                <table class="table primary-table-bg-hover">
                                    <div id="alert_place" class="content"></div>
                                    <tr>
                            </div>
                            <td>
                                <label class="form-label">
                                    <h5>Libellé:<span class="text-danger">**</span></h5>
                                </label>
                                <div class="form-group">
                                    <?= $form->field($model, 'libelle')->textInput(['maxlength' => true, 'required' => true,])->label(false) ?>
                                </div>

                            </td>
                            <td>
                                <label class="form-label">
                                    <h5>Fonctionnalité:<span class="text-danger">**</span></h5>
                                </label>
                                <?= Html::dropDownList(
                                    'idDetail',
                                    null,
                                    ArrayHelper::map(
                                        Fonctionnalite::find()->where(['statut' => 1])->all(),
                                        'id',
                                        'libelle',
                                    ),
                                    ['prompt' => 'Choisir une fonctionnalité', 'class' => 'form-control', 'required' => true, 'id' => 'selectFonctionnalite'],
                                );
                                ?>
                            </td>
                            <td>
                                <textarea name="all_detail_added" id="all_detail_added" cols="30" rows="10" style="display: none;"></textarea>
                            <td>
                                <button type="button" class=" btn btn-dark fa fa-plus-square fa-8x" onclick="add_profil_fonctionnalite()"> Ajouter</button>
                            </td>

                            </tr>
                        </div>
                    </div>
                </div>
            </div>
            </table>
            <table class="table table-bordered" id="tab_temp_preview">

                <thead class="thead-primary">
                    <tr>
                        <th scope="col">Fonctionnalité</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="rows">
                </tbody>
            </table>
            <div class="form-group">
                <center>
                    <form action="">
                        <button type="reset" class="btn btn-dark btn-lg fa fa fa-undo fx-8"> Annuler</button>
                    </form>
                    <input type="button" value="Valider" class="btn btn-primary btn-lg " onclick="save_profil()">
                </center>
            </div>
            <?php ActiveForm::end(); ?>
            <textarea name="" id="all_detail_added" cols="30" rows="10" style="display: none;"></textarea>


        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
<script>
    function add_profil_fonctionnalite() {
        var fonctionnalite = $('#selectFonctionnalite').val();
        var fonctionnalite_text = $("#selectFonctionnalite option:selected").text();

        if (fonctionnalite != '') {
            var status = '000';

            var old_detail_added = $("#all_detail_added").val();
            var search_position = old_detail_added.search('###' + fonctionnalite);

            if (search_position >= 0) {
                msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                    ' Ce détail est déjà ajouté à la liste </div> </div>';
                $('#alert_place').show();
                $('#alert_place').html(msg);
            } else {

                var new_data = fonctionnalite;

                $("#all_detail_added").val(old_detail_added + '###' + new_data + '*');


                var newCell = document.createElement("td");
                var newCell1 = document.createElement("td");


                newCell.innerHTML = fonctionnalite_text;
                newCell1.innerHTML = '<i class="fa fa-trash" style="color:red" onclick="delete_detail(\'' + new_data + '\', this)"></i>';


                var newRow = document.createElement("tr");

                newRow.append(newCell);
                newRow.append(newCell1);


                document.getElementById("rows").appendChild(newRow);

                document.getElementById('selectFonctionnalite').value = '';



                msg = '<div class="alert alert-success alert-dismissible show fade" style="margin-bottom: 30px">' +
                    '<div class="alert-body">' +
                    'Détail ajouté avec succès' +
                    '</div>' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';




                $('#alert_place').show();
                $('#alert_place').html(msg);

            }

        } else {
            msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' +
                '<div class="alert-body">' +
                'Veuillez renseigner les champs' +
                '</div>' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';

            $('#alert_place').show();
            $('#alert_place').html(msg);
        }
    }

    function delete_detail(data, element) {
        var correct_data = '###' + data + '*';
        var row_index = element.closest('tr').rowIndex;

        var all_detail_added = $("#all_detail_added").val();
        var res = all_detail_added.replace(correct_data, ""); // SUPPRESSION DE L'ELEMENT DANS LE CHAMP CACHE
        $("#all_detail_added").val(res);
        document.getElementById("tab_temp_preview").deleteRow(row_index); // SUPPRESSION DE L'ELEMENT DANS LE TABLEAU
    }

    function save_profil() {
        let url = "<?= Yii::$app->homeUrl ?>save_profil";
        let libelle = $('#profil-libelle').val();
        let all_detail_added = $('#all_detail_added').val();
        if (libelle != "", all_detail_added != "") {
            $.ajax({
                url: url,
                method: "get",
                data: {

                    libelle: encodeURIComponent(libelle),
                    all_detail_added: encodeURIComponent(all_detail_added),
                },
                success: function(result) {
                    if (result == "0") {
                        document.location.href = "<?= Yii::$app->homeUrl ?>";
                    } else {
                        if (result == "ok") {
                            document.location.href = "<?php Yii::$app->homeUrl ?>all_profil";
                        } else {
                            var err = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                                'Profil déjà existant !' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                                '</div>';
                            $('#alert_place_g').html(err);
                        }
                    }
                }
            });
        } else {
            var err = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                'Veuillez renseigner tous les champs obligatoire' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + '<span aria-hidden="true">&times;</span>' + '</button>' + '</div>';
            $('#alert_place_g').html(err);
        }
    }
</script>