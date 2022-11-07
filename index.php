<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Icon" href="./images/R&M.ico"/>
    <link rel="stylesheet" href="./Styles.css">
    <title>Blog:Rick and Morty</title>
</head>
<body>
    <?php
        $numero1 = rand(1, 826);
        $numero2 = rand(1, 826);
        $numero3 = rand(1, 826);
        $aleaotrio = "https://rickandmortyapi.com/api/character/"."[".$numero1.",".$numero2.",".$numero3."]";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $aleaotrio);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
    ?>

    <section class="recommendations-characters">
        <?php

            $personajes = json_decode($data);

            foreach($personajes as $personaje){
                echo "<div class='characters_card'>";
                echo "<img class='characters_img' src='$personaje->image'>";
                echo "<div class='characters-Inf'>";
                echo "<h1 class='characters-Name'>$personaje->name</h1>";
                if($personaje->status == "Alive"){
                    $personaje->status = "Vivo";
                } else {
                    $personaje->status = "Muerto";
                }
                echo "<p>Estado:&nbsp$personaje->status</p>";
                if($personaje->type == NULL){
                    $personaje->type = "Humano";
                }
                echo "<p>Tipo:&nbsp$personaje->type</p>";
                if($personaje->gender == "Male"){
                    $personaje->gender = "Masculino";
                } elseif ($personaje->gender == "Female"){
                    $personaje->gender = "Femenino";
                } else {
                    $personaje->gender = "Desconocido";
                }
                echo "<p>Genero:&nbsp$personaje->gender</p>";
                echo "<p>Id:&nbsp$personaje->id</p>";
                echo "<p> $personaje->origin</p>";
                echo "</div>";
                echo "</div>";
            }
        ?> 
    </section>
</body>
</html>

