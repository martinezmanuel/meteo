<?php
error_reporting(E_ALL);
try{
   $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
   $bdd = new PDO('mysql:host=localhost;dbname=apimecra_apim', 'apimecra_master', 'WebAgram28',
   $pdo_options);
  }catch(Exception $e){
    die('Erreur de connexion a la BDD: '.$e->getMessage());
  }

$mois = date("m");
$datetime1=date("Y-m-d");


$statement = $bdd->prepare("select * from formulaire where gps > :gps");
$statement->execute(array(':gps' => 0));
$list = $statement->fetchAll(PDO::FETCH_ASSOC);


//boucler pour recuperer les valeurs une par une 
for ($i = 0; $i < count($list); $i++) {
    //on recupere la date d'enregistrement du client pour connaitre le nombre de jour depuis l'inscription 
    $datetime2=$list[$i]['date_enregistrement'];
    $date1=strtotime($datetime1);
    $date2=strtotime($datetime2);
    $date=$date1-$date2;
    $nbrejour=idate('d',$date)-1;

    //Récupération de l'email du client pour l'envois éventuel
    $email = $list[$i]['email'];
    $nom = $list[$i]['nom'];
   

    //On regupere les données GPS pour les separer en deux pour pouvoir faire l'appel de l'API grace aux coordonnées GPS du client
    $returnValue = explode(',', $list[$i]['gps']);
    $lat=$returnValue['0'];
    $lon=$returnValue['1'];

  //Si le nombre de jour entre la date d'inscription et la date du jour est supérieur à 3 on lance la recherche de pluie ou de gel suivant la saison 
   if ($nbrejour>=3){
        $getData = file_get_contents("http://api.openweathermap.org/data/2.5/forecast/daily?lat=$lat&lon=$lon&units=metric&appid=3bd93f338d84f5fe911d8e61a412115c");
        $decode = json_decode($getData,true);

      //On extrait de l'API les données pour la pluie et le gel suivant la saison
      $temp=$decode['list']['3']['temp']['min'];
      $pluie=$decode['list']['3']['weather']['0']['id'];
      
      //Controle du mois en cour pour voir s'il est compris entre Mars et Novembre
        if($mois>=3 && $mois<12){ 

            if ($pluie == 300 || $pluie == 301 || $pluie == 302 || $pluie == 310 || $pluie == 311 || $pluie == 312 || $pluie == 313 || $pluie == 314 ||$pluie == 321 || $pluie == 500 ||$pluie == 501 || $pluie == 502 || $pluie == 503 || $pluie == 504 || $pluie == 511 || $pluie == 520 || $pluie == 521 || $pluie == 522 || $pluie == 531 )
            {
               
              $headers = "MIME-Version: 1.0"."\r\n";
              $headers .= "Content-type: text/html; charset=UTF-8"."\r\n";
              $headers .= 'Alerte Pluie'."\r\n";
              $destinataire = $email; // Adresse email du client et du Webmaster pour avoir une copie    
              $sujet = "Pluie"; // Titre de l'email
              $contenu = 
              
                '<!DOCTYPE html>
                <html xstyle="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <head>
                  <meta name="viewport" content="width=device-width" />
                  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>Alerte pluie</title>


                  <style type="text/css">
                    img {
                        max-width: 100%;
                        }
                    body {
                        -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
                          }
                    body {
                        background-color: #f6f6f6;
                          }
                    @media only screen and (max-width: 640px) {
                    body {
                        padding: 0 !important;
                          }
                    h1 {
                      font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                    h2 {
                      font-weight: 800 !important; margin: 20px 0 5px !important;
                        }
                    h3 {
                      font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                    h4 {
                      font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                    h1 {
                      font-size: 22px !important;
                      }
                    h2 {
                      font-size: 18px !important;
                      }
                    h3 {
                      font-size: 16px !important;
                      }
                    .container {
                      padding: 0 !important; width: 100% !important;
                      }
                    .content {
                      padding: 0 !important;
                      }
                    .content-wrap {
                      padding: 10px !important;
                      }
                    .invoice {
                      width: 100% !important;
                      }
                      }
                  </style>
                </head>

                <body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                <table class="body-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                  <td class="container" width="600" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                    <div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                      <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="alert alert-warning" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; border: 1px solid #e9e9e9; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" bgcolor="#fff" valign="top">
                          <img src="http://api-meteo.craym.eu/images/agramsignature.png" alt="logo agram" width="173px" height="33px" >           
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                          <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            Bonjour <strong style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">'.$nom.'</strong>.-
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; text-align: justify; text-justify: inter-word;"><td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                          Suite à votre inscription sur le site de météo
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            Nous vous informons qu\'il risque de pleuvoir dans 3 jours afin que vous preniez vos precautions .
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            Bonne journée à vous , merci.
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            L\'équipe Agram.
                          </td>
                        </tr>
                      </table>
                </td>
              </tr>
          </table>
            <div class="footer" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
              <table width="100%" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <td class="aligncenter content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top"><a href="http://agram.fr/" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">Agram</a>.</td>
                </tr>
              </table>
            </div>
          </div>
        </td>
          <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
        </tr></table></body>
    </html>'; 
      
          // Envoyer l'email
          mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
          echo '<h2>Votre message a été envoyé!</h2>'; // Afficher un message pour indiquer que le message a été envoyé
          // (2) Fin du code pour traiter l'envoi de l'email
          // Enregistrement dans la base de donnée de la nouvelle date
          $sqlQuery = "UPDATE formulaire SET date_enregistrement = '$datetime1'
              WHERE email = '$email'";
          $run = $bdd->prepare($sqlQuery);
          $run->execute(); 
            }
            else {}

        }

        else{  
        //Si on est pas dans la période precedente on controle les gelées
          if ($temp<0){
            
          $headers = 'MIME-Version: 1.0'."\r\n";
          $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
          $headers .= 'Gel'."\r\n";
          $destinataire = $email; // Adresse email du destinataire      
          $sujet = 'Alerte gel'; // Titre de l'email
          $contenu = // Contenu du message de l'email (en HTML)
          '<!DOCTYPE html>
                <html xstyle="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <head>
                  <meta name="viewport" content="width=device-width" />
                  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>Alerte gel</title>


                  <style type="text/css">
                    img {
                        max-width: 100%;
                        }
                    body {
                        -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
                          }
                    body {
                        background-color: #f6f6f6;
                          }
                    @media only screen and (max-width: 640px) {
                    body {
                        padding: 0 !important;
                          }
                    h1 {
                      font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                    h2 {
                      font-weight: 800 !important; margin: 20px 0 5px !important;
                        }
                    h3 {
                      font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                    h4 {
                      font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                    h1 {
                      font-size: 22px !important;
                      }
                    h2 {
                      font-size: 18px !important;
                      }
                    h3 {
                      font-size: 16px !important;
                      }
                    .container {
                      padding: 0 !important; width: 100% !important;
                      }
                    .content {
                      padding: 0 !important;
                      }
                    .content-wrap {
                      padding: 10px !important;
                      }
                    .invoice {
                      width: 100% !important;
                      }
                      }
                  </style>
                </head>

                <body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                <table class="body-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                  <td class="container" width="600" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                    <div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                      <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="alert alert-warning" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; border: 1px solid #e9e9e9; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #000; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" bgcolor="#fff" valign="top">
                          <img src="http://api-meteo.craym.eu/images/agramsignature.png" alt="logo agram" width="173px" height="33px" >           
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                          <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            Bonjour <strong style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">'.$nom.'</strong>.-
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; text-align: justify; text-justify: inter-word;"><td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                          Suite à votre inscription sur le site de météo
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            Nous vous informons qu\'il risque de geler dans 3 jours afin que vous preniez vos precautions .
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            Bonne journée à vous , merci.
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            L\'équipe Agram.
                          </td>
                        </tr>
                      </table>
                </td>
              </tr>
          </table>
            <div class="footer" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
              <table width="100%" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <td class="aligncenter content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top"><a href="http://agram.fr/" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">Agram</a>.</td>
                </tr>
              </table>
            </div>
          </div>
        </td>
          <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
        </tr></table></body>
    </html>'; 
      
          // Envoyer l'email
          mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
          echo '<h2>Votre message a été envoyé!</h2>'; // Afficher un message pour indiquer que le message a été envoyé
          // (2) Fin du code pour traiter l'envoi de l'email
          // Enregistrement dans la base de donnée de la nouvelle date
          $sqlQuery = "UPDATE formulaire SET date_enregistrement = '$datetime1'
              WHERE email = '$email'";
          $run = $bdd->prepare($sqlQuery);
          $run->execute(); 
         
                }
                    
        else {}  
        }
   }
   else{}
}
  
  
?>