<?php

require ('db_functions.php');

$connection = db_connect();

$query = "SELECT COUNT(id_client) AS nbCli FROM clients WHERE email='{$_GET['login']}'";
$data = exec_query($query, $connection);
$data = $data[0];   //on recupere le massif 0

if ($data['nbCli'] > 0) {
    $query = "SELECT activation FROM clients WHERE email='{$_GET['login']}'";
    $data = exec_query($query, $connection);
    $activation = $data[0]['activation'];   //on recupere le code d'activation
    //$_POST['code'] --> code envoyé via e-mail au client; on check s'il est le mm
    if ($activation == $_GET['code']) {
        //chager la val de l'activation == 1
        $query = "UPDATE clients SET activation='1' WHERE email='{$_GET['login']}'";
        try {
            $result = $connection->query($query); //obj PDO
            $success= $result->execute();
            if($success){
                echo 'Vous avez bien confirmé votre inscription';
                header('Location: index.php?view=registration&confirm=2');
            }else{
                echo 'T\'as fais de la merde!!!!';
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            exit();
        }
    }
} else {
    exit("Error...");
}
?>