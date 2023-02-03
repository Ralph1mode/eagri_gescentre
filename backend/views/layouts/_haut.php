 <!--**********************************
            Nav header start
        ***********************************-->
 <div class="nav-header">
     <a href="index" class="brand-logo">
         <img class="logo-abbr" style="width:100%; height: 30px;" sizes="30%" src="template/images/eagribusiness.jpeg" alt="">
         <img class="logo-compact" src="template/images/eagribusiness.jpeg" alt="">
         <img class="brand-title" src="template/images/eagribusiness.jpeg" alt="">
     </a>
     <div class="nav-control">
         <div class="hamburger">
             <span class="line"></span><span class="line"></span><span class="line"></span>
         </div>
     </div>
 </div>
 <!--**********************************
            Nav header end
        ***********************************-->

 <!--**********************************
            Header start
            ***********************************-->
 <div class="header">

     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
         google.charts.load("current", {
             packages: ["corechart"]
         });
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
             var data = google.visualization.arrayToDataTable([

                 ['Resultat', 'pourcentage'],

                 <?php

                    use backend\models\Note;
                    use backend\models\Inscription;
                    use backend\models\Formation;
                    use backend\models\Spectform;

                    $formation = Formation::find()->where(['statut' => 1, 'cloture' => 0])->all();
                    $n = 0;
                    $y = 0;

                    foreach ($formation as $formations) {

                        $inscription = Inscription::find()->where(['statut' => 1, 'idFormation' => $formations->id])->all();
                        foreach ($inscription as $inscriptions) {

                            $idIns = $inscriptions->id;
                            $query = Note::find()->where(['statut' => 1, 'idInscription' => $idIns]);
                            $sommeNote = $query->sum('libelle');
                            $nbreNote = $query->count();
                            if ($nbreNote != 0) {

                                $moyenne = $sommeNote / $nbreNote;
                                if ($moyenne >= 50) {

                                    $n += 1;
                                } elseif ($moyenne < 50) {
                                    $y += 1;
                                }
                            }
                        }
                    }
                    ?>


                 ['Admis', <?= $n ?>],
                 ['Ajournée', <?= $y ?>],


             ]);

             var options = {
                 title: 'Taux de réussite',
                 is3D: true,
             };

             var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
             chart.draw(data, options);
         }
     </script>





     <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
     <script type="text/javascript">
         google.charts.load('current', {
             'packages': ['bar']
         });
         google.charts.setOnLoadCallback(drawStuff);

         function drawStuff() {
             var data = new google.visualization.arrayToDataTable([
                 ['Specialite', 'Total inscrit'],

                 <?php

                    $spectform = Spectform::find()->where(['statut' => 1])->all();
                    // $tout = Spectform::find()->where(['statut' => 1, 'idSpecialite' => $spectforms->idSpecialite0->id])->one();


                    foreach ($spectform as $spectforms) {
                        $donnee = $spectforms->idSpecialite0->libelle;
                        // $donne2 = $spectforms->idTypeformation0->libelle;
                        $idSpec = $spectforms->id;
                        $formation = Formation::find()->where(['statut' => 1, 'idSpectForm' => $idSpec])->all();
                        foreach ($formation as $formations) {
                            $idForm = $formations->id;

                            $apprenant = Inscription::find()->where(['statut' => 1, 'idFormation' => $idForm])->count();

                    ?>["<?= $donnee ?>", <?= $apprenant ?>],


                 <?php }
                    } ?>

             ]);

             var options = {
                 title: 'Spécialité',
                 width: 800,
                 legend: {
                     position: 'none'
                 },
                 chart: {
                     title: 'Apprenant inscrit par spécialité',
                     //  subtitle: 'popularity by percentage'
                 },
                 bars: 'vertical', // Required for Material Bar Charts.
                 axes: {
                     x: {
                         0: {
                             side: 'top',
                             label: 'Apprenant'
                         } // Top x-axis.
                     }
                 },
                 bar: {
                     groupWidth: "70%"
                 }
             };

             var chart = new google.charts.Bar(document.getElementById('top_x_div'));
             chart.draw(data, options);
         };
     </script>

     <!-- <script>
         google.charts.load('current', {
             'packages': ['bar']
         });
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
             var data = google.visualization.arrayToDataTable([

                 ['Resultat', 'pourcentage'],

                 <?php


                    $formation = Formation::find()->where(['statut' => 1, 'cloture' => 0])->all();
                    $n = 0;
                    $y = 0;

                    foreach ($formation as $formations) {

                        $inscription = Inscription::find()->where(['statut' => 1, 'idFormation' => $formations->id])->all();
                        foreach ($inscription as $inscriptions) {

                            $idIns = $inscriptions->id;
                            $query = Note::find()->where(['statut' => 1, 'idInscription' => $idIns]);
                            $sommeNote = $query->sum('libelle');
                            $nbreNote = $query->count();
                            if ($nbreNote != 0) {

                                $moyenne = $sommeNote / $nbreNote;
                                if ($moyenne >= 50) {

                                    $n += 1;
                                } elseif ($moyenne < 50) {
                                    $y += 1;
                                }
                            }
                        }
                    }
                    ?>


                 ['Admis', <?= $n ?>],
                 ['Ajournée', <?= $y ?>],


             ]);

             var options = {
                 title: 'Taux de réussite',
                 is3D: true,
             };

             var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
             chart.draw(data, options);
         }
     </script> -->








     <div class="header-content">
         <nav class="navbar navbar-expand">
             <div class="collapse navbar-collapse justify-content-between">
                 <div class="header-left">

                 </div>

                 <ul class="navbar-nav header-right">

                     <li class="nav-item dropdown header-profile">
                         <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                             <img src="template/style_carte/img/avatar.png" width="20" alt="">
                         </a>
                         <div class="dropdown-menu dropdown-menu-right">
                             <!-- <a href="app-profile.html" class="dropdown-item ai-icon">
                                 <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                     <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                     <circle cx="12" cy="7" r="4"></circle>
                                 </svg>
                                 <span class="ml-2">Profile </span>
                             </a> -->
                             <a href="<?php echo Yii::$app->homeUrl ?>logout" class="dropdown-item ai-icon">
                                 <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                     <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                     <polyline points="16 17 21 12 16 7"></polyline>
                                     <line x1="21" y1="12" x2="9" y2="12"></line>
                                 </svg>
                                 <span class="ml-2">Déconnexion (<?php echo !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : 'invité' ?>)</span>
                             </a>
                         </div>
                     </li>
                 </ul>
             </div>
         </nav>
     </div>
 </div>
 <!--**********************************
            Header end ti-comment-alt
***********************************-->