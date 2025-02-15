<?php
include "./config.php";

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", EMAIL_SEND)) {
    $passage_ligne = "\r\n";
} else {
    $passage_ligne = "\n";
}

if (isset($_POST)) {

 
    $montant = $_POST["montant"] ? $_POST["montant"] : null;
    $raison = $_POST["raison"] ? $_POST["raison"] : null;
    $nom = $_POST["nom"] ? $_POST["nom"] : null;
    $profession = $_POST["profession"] ? $_POST["profession"] : null
    $tel = $_POST["tel"] ? $_POST["tel"] : null;
    $email = $_POST["email"] ? $_POST["email"] : null;
}


$message_txt = "Investisseur";
$message_html = "<!DOCTYPE html> <html lang='fr'> <head> <meta charset='UTF-8'> <title>Nouveau Investisseur</title> </head> <body> <h1>Détails</h1> <i>Montant</i> : $montant <br> <i>Raison</i> : $raison <br> <i>nom</i> : $nom <br> <i>profession</i> : $profession <br>  <i>tel</i> : $tel <br> <i>email</i> : $email <br> </body> </html>";
//==========

$boundary = "-----=" . md5(rand());
//==========

$sujet = "Investisseur";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"Smart Investment\"<" . EMAIL_RES . ">" . $passage_ligne;
$header .= "Reply-to: \"Smart Investment\" <" . EMAIL_RES . ">" . $passage_ligne;
$header .= "MIME-Version: 1.0" . $passage_ligne;
$header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne . "--" . $boundary . $passage_ligne;
//=====Ajout du message au format texte.
$message .= "Content-Type: text/plain; charset=\"UTF-8\"" . $passage_ligne;
$message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
$message .= $passage_ligne . $message_txt . $passage_ligne;
//==========
$message .= $passage_ligne . "--" . $boundary . $passage_ligne;
//=====Ajout du message au format HTML
$message .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
$message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
$message .= $passage_ligne . $message_html . $passage_ligne;
//==========
$message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
$message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
mail(EMAIL_SEND, $sujet, $message, $header);
mail(EMAIL_SEND2, $sujet, $message, $header);


//==========

header('Location: ' . $_SERVER["HTTP_REFERER"]).'?contact=success';
