<?php
        if (!(isset ($_POST['Envoyer']))){
            //On récupère les valeurs entrées par l'utilisateur :
            $lastname=$_POST['lastname'];
            $firstname=$_POST['firstname'];
            $password=$_POST['password'];
            //On construit la date d'aujourd'hui
            //strictement comme sql la construit
            //$today = date("y-m-d");
            //On se connecte
            $DB_NAME = "insertion_sql";
            $DB_DSN = "mysql:host=127.0.0.1:3308;dbname=".$DB_NAME;
            $DB_USER = "root";
            $DB_PASSWORD = "";
            try {
                $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query= $bdd->prepare("SELECT nom, prenom, mot_de_passe FROM user WHERE nom=:nom AND prenom=:prenom AND mot_de_passe=:mot_de_passe");
                $query->execute(array(':nom' => $lastname, ':prenom' => $firstname, ':mot_de_passe' => $password));
                $query->closeCursor();

                $query= $bdd->prepare("INSERT INTO user (nom, prenom, mot_de_passe) VALUES (:nom, :prenom, :mot_de_passe)");
                $query->execute(array(':nom' => $lastname, ':prenom' => $firstname, ':mot_de_passe' => $password));
            return (0);
        } catch (PDOException $e) {
    }
}
?>
