<?php
error_reporting(E_ALL);
try{
   $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
   $bdd = new PDO('mysql:host=localhost;dbname=apimecra_apim;charset=utf8','apimecra_master','WebAgram28',
   $pdo_options);
  }catch(Exception $e){
    die('Erreur de connexion a la BDD: '.$e->getMessage());
  }

  $nom=isset($_POST['full_name'])?$_POST['full_name']:'';
  $email=isset($_POST['email'])?$_POST['email']:'';

     // Requete :  
  try{
    //préparation de la requete
  $sql ='DELETE FROM formulaire WHERE email="'.$email.'"';
    //execution de la requete 
  $q = array('email' => $email);
  $req = $bdd -> prepare($sql);
  $req -> execute($q);

 }catch(Exception $e){
    echo "<br>-------------------<br> ERREUR ! <br>";
    print_r($params);
    die('<br>Requete Erreur !: '.$e->getMessage());
  }

  	$headers = 'MIME-Version: 1.0'."\r\n";
  	$headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
  	$headers.= "Reply-to: \"Webmaster\" <webmaster@api-meteo.craym.eu>";
  	$headers .= 'Désinscription'."\r\n";
    $destinataire = 'webmaster@api-meteo.craym.eu,'.$email.''; // Adresse email du client et du Webmaster pour avoir une copie    
    $sujet = 'Désincription'; // Titre de l'email
    $contenu = 
      '<!DOCTYPE html>
                <html xstyle="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <head>
                  <meta name="viewport" content="width=device-width" />
                  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>Désinscription aplication météo</title>
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
                            Bonjour <strong style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">'.$nom.'</strong>.
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; text-align: justify; text-justify: inter-word;"><td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                          Votre désincription a bien été prise en compte
                          </td>
                        </tr>            
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            Vous ne recevrez plus de mail de l\'application météo
                          </td>
                        </tr>
                        <tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                          <td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                           Bonne journée à vous, cordialement , merci. 
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
      // Contenu du message de l'email (en HTML)

      // Envoyer l'email
      mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
  
  header("Location:http://api-meteo.craym.eu/index.php");
?>