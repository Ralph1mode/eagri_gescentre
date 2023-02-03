<?php
$tab_url = array(

	'index' => 'site/index',
	'connexion' => 'site/login',
	'logout' => 'site/logout',
	'forget_password' => 'site/forget_password',
	'reset_password' => 'site/reset_password',
	'historique' => 'site/historique',
	'pdf' => 'site/pdf',
	'fiche_note' => 'site/fichenote',
	'list_note' => 'site/listnote',
	'formacheve' => 'site/formacheve',
	'formcours' => 'site/formcours',

	/* route type de formation */
	'all_typeformation' => 'typeformation/index',
	'form_typeformation' => 'typeformation/_form',
	'update_typeformation' => 'typeformation/update',
	'create_typeformation' => 'typeformation/create',
	'view_typeformation' => 'typeformation/view',
	'delete_typeformation' => 'typeformation/delete',


	/* route specialite */
	'all_specialite' => 'specialite/index',
	'form_specialite' => 'specialite/_form',
	'update_specialite' => 'specialite/update',
	'create_specialite' => 'specialite/create',
	'view_specialite' => 'specialite/view',
	'delete_specialite' => 'specialite/delete',
	'delete_specialitef' => 'specialite/delete_mat',

	'save_formation' => 'formation/save_formation',
	'setspecialite' => 'formation/setspecialite',
	'save_matform' => 'formation/createmat',
	'save_matiere' => 'formation/save_matiere',
	'update_memomatiere' => 'formation/update_memomatiere',
	'delete_memomatieref' => 'formation/delete_memomatiere',

	/* route spectform */
	'setparam' => 'spectform/setparam',
	'update_specf' => 'spectform/update_specf',
	'save_specf' => 'spectform/save_specf',
	'all_spectform' => 'spectform/index',
	'form_spectform' => 'spectform/_form',
	'update_spectform' => 'spectform/update',
	'view_spectform' => 'spectform/view',
	'create_spectform' => 'spectform/create',
	'delete_spectform' => 'spectform/delete',
	'delete_spectf' => 'spectform/delete_spectf',


	'save_matparam' => 'spectform/createmat',
	'save_matparamm' => 'spectform/save_matiere',
	'delete_matbr' => 'spectform/deletemat',
	'update_brouillonf' => 'spectform/update_brouillon',

	/* route evaluation */
	'all_evaluation' => 'evaluation/index',
	'form_evaluation' => 'evaluation/_form',
	'update_evaluation' => 'evaluation/update',
	'create_evaluation' => 'evaluation/create',
	'view_evaluation' => 'evaluation/view',
	'delete_evaluation' => 'evaluation/delete',
	'save_evaluation' => 'evaluation/saveevaluation',
	'setevaluation' => 'evaluation/setevaluation',
	'seteval' => 'evaluation/seteval',
	'delete_evaluationf' => 'evaluation/delete_evaluationf',
	'eval_note' => 'evaluation/note',
	'savenote' => 'note/savenote',

	/* route type evaluation */
	'all_typeevaluation' => 'typeevaluation/index',
	'form_typeevaluation' => 'typeevaluation/_form',
	'update_typeevaluation' => 'typeevaluation/update',
	'create_typeevaluation' => 'typeevaluation/create',
	'view_typeevaluation' => 'typeevaluation/view',
	'delete_typeevaluation' => 'typeevaluation/delete',

	/* route apprenant */
	'all_apprenant' => 'apprenant/index',
	'form_apprenant' => 'apprenant/_form',
	'update_apprenant' => 'apprenant/update',
	'create_apprenant' => 'apprenant/create',
	'view_apprenant' => 'apprenant/view',
	'delete_apprenant' => 'apprenant/delete',
	'save_apprenant' => 'apprenant/saveapprenant',
	'setapprenant' => 'apprenant/setapprenant',


	/* route formation */
	'all_formation' => 'formation/index',
	'form_formation' => 'formation/_form',
	'update_formation' => 'formation/update',
	'create_formation' => 'formation/create',
	'view_formation' => 'formation/view',
	'delete_formation' => 'formation/deletepro',
	'close_formation' => 'formation/close_formation',


	/* route inscription */
	'all_inscription' => 'inscription/index',
	'form_inscription' => 'inscription/_form',
	'update_inscription' => 'inscription/update',
	'create_inscription' => 'inscription/create',
	'delete_inscription' => 'inscription/delete',
	'all_code' => 'inscription/qrcode',


	/* route pays */
	'all_pays' => 'pays/index',
	'form_pays' => 'pays/_form',
	'update_pays' => 'pays/update',
	'create_pays' => 'pays/create',
	'view_pays' => 'pays/view',
	'delete_pays' => 'pays/delete',

	/* route matiere */
	'all_matiere' => 'matiere/index',
	'form_matiere' => 'matiere/_form',
	'update_matiere' => 'matiere/update',
	'create_matiere' => 'matiere/create',
	'view_matiere' => 'matiere/view',
	'delete_matiere' => 'matiere/delete',
	'delete_matieref' => 'matiere/delete_matiere',

	/* route memomatiere */

	'delete_memomatiere' => 'memomatiere/delete',
	'update_mat' => 'formation/updatemat',
	'create_mat' => 'formation/createmat',
	'delete_mat' => 'formation/deletemat',

	/*Route brouillon */
	'save_brouillon' => 'save_brouillon',


	/* route note */
	'all_note' => 'note/index',
	'form_note' => 'note/_form',
	'update_note' => 'note/update',
	'create_note' => 'note/create',
	'view_note' => 'note/view',
	'delete_note' => 'note/delete',


	/* route user */
	'all_user' => 'user/index',
	'form_user' => 'user/_form',
	'update_user' => 'user/update',
	'create_user' => 'user/save_user',
	'view_user' => 'user/view',
	'delete_user' => 'user/delete',
	'save_user' => 'user/create',

	/* route profil */
	'all_profil' => 'profil/index',
	'form_profil' => 'profil/_form',
	'update_profil' => 'profil/update',
	'create_profil' => 'profil/create',
	'view_profil' => 'profil/view',
	'delete_profil' => 'profil/delete',
	'save_profil' => 'profil/save_profil',
	'create_detail' => 'profil/save_fonction',
	// 'save_fonction' => 'profil/save_fonction',

	/* route profilfonctionnalite */
	'all_profilfonc' => 'profilfonctionnalite/index',
	'form_profilfonc' => 'profilfonctionnalite/_form',
	'update_profilfonc' => 'profilfonctionnalite/update',
	'create_profilfonc' => 'profilfonctionnalite/create',
	'view_profilfonc' => 'profilfonctionnalite/view',
	'delete_profilfonc' => 'profilfonctionnalite/delete',
	'save_profilfonc' => 'profilfonctionnalite/save_profil',
	'create_detailfonc' => 'profilfonctionnalite/save_fonction',
	// 'save_fonction' => 'profil/save_fonction',

);
