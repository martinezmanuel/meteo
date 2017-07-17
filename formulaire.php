<?php

try{
   $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
   $bdd = new PDO('mysql:host=localhost;dbname=apimecra_apim','apimecra_master','WebAgram28',
   $pdo_options);
  }catch(Exception $e){
    die('Erreur de connexion a la BDD: '.$e->getMessage());
  }

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

      
   

 }catch(Exception $e){
    echo "<br>-------------------<br> ERREUR ! <br>";
    print_r($params);
    die('<br>Requete Erreur !: '.$e->getMessage());
  }
  
  $headers = 'MIME-Version: 1.0'."\r\n";
      $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
      $headers.= "Reply-to: \"Webmaster\" <webmaster@api-meteo.craym.eu>";
      $headers .= 'Inscription'."\r\n";
      $destinataire = 'm.martinez@agram.fr,'.$email.''; // Adresse email du client et du Webmaster pour avoir une copie    
      $sujet = 'Inscription'; // Titre de l'email
      $contenu = 
      '<html>
        <head>
              <title>Inscription Météo</title>
        </head>
        <body>
          Bonjour,
          </br>
          </br>
          Votre inscription à bien été prise en compte
           </br> 
           </br>
           ,vous recevrez un mail en cas de pluie 
           </br> 
           </br>
          Cordialement
          </br>
          </br>
          Le webmaster
        </body>
      </html>'; 
      // Contenu du message de l'email (en HTML)

      // Envoyer l'email
      mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
  
  header("Location:http://api-meteo.craym.eu/index.php");
?>