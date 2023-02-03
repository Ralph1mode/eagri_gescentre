<?php

use backend\controllers\TypeformationController;
use backend\models\Matiere;
use backend\models\Memomatiere;
use backend\models\Specialite;
use backend\models\Spectform;
use backend\models\TypeFormation;
use PHPUnit\Util\Type;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Formation */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Formations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formation-form">
    <?php $form = ActiveForm::begin(); ?>
    <div id="alertZone" class="content"></div>
    <div class="row">
        <div class="col-lg-6">

            <input type="hidden" id="type_action" value="UPDATE">

            <?= $form->field($model, 'idSpectForm')->dropdownList(
                ArrayHelper::map(
                    Spectform::find()->where(['statut' => 1])->all(),
                    'id',
                    function ($data) {
                        return $data->idSpecialite0->libelle;
                    },
                    function ($data) {
                        return $data->idTypeformation0->libelle;
                    },
                ),
                ['prompt' => 'Choisissez la spécialité',],
                ['class' => 'form-control', 'required' => true],

            )->error(false)->label('<h5>Veuillez sélectioner une spécialité<span class="text-danger">**</span></h5>');
            ?>

            <?= $form->field($model, 'libelle')->textInput(['maxlength' => true, 'required' => true])->label('<h5>Libellé<span class="text-danger">**</span></h5>') ?>

            <?= $form->field($model, 'frais')->textInput(['required' => true, 'type' => 'number'])->label('Coût de la formation<span class="text-danger">**</span>') ?>
            <?php
            if (!(isset($_GET['key']) and $_GET['key'] != '')) {
            ?>
                <h5>Voulez-vous utiliser le brouillon ?<span class="text-danger">**</span></h5>
                <div class="btn-group">
                    <label class="btn btn-secondary" for="option1">Oui <input type="radio" class="btn-check " name="decision_brouillon" id="option" value="Oui" /></label>
                    <label class="btn btn-secondary" for="option2"><input type="radio" class="btn-check" name="decision_brouillon" id="option" value="Non" /> Non</label>
                </div>
            <?php } ?>
            </p>
        </div>

        <div class="col-lg-6">

            <?= $form->field($model, 'date_debut')->textInput(['type' => 'date', 'required' => true])->label('<h5>Date de début<span class="text-danger">**</span></h5>'); ?>

            <?= $form->field($model, 'date_fin')->textInput(['type' => 'date', 'required' => true])->label('<h5>Date de fin<span class="text-danger">**</span></h5>') ?>

            <?= $form->field($model, 'descriptions')->textarea(['rows' => 6]) ?>


        </div>

        <textarea name="" id="all_detail_added" cols="30" rows="10" style="display: none;"></textarea>

        <!--   <?php
                //if (!(isset($_GET['key']) and $_GET['key'] != '')) { 
                ?>

            <div class=" text-white bg-primary">
                <table class="table primary-table-bg-hover" id="tab_temp_preview">
                    <div id="alert_place" class="content"></div>
                    <tr>
            </div>
            <td>
                <h5 class="text-white">Ajouter une matière à cette formation<span class="text-danger">*</span></h5>
                <= Html::dropDownList('select_matiere', null, ArrayHelper::map(Matiere::find()->where(['statut' => 1])->all(), 'id', 'libelle', ['prompt' => 'Choisissez la spécialité', 'class' => 'form-control', 'placeholder' => 'Select ...', 'required' => true])) ?>
            </td>
            <td>
                <div class="">
                    <div class="">
                        <h5 class="text-white">Choissez le nombre d'heure pour cette matière<span class="text-danger">*</span></h5>
                        <input type="number" class="form-control" id="nbr_heure">
                    </div>
                </div>
            </td>
            <td>
                <button type="button" class=" btn btn-dark fa fa-plus-square fa-8x" onclick="add_matiere()"> Ajouter</button>
            </td>
            </tr>
            </table>

            <table class="table table-bordered" id="tab_temp_preview">
                <thead class="thead-primary">
                    <tr>
                        <th scope="col">Matière</th>
                        <th scope="col">Nombre d'heure</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="rows">
                </tbody>
            </table>
        <p// } ?> -->

    </div>
</div>

<div class="form-group">
    <center>
        <form action="">
            <button type="reset" class="btn btn-dark btn-lg fa fa fa-undo fx-8"> Annuler</button>
        </form>
        <input type="button" value="Valider" class="btn btn-primary btn-lg" onclick="validate_form()">
    </center>
</div>
</div>

<?php ActiveForm::end(); ?>
</div>



