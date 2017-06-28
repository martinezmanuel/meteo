<?php
try{
   $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
   $bdd = new PDO('mysql:host=localhost;dbname=meteo', 'root', 'root',
   $pdo_options);
  }catch(Exception $e){
    die('Erreur de connexion a la BDD: '.$e->getMessage());
  }
$datetime = date("m");

/*latitude,longitude*/
$statement = $bdd->prepare("select * from formulaire where gps > :gps");
$statement->execute(array(':gps' => 0));
$list = $statement->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($list); $i++) {
/*boucler pour recuperer les valeurs une par une */
    $returnValue = explode(',', $list[$i]['gps']);
    $email = $list[$i]['email'];

    $lat=$returnValue['0'];
    $lon=$returnValue['1'];


    $getData = file_get_contents("http://api.openweathermap.org/data/2.5/forecast/daily?lat=$lat&lon=$lon&units=metric&appid=3bd93f338d84f5fe911d8e61a412115c");

    $decode = json_decode($getData,true);
    
    $temp=$decode['list']['3']['temp']['min'];
    $pluie=$decode['list']['3']['weather']['0']['id'];
        if($datetime>=3 && $datetime<12){ 
                if ($pluie == 300 || $pluie == 301 || $pluie == 302 || $pluie == 310 || $pluie == 311 || $pluie == 312 || $pluie == 313 || $pluie == 314 ||$pluie == 321 || $pluie == 500 ||$pluie == 501 || $pluie == 502 || $pluie == 503 || $pluie == 504 || $pluie == 511 || $pluie == 520 || $pluie == 521 || $pluie == 522 || $pluie == 531 ){
                   
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
      
                }
                    
                  else {
                echo "au moins il ne pleut pas </br>";
            }
          }
       else{  

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
      
                }
                    
            else {
                echo "au moins il ne gele pas </br>";
            }  
          }     
      }  
?>