<?php
error_reporting(E_ALL);
try{
   $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
   $bdd = new PDO('mysql:host=localhost;dbname=meteo', 'root', 'root',
   $pdo_options);
  }catch(Exception $e){
    die('Erreur de connexion a la BDD: '.$e->getMessage());
  }
$mois = date("m");
$datetime1=date("Y-m-d");

$statement = $bdd->prepare("select * from formulaire where gps > :gps");
$statement->execute(array(':gps' => 0));
$list = $statement->fetchAll(PDO::FETCH_ASSOC);

/*boucler pour recuperer les valeurs une par une */
for ($i = 0; $i < count($list); $i++) {
    /*on recupere la date d'enregistrement du client pour connaitre le nombre de jour depuis l'inscription */
    $datetime2=$list[$i]['date_enregistrement'];
    $date1=strtotime($datetime1);
    $date2=strtotime($datetime2);
    $date=$date1-$date2;
    $nbrejour=idate('d',$date)-1;

    /*Récupération de l'email du client pour l'envois éventuel*/
    $email = $list[$i]['email'];

    /*On regupere les données GPS pour les separer en deux pour pouvoir faire l'appel de l'API grace aux coordonnées GPS du client*/
    $returnValue = explode(',', $list[$i]['gps']);
    $lat=$returnValue['0'];
    $lon=$returnValue['1'];

  /*Si le nombre de jour entre la date d'inscription et la date du jour est supérieur à 3 on lance la recherche de pluie ou de gel suivant la saison */
  if ($nbrejour>=3){

    $getData = file_get_contents("http://api.openweathermap.org/data/2.5/forecast/daily?lat=$lat&lon=$lon&units=metric&appid=3bd93f338d84f5fe911d8e61a412115c");
    $decode = json_decode($getData,true);

    /*On extrait de l'API les données pour la pluie et le gel suivant la saison*/
    $temp=$decode['list']['3']['temp']['min'];
    $pluie=$decode['list']['3']['weather']['0']['id'];

      /*Controle du mois en cour pour voir s'il est compris entre Mars et Novembre*/
        if($mois>=3 && $mois<12){ 
          /*controle des Id de l'API qui correspondent à la pluie*/
                if ($pluie == 300 || $pluie == 301 || $pluie == 302 || $pluie == 310 || $pluie == 311 || $pluie == 312 || $pluie == 313 || $pluie == 314 ||$pluie == 321 || $pluie == 500 ||$pluie == 501 || $pluie == 502 || $pluie == 503 || $pluie == 504 || $pluie == 511 || $pluie == 520 || $pluie == 521 || $pluie == 522 || $pluie == 531 ){
            /*si l'id fait parti de ceux de la condition on envois un mail pour prevenir de la pluie dans 3 jours*/       
      $headers = 'MIME-Version: 1.0'."\r\n";
      $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
      $headers .= 'Pluie'."\r\n";
      $destinataire = 'm.martinez@agram.fr,'.$email.''; // Adresse email du webmaster (à personnaliser)      
      $sujet = 'Alerte pluie'; // Titre de l'email
      $contenu = 
      '<html>
        <head>
              <title>Risque de pluie</title>
        </head>
        <body>
          Attention il risque de pleuvoir dans 3 jours
        </body>
      </html>'; 
      // Contenu du message de l'email (en HTML)

      // Envoyer l'email
      mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
      echo '<h2>Votre message a &eacute;t&eacute; envoy&eacute;!</h2>'; // Afficher un message pour indiquer que le message a été envoyé
      // (2) Fin du code pour traiter l'envoi de l'email
      
      // Enregistrement dans la base de donnée de la nouvelle date
      $req = "UPDATE formulaire SET date_enregistrement = '$datetime1'
            WHERE email = '$email'";
      $run = $bdd->prepare($req);
      $run->execute(); 
                }
                    
                  else {}
          }
       else{  
        /*Si on est pas dans la période precedente on controle les gelées*/
          if ($temp<0){
                   
      $headers = 'MIME-Version: 1.0'."\r\n";
      $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
      $headers .= 'Pluie'."\r\n";
      $destinataire = 'm.martinez@agram.fr,'.$email.''; // Adresse email du webmaster (à personnaliser)      
      $sujet = 'Alerte gel'; // Titre de l'email
      $contenu = 
      '<html>
        <head>
              <title>Risque de gel</title>
        </head>
        <body>
          Attention il risque de geler dans 3 jour
        </body>
      </html>'; 
      // Contenu du message de l'email (en HTML)
      // Envoyer l'email
      mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
      echo '<h2>Votre message a &eacute;t&eacute; envoy&eacute;!</h2>'; // Afficher un message pour indiquer que le message a été envoyé
      // (2) Fin du code pour traiter l'envoi de l'email
      // Enregistrement dans la base de donnée de la nouvelle date
      $sqlQuery = "UPDATE formulaire SET date_enregistrement = '$datetime1'
            WHERE email = '$email'";
      $run = $bdd->prepare($sqlQuery);
      $run->execute(); 
      $resp['msg']    = "Votre enregistrement a été modifié";
      $resp['status'] = true;
                }
                    
            else {}  
        }  
    }
    else{}       
 }  
?>