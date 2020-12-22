<?php
    require_once("connect.php");

    $connection = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    for($i=1; $i<936; $i++) {
        $stmt = $connection->prepare("SELECT `variante` FROM `intrebari` WHERE id=:id");
        $stmt->bindParam(":id", $i);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $str = $result['variante'];

        $str = str_replace("<p id=", "<div id=", $str);
        $str = str_replace("</p>", "</p></div>", $str);
        $str = str_replace("<b>", "<strong>", $str);
        $str = str_replace("</b>", "</strong><p>", $str);

        $stmt = $connection->prepare("UPDATE `intrebari` SET `variante`=:strr WHERE id=:id");
        $stmt->bindParam(":strr", $str);
        $stmt->bindParam(":id", $i);
        $stmt->execute();
    }

    echo "Done";

    
?>