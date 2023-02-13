<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    /**
     * 1. Importez le contenu du fichier user.sql dans une nouvelle base de données.
     * 2. Utilisez un des objets de connexion que nous avons fait ensemble pour vous connecter à votre base de données.
     *
     * Pour chaque résultat de requête, affichez les informations, ex:  Age minimum: 36 ans <br>   ( pour obtenir une
     * information par ligne ).
     *
     * 3. Récupérez l'age minimum des utilisateurs. ok
     * 4. Récupérez l'âge maximum des utilisateurs. ok
     * 5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT(). ok
     * 6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.
     * 7. Récupérez la moyenne d'âge des utilisateurs.
     * 8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).
     */

    // TODO Votre code ici, commencez par require un des objet de connexion que nous avons fait ensemble.
    try {
        $server= 'localhost';
        $db = 'exo_196';
        $user = 'root';
        $pass = '';

        $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pass);
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $bdd->prepare("SELECT MIN(age) as minimum FROM user");

        $state = $stmt->execute();
        if($state) {
            $min = $stmt->fetch();
            echo "Le plus petit âge trouvé est de " . $min['minimum'] . ' ans';
        } else {
            echo 'error';
        }

        echo "<br><br>";
        $stmt2 = $bdd->prepare("SELECT MAX(age) as maximum FROM user");

        $state2 = $stmt2->execute();
        if($state2) {
            $min = $stmt2->fetch();
            echo "Le plus grand âge trouvé est de " . $min['maximum'] . ' ans';
        } else {
            echo 'error';
        }

        echo "<br><br>";
        $stmt3 = $bdd->prepare("SELECT count(*) as number FROM user");

        $state3 = $stmt3->execute();
        if($state3) {
            $count = $stmt3->fetch();
            echo "Il existe " . $count['number'] . ' utilisateurs dans la base de données';
        } else {
            echo 'error';
        }

        echo "<br><br>";
        $stmt4 = $bdd->prepare("SELECT count(*) as number FROM user WHERE numero >= 5");

        $state4 = $stmt4->execute();
        if($state4) {
            $count = $stmt4->fetch();
            echo "Il existe " . $count['number'] . ' utilisateurs dans la base de données dont le numero de rue est 
            supérieur ou égal à 5';
        } else {
            echo 'error';
        }

        echo "<br><br>";

        $stmt5 = $bdd->prepare("SELECT AVG(age) as moyenne_âge FROM user");
        $state5 = $stmt5->execute();
        if($state5) {
            $average = $stmt5->fetch();
            echo "La moyenne d'âge de tous les utiliateurs est de " . $average['moyenne_âge'];
        } else {
            echo 'error';
        }

        echo "<br><br>";
        $stmt6 = $bdd->prepare("SELECT SUM(numero) as somme_âge FROM user");

        $state6 = $stmt6->execute();
        if($state6) {
            $sum = $stmt6->fetch();
            echo "La somme de tous les numéros de rue est de " . $sum['somme_âge'];
        } else {
            echo 'error';
        }
    }




    catch(PDOException $e) {
        echo $e->getMessage();
    }


    ?>
</body>
</html>

