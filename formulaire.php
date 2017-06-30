<?php

require_once "cnxBDD.php";

$nom=isset($_POST['full_name'])?$_POST['full_name']:'';
$adresse=isset($_POST['street1'])?$_POST['street1']:'';
$comp_adresse=isset($_POST['street2'])?$_POST['street2']:'';
$ville=isset($_POST['city'])?$_POST['city']:'';
$code=isset($_POST['code'])?$_POST['code']:'';
$gps=isset($_POST['gps'])?$_POST['gps']:'';
$email=isset($_POST['email'])?$_POST['email']:'';
$date_enregistrement=date("Y-m-d");


    // Requete :  
  try{
    //préparation de la requete
  $sql = 'INSERT INTO formulaire (nom,adresse,comp_adresse,ville,code_postal,gps,email,date_enregistrement) 
          VALUES (:nom,:adresse,:comp_adresse,:ville,:code_postal,:gps,:email,:date_enregistrement)';
  $params = array( "nom"=>$nom
                  ,"adresse"=>$adresse
                  ,"comp_adresse"=>$comp_adresse
                  ,"ville"=>$ville
                  ,"code_postal"=>$code
                  ,"gps"=>$gps
                  ,"email"=>$email
                  ,"date_enregistrement"=>$date_enregistrement
                  
          );
    //execution de la requete 
  	$req = $bdd ->prepare($sql);
   	$req ->execute($params);
  
   echo "Votre inscription à bien été prise en compte vous recevrez un email s'il y a du mauvais temps dans les 3 jours";
 }catch(Exception $e){
    echo "<br>-------------------<br> ERREUR ! <br>";
    print_r($params);
    die('<br>Requete Erreur !: '.$e->getMessage());
  }
?>