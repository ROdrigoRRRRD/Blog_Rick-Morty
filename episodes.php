<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="Icon" href="./images/R&M.ico"/>
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
        <a href="./index.php" class="logo"><img class="logo_img"src="./images/logo.png" alt=""></a>
        <input class="checkbox" type="checkbox" id="toggler">
        <label for="toggler"><img src="./images/menu.png" class="hambuergesa"></label>
        <div class="menu">
            <ul class="list">
                <li class="opcion"><a href="#">Personajes</a></li>
                <li class="opcion"><a href="./episodes.php">Capitulos</a></li>
                <li class="opcion"><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>
    <div class="recommendations-characters">
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
            $personajes = json_decode($data);
            foreach($personajes as $personaje){
                echo "<div class='characters_card'>";
                echo "<img class='characters_img' src='$personaje->image'>";
                echo "<div class='characters_Inf'>";
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
                if($personaje->origin->name == "unknown"){
                    $personaje->origin->name = "Desconocido";
                }
                echo "<p>Origen:&nbsp".$personaje->origin->name."</p>";
                echo "</div>";
                echo "</div>";
            }
        ?> 
    </div>
</body>
</html>