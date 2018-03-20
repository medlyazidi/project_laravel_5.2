<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/','AdminController@getView')->name('acc');

// Authentication Routes...
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\AuthController@showRegistrationForm');
$this->post('register', 'Auth\AuthController@register');
/*
// Password Reset Routes...
$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');

Route::get('/home', 'HomeController@index');
*/
/*
|--------------------------------------------------------------------------|
|                               ADMIN                                      |
|--------------------------------------------------------------------------|
*/


Route::group(['prefix'=>'admin'],function(){
        /*|-------------------------------------------------|
          |                 GESTION DES LOCAUX              |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'local'],function(){
                //Route::get('ajouter','LocalAdminController@ajouter')->name('addLocal');
                Route::post('ajouter','LocalAdminController@postLocal');
                Route::get('liste','LocalAdminController@listLocal')->name('listLocal');
                Route::get('liste/exception={exception}','LocalAdminController@gestionException');
                Route::get('edit','LocalAdminController@editLocal')->name('editLocal');
                Route::get('delete', 'LocalAdminController@destroy')->name('deleteLocal');
        });


        /*|-------------------------------------------------|
          |            GESTION DES TYPES DEPUTES            |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'typeDepute'],function(){
                Route::post('ajouter','TypeDeputeController@postTypeDepute');
                Route::get('liste','TypeDeputeController@listTypeDepute')->name('listTypeDepute');
                Route::get('liste/exception={exception}','TypeDeputeController@gestionException');
                Route::get('edit','TypeDeputeController@editTypeDepute')->name('editTypeDepute');
                Route::get('delete', 'TypeDeputeController@destroy')->name('deleteTypeDepute');
        });


        /*|-------------------------------------------------|
          |                GESTION DES DEPUTES              |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'depute'],function(){
            Route::get('ajouter','DeputeController@ajouterDepute')->name('ajouterDepute');
            Route::post('ajouter','DeputeController@postDepute');
            Route::get('ajouter/exception={exception}','DeputeController@gestionExcDepAdd');

            Route::post('ajouter/type/depute','DeputeController@postTypeToDepute')->name('addTypeToDepute');
            Route::get('liste','DeputeController@listDepute')->name('listDepute');
            Route::get('liste/exception={exception}','DeputeController@gestionException');
            Route::get('edit','DeputeController@editDepute')->name('editDepute');
            Route::get('edit/exception={exception}','DeputeController@gestionExcDepEdit');

            Route::get('delete', 'DeputeController@destroy')->name('deleteDepute');

            Route::post('edit/image','DeputeController@editDeputeImg')->name('editDeputeImg');
            //delete Union
            Route::get('delete/union', 'DeputeController@deleteUnion')->name('deleteUnion');
        });


        /*|-------------------------------------------------|
          |          GESTION DES LIGNE BUDGETAIRE           |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'ligneBudgetaire'],function(){
                Route::post('ajouter','LigneBudgetaireController@postLigneBudgetaire');
                Route::get('liste','LigneBudgetaireController@listLigneBudgetaire')->name('listLigneBudgetaire');
                Route::get('liste/exception={exception}','LigneBudgetaireController@gestionException');
                Route::post('edit','LigneBudgetaireController@editLigneBudgetaire')->name('editLigneBudgetaire');
                Route::get('delete', 'LigneBudgetaireController@destroy')->name('deleteLigneBudgetaire');
        });


        /*|-------------------------------------------------|
          |       GESTION DES SOUS LIGNE BUDGETAIRE         |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'sousligneBudgetaire'],function(){
                Route::post('ajouter','SousLigneBudgetaireController@postSsLigneBudgetaire')->name('postSsLigneBudgetaire');
                Route::get('liste','SousLigneBudgetaireController@listSsLigneBudgetaire')->name('listSsLigneBudgetaire');

                Route::get('liste/exception={exception}','SousLigneBudgetaireController@gestionException');//exception sous ligne
                Route::get('liste/exceptionSS={exception}','SousSousLigneBudgeatireController@gestionException');//exception sous sous ligne

                Route::post('edit','SousLigneBudgetaireController@editSsLigneBudgetaire')->name('editSsLigneBudgetaire');
                Route::get('delete', 'SousLigneBudgetaireController@destroy')->name('deleteSsLigneBudgetaire');

                Route::get('getSousLigne','SousLigneBudgetaireController@getSousLigne')->name('getSousLigne');
                Route::get('getSousSousLigne','SousLigneBudgetaireController@getSousSousLigne')->name('getSousSousLigne');
        });


        /*|-------------------------------------------------|
          |       GESTION DES SOUS LIGNE BUDGETAIRE         |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'sousSousligneBudgetaire'],function(){
                Route::post('ajouter','SousSousLigneBudgeatireController@postSsSsLigneBudgetaire')->name('postSsSsLigneBudgetaire');
                //Route::get('liste','SousSousLigneBudgetaireController@listSsSsLigneBudgetaire')->name('listSsSsLigneBudgetaire');

                Route::post('edit','SousSousLigneBudgeatireController@editSsSsLigneBudgetaire')->name('editSsSsLigneBudgetaire');
                Route::get('delete', 'SousSousLigneBudgeatireController@destroy')->name('deleteSsSsLigneBudgetaire');
        });


        /*|-------------------------------------------------|
          |          GESTION DES COMPTES BANCAIRE           |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'compteBancaire'],function(){
            //Afficher liste des comptes et ces Banques
                Route::get('liste','CompteBancaireController@listCompteBancaire')->name('listCompteBancaire');

            //gestion des exceptions
                Route::get('liste/exception={exception}','CompteBancaireController@gestionException');//exception sous ligne


            //Ajouter Banque et Compte
                Route::post('ajouterBanque','CompteBancaireController@ajouterBanque')->name('ajouterBanque');
                Route::post('ajouterCompte','CompteBancaireController@ajouterCompte')->name('ajouterCompte');

             //Modifier un compte et aussi la banque
                Route::post('editBanque','CompteBancaireController@editBanque')->name('editBanque');
                Route::post('editCompte','CompteBancaireController@editCompte')->name('editCompte');

            // Supprimer Compte et Banque
                Route::get('deleteBanque', 'CompteBancaireController@destroyBanque')->name('deleteBanque');
                Route::get('deleteCompte', 'CompteBancaireController@destroyCompte')->name('deleteCompte');
        });

        /*|-------------------------------------------------|
          |              GESTION DES UTILISATEUR            |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'users'],function(){
                Route::get('liste','UserController@listUser')->name('listeUser');
            //gestion des exceptions
                Route::get('liste/exception={exception}','UserController@gestionException');

                Route::post('ajoute','UserController@addUser')->name('addUser');
                Route::post('edit_by_admin','UserController@editUser')->name('editUser');
                Route::post('edit','UserController@editUserMe')->name('editUserMe');
                Route::post('editImage','UserController@editUserImage')->name('editUserImage');
                Route::get('delete', 'UserController@destroy')->name('deleteUser');
        });

        /*|-------------------------------------------------|
          |           GESTION DES NOTIFICATIONS             |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'notification'],function(){
                Route::get('getNoty','NotificationController@getNoty')->name('getNoty');// get notifications
                Route::get('doDelt','NotificationController@doDelt')->name('doDelt');// evrey month add a delt to deputes .
                Route::get('doDeltTest','NotificationController@doDeltTest')->name('doDeltTest');// evrey month add a delt to deputes .

            Route::get('get','NotificationController@notification')->name('notification');// get notifications
            Route::get('getNotification','NotificationController@getNotification')->name('getNotification');// get notifications

        });

        /*|-------------------------------------------------|
          |              GESTION DES DEPENSES               |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'depense'],function(){
                Route::get('liste','DepenseController@listeDepenses')->name('listeDepenses');


                Route::post('depenseAg','DepenseController@depenseAg')->name('depenseAg');

                //liste des modifications affichage depense et cotisation et ressource
                Route::get('liste_modif','DepenseController@listeModif')->name('listeModif');

                //liste modification des depense
                Route::get('liste_depense','DepenseController@listeDepense')->name('listeDepense');
            //gestion des exceptions
                Route::get('liste_depense/exception={exception}','DepenseController@gestionException');

                // modifie depense
                Route::post('edit_depense','DepenseController@editDepense')->name('editDepense');

                //supprime depense
                Route::get('delete_depense','DepenseController@deleteDepense')->name('deleteDepense');

        });

        /*|-------------------------------------------------|
          |              GESTION DES COTISATION             |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'cotisation'],function(){

                Route::post('ajout_cotisation','CotisationController@ajoutCotisation')->name('ajoutCotisation');

                //liste modification des cotisations
                Route::get('liste_cotisation','CotisationController@listeCotisation')->name('listeCotisation');

                //liste modification des cotisations
                Route::get('liste_cotisation_choix','CotisationController@listeCotisationchoix')->name('listeCotisationchoix');

                //gestion des exceptions
                Route::get('liste_cotisation/exception={exception}','CotisationController@gestionException');

                //modifie cotisation
                Route::get('edit_cotisation','CotisationController@getEditCotisation')->name('getEditCotisation');
                Route::post('edit_cotisation','CotisationController@editCotisation')->name('editCotisation');

                //delete cotisation
                Route::get('delete_cotisation','CotisationController@deleteCotisation')->name('deleteCotisation');
        });

        /*|-------------------------------------------------|
          |              GESTION DES RESSOURCES             |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'ressource'],function(){

                Route::post('ajout_ressource','RessourceController@ajoutRessource')->name('ajoutRessource');

                //liste modification des ressources
                Route::get('liste_ressource','RessourceController@listeRessource')->name('listeRessource');

                //gestion des exceptions
                Route::get('liste_ressource/exception={exception}','RessourceController@gestionException');

                //modification ressource
                Route::post('edit_essource','RessourceController@editRessource')->name('editRessource');

                //delete ressourc
                Route::get('delete_ressource','RessourceController@deleteRessource')->name('deleteRessource');

                //liste des type de ressource
                Route::get('liste/type_ressource','RessourceController@listTypeRessource')->name('listTypeRessource');
                Route::post('liste/type_ressource','RessourceController@editTypeRessource')->name('editTypeRessource');
                Route::post('liste/type_ressource/ajouter','RessourceController@addTypeRessource')->name('addTypeRessource');
                Route::get('liste/type_ressource/delete','RessourceController@deleteTypeRessource')->name('deleteTypeRessource');
                //gestion des exceptions
                Route::get('liste/type_ressource/exception={exception}','RessourceController@gestionExceptionTypeRessource');

        });

        //statisqtique controller

            /*|-------------------------------------------------|
              |            GESTION DES STATISTIQUES             |
              |-------------------------------------------------|*/
        Route::group(['prefix'=>'statistique'],function(){
                //cotisation des deputes

                Route::get('liste','StatistiqueController@liste')->name('liste_statistique');
                Route::get('liste_search','StatistiqueController@searchList')->name('liste_statistique_search');
                //

                Route::get('liste_depute_montant','StatistiqueController@list_deputes_montant')->name('liste_depute_montant');
                Route::get('list_deputes_mois','StatistiqueController@list_deputes_mois')->name('list_deputes_mois');

                //liste des deputes selon locals
                Route::get('liste_depute_montant_local','StatistiqueController@list_deputes_montant_local')->name('liste_depute_montant_local');

                //cotisations et depenses et ressource de toute l"année courante et les années précédants
                Route::get('etat_deux','EtatStatistique2@list_etat_deux')->name('list_etat_deux');

                //depenses selant les banques et les rechercche se fait entre deux dates
                Route::get('etat_depense_statistique','EtatDepenseStatistique@etat_depense')->name('etat_depense');

                //depenses ,en calculant le montant total selon les ligne budgetaires
                Route::get('etat_depense_ligne_budg','EtatDepenseStatistique@etat_depense_ligne')->name('etat_depense_ligne_budg');

                //ressource selon les date de recherche
                Route::get('etat_ressource','EtatRessourceStatistique@etat_ressource')->name('etat_ressource');

                //Credit deputee
                        // avec Credit
                Route::get('liste_depute_avec_credit','DeputeCreditController@list_deputes_avec_credit')->name('list_deputes_avec_credit');
                        // sans Credit
                Route::get('liste_depute_sans_credit','DeputeCreditController@list_deputes_sans_credit')->name('list_deputes_sans_credit');

                //les statistiques des cotisations et les dettes de chaque depute
                Route::get('liste/depute/dette_cotisation/annee','StatistiqueDeptAnnController@liste')->name('list_deputes_annee');
        });

        /*|-------------------------------------------------|
          |                GESTION DE VOITURE               |
          |-------------------------------------------------|*/
        Route::group(['prefix'=>'voiture'],function(){
                Route::post('ajouter','VoitureController@ajoute');
                Route::get('liste','VoitureController@liste')->name('listVoiture');
                //Route::get('liste/exception={exception}','TypeDeputeController@gestionException');
                Route::get('edit','VoitureController@edit')->name('editVoiture');
                Route::get('delete', 'VoitureController@destroy')->name('deleteVoiture');
        });


        //delete folder
        Route::post('delete_folder','AdminController@post_delete_folder')->name('delete_folder');
        //ajouter une piece joint
        Route::post('add_piece_joint','AdminController@add_piece_joint')->name('ajoutPienceJoint');

        //menu pour tt les user ou il affiche une image
        Route::get('menu','AdminController@MenuImg')->name('menu_img');


        //test
        Route::get('test','AdminController@test')->name('test');




});