<script>
    function validate_form() {
        let key_formation = '';
        let url = "<?= Yii::$app->homeUrl ?>save_formation";
        let specialite = document.getElementById('formation-idspectform').value;
        let libelle = document.getElementById('formation-libelle').value;
        let frais = document.getElementById('formation-frais').value;
        let descriptions = document.getElementById('formation-descriptions').value;
        let date_debut = document.getElementById('formation-date_debut').value;
        let date_fin = document.getElementById('formation-date_fin').value;
        let type_action = document.getElementById('type_action').value;
        let decision_brouillon = document.querySelector('input[name="decision_brouillon"]:checked').value;


        if (type_action == 'UPDATE') {

            let url_string = window.location.href
            let url0 = new URL(url_string);
            key_formation = url0.searchParams.get("key");
            let decision_brouillon = 'Non';

            if (specialite != "" && libelle != "" && frais != "" && date_debut != "" && date_fin != "") {
                if (specialite != null || libelle != null || frais != null || date_debut != null || date_fin != null) {
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            specialite: specialite,
                            libelle: libelle,
                            frais: frais,
                            descriptions: descriptions,
                            date_debut: date_debut,
                            date_fin: date_fin,
                            type_action: type_action,
                            key_formation: key_formation,

                            // all_detail_added: all_detail_added,
                        },
                        success: function(result) {
                            if (result == "0") {
                                // alert(specialite);
                                document.location.href = "<?= Yii::$app->homeUrl ?>";
                            } else {
                                var data = JSON.parse(result);
                                if (data.status == "ok") {
                                    document.location.href = "<?php Yii::$app->homeUrl ?>all_formation";
                                } else if (result == 'ko') {
                                    var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                        'Ce paramétrage existe déjà' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                        '</div>';
                                    $('#alertZone').html(err);
                                } else {
                                    var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                        data.message +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                        '</div>';
                                    $('#alertZone').html(err);
                                }
                            }
                        }
                    });
                } else {
                    var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Veuillez renseigner tous les champs obligatoires' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>';
                    $('#alertZone').html(err);
                    // window.location.reload();
                }
            } else {
                var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    'Veuillez renseigner tous les champs obligatoires' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';
                $('#alertZone').html(err);
                // window.location.reload();
            }


        } else if (type_action == 'CREATE') {

            if (specialite != "" && libelle != "" && frais != "" && date_debut != "" && date_fin != "") {
                if (specialite != null || libelle != null || frais != null || date_debut != null || date_fin != null) {
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            specialite: specialite,
                            libelle: libelle,
                            frais: frais,
                            descriptions: descriptions,
                            date_debut: date_debut,
                            date_fin: date_fin,
                            type_action: type_action,
                            key_formation: key_formation,
                            decision_brouillon: decision_brouillon,
                            // all_detail_added: all_detail_added,
                        },
                        success: function(result) {
                            if (result == "0") {
                                // alert(specialite);
                                document.location.href = "<?= Yii::$app->homeUrl ?>";
                            } else {
                                var data = JSON.parse(result);
                                if (data.status == "ok") {
                                    document.location.href = "<?php Yii::$app->homeUrl ?>all_formation";
                                } else if (result == 'ko') {
                                    var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                        'Ce paramétrage existe déjà' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                        '</div>';
                                    $('#alertZone').html(err);
                                } else {
                                    var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                        data.message +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                        '</div>';
                                    $('#alertZone').html(err);
                                }
                            }
                        }
                    });
                } else {
                    var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Veuillez renseigner tous les champs obligatoires' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>';
                    $('#alertZone').html(err);
                    // window.location.reload();
                }
            } else {
                var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    'Veuillez renseigner tous les champs obligatoires' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';
                $('#alertZone').html(err);
                // window.location.reload();
            }
        }



    }

    function set_specialite(val) {
        alert(val);
        let url = "<?= Yii::$app->homeUrl ?>setspecialite";
        if (val != "") {
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    specialite: val,
                },
                success: function(result) {
                    alert('ok');
                }
            });
        } else {

        }
    }

    /*  function add_matiere() {
         let matiere = $("[name='select_matiere']").val();
         let matiere_text = $("[name='select_matiere'] option:selected").text();
         let nbr_heure = document.getElementById('nbr_heure').value;
         if (matiere != '' && matiere != null && nbr_heure != null && nbr_heure != '') {

             var old_detail_added = $("#all_detail_added").val();
             var search_position = old_detail_added.search('###' + matiere + ';;;');

             if (search_position >= 0) {
                 msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                     ' Cette matière a déjà été ajouté à la liste </div> </div>';
                 $('#alert_place').show();
                 $('#alert_place').html(msg);
             } else {

                 var new_data = matiere + ';;;' + nbr_heure;

                 $("#all_detail_added").val(old_detail_added + '###' + new_data + '***');

                 var newCell = document.createElement("td");
                 var newCell1 = document.createElement("td");
                 var newCell2 = document.createElement("td");

                 newCell.innerHTML = matiere_text;
                 newCell1.innerHTML = nbr_heure;
                 newCell2.innerHTML = '<i class="fa fa-trash" style="color:red" onclick="delete_detail(\'' + new_data + '\', this)"></i>';

                 var newRow = document.createElement("tr");

                 newRow.append(newCell);
                 newRow.append(newCell1);
                 newRow.append(newCell2);

                 document.getElementById("rows").appendChild(newRow);

                 $("[name='select_matiere']").val('');
                 document.getElementById('nbr_heure').value = '';


                 msg = '<div class="alert alert-success alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                     '  </div> Matière ajoutée avec succès </div>';
                 $('#alert_place').show();
                 $('#alert_place').html(msg);

             }

         } else {
             msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                 ' Veuillez renseigner les champs obligatoires </div> </div>';
             $('#alert_place').show();
             $('#alert_place').html(msg);
         }
     } */

    /*   function delete_detail(data, element) {
          var correct_data = '###' + data + '***';
          var row_index = element.closest('tr').rowIndex;

          var all_detail_added = $("#all_detail_added").val();
          var res = all_detail_added.replace(correct_data, ""); // SUPPRESSION DE L'ELEMENT DANS LE CHAMP CACHE
          $("#all_detail_added").val(res);
          document.getElementById("tab_temp_preview").deleteRow(row_index); // SUPPRESSION DE L'ELEMENT DANS LE TABLEAU
      } */
</script>