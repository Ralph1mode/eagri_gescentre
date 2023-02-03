<?php

use backend\models\Matiere;
use common\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Formation */

$this->title = 'Ajout d\'une matière';
$this->params['breadcrumbs'][] = ['label' => 'Memomatieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>FORMATIONS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_formation">Liste des formations</a></li>
                <li class="breadcrumb-item active">Ajout de matière</li>
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

                                                <h5 class="text-white">Ajouter une matière à cette formation<span class="text-danger">*</span></h5>
                                                <?= $form->field($model, 'idMatiere')->dropdownList(
                                                    ArrayHelper::map(
                                                        Matiere::find()->where(['statut' => 1])->all(),
                                                        'id',
                                                        'libelle',
                                                    ),
                                                    ['prompt' => 'Choisissez la matière', 'class' => 'form-control', 'required' => true],

                                                )->error(false)->label(false);
                                                ?>
                                                <!-- < Html::dropDownList('select_matiere', null, ArrayHelper::map(Matiere::find()->where(['statut' => 1])->all(), 'id', 'libelle', ['prompt' => 'Choisissez la spécialité', 'class' => 'form-control', 'placeholder' => 'Select ...', 'required' => true])) ?> -->

                                            </td>
                                            <td>
                                                <div class="">
                                                    <h5 class="text-white">Choissez le nombre d'heure pour cette matière<span class="text-danger">*</span></h5>
                                                    <?= $form->field($model, 'nb_heure')->textInput(['required' => true, 'type' => 'number'])->label(false) ?>
                                                    <!-- <input type="number" class="form-control" id="nbr_heure"> -->
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class=" btn btn-dark fa fa-plus-square fa-8x" onclick="add_matiere()"> Ajouter</button>
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
                                    <th scope="col">Matière</th>
                                    <th scope="col">Nombre d'heure</th>
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
        let url = "<?= Yii::$app->homeUrl ?>save_matiere";
        let all_detail_added = document.getElementById('all_detail_added').value;
        let url_string = window.location.href
        let url0 = new URL(url_string);
        key_formation = url0.searchParams.get("key");

        if (all_detail_added != "") {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    all_detail_added: all_detail_added,
                    key_formation: key_formation,
                }, //
                success: function(result) {
                    if (result == "0") {
                        document.location.href = "<?= Yii::$app->homeUrl ?>";
                    } else if (result == "ok") {
                        document.location.href = "<?= Yii::$app->homeUrl ?>view_formation?key=" + key_formation;
                    } else {
                        document.location.reload();
                    }
                }
            });
        } else {

        }
    }
</script>

<script>
    function add_matiere() {
        let matiere = $("#memomatiere-idmatiere").val();
        let matiere_text = $("#memomatiere-idmatiere option:selected").text();
        // let nb_heure = $("[name='nb_heure']").val();
        let nb_heure = document.getElementById('memomatiere-nb_heure').value;

        // alert(matiere)
        // alert(nb_heure)
        if (matiere != null && nb_heure != '') {

            var old_detail_added = $("#all_detail_added").val();

            var search_position = old_detail_added.search('###' + matiere + ';;;');

            if (search_position >= 0) {
                msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                    ' Cette matière a déjà été ajouté à la liste </div> </div>';
                $('#alert_place').show();
                $('#alert_place').html(msg);
            } else {

                var new_data = matiere + ';;;' + nb_heure;

                $("#all_detail_added").val(old_detail_added + '###' + new_data + '***');

                var newCell = document.createElement("td");
                var newCell1 = document.createElement("td");
                var newCell2 = document.createElement("td");

                newCell.innerHTML = matiere_text;
                newCell1.innerHTML = nb_heure;
                newCell2.innerHTML = '<i class="fa fa-trash" style="color:red" onclick="delete_detail(\'' + new_data + '\', this)"></i>';

                var newRow = document.createElement("tr");

                newRow.append(newCell);
                newRow.append(newCell1);
                newRow.append(newCell2);

                document.getElementById("rows").appendChild(newRow);

                $("#memomatiere-idmatiere").val('');
                document.getElementById('memomatiere-nb_heure').value = '';


                msg = '<div class="alert alert-success alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                    '  </div> Matière ajoutée avec succès </div>';
                $('#alert_place').show();
                $('#alert_place').html(msg);

            }

        } else {
            msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                ' Veuillez renseigner les champs obligatoires</div> </div>';
            $('#alert_place').show();
            $('#alert_place').html(msg);
        }
    }

    function delete_detail(data, element) {
        var correct_data = '###' + data + '***';
        var row_index = element.closest('tr').rowIndex;

        var all_detail_added = $("#all_detail_added").val();
        var res = all_detail_added.replace(correct_data, ""); // SUPPRESSION DE L'ELEMENT DANS LE CHAMP CACHE
        $("#all_detail_added").val(res);
        document.getElementById("tab_temp_preview").deleteRow(row_index); // SUPPRESSION DE L'ELEMENT DANS LE TABLEAU
    }
</script>