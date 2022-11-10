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
    <nav class="navbar" static-top>
        <a href="" class="logo"><img class="logo_img"src="./images/logo.png" alt=""></a>
        <input class="checkbox" type="checkbox" id="toggler">
        <label for="toggler"><img src="./images/menu.png" class="hambuergesa"></label>
        <div class="menu">
            <ul class="list">
                <li class="opcion"><a href="Characters.php">Personajes</a></li>
                <li class="opcion"><a href="./episodes.php">Capitulos</a></li>
                <li class="opcion"><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <section class="Botones">
        <div>
            <a class="texto_opcion" href="./characters.php"><button class="Boton_Opcion">Personajes</button></a>
        </div>
        <div>
            <a class="texto_opcion" href="./episodes.php"><button class="Boton_Opcion">Capitulos</button></a> 
        </div>
    </section>

    <section class="cointeiner_cards">
        <?php
            $cont = 0;;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/1");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            $episodes = json_decode($data);
            $caracter = $episodes->characters;
            $tamaño = sizeof($caracter);
            echo "<h1 class='Tittle_Cap'>Capítulo&nbsp$episodes->episode</h1>";
            echo "<h1 class='Tittle_Cap'>$episodes->name</h1>";
            echo "<h4 class='air-Date'>$episodes->air_date</h4>";
        ?>  
        <div class="Characters_Episodes">
            <?php
                for($i = 0; $i < $tamaño; $i++){
                    $chs = curl_init();
                    curl_setopt($chs, CURLOPT_URL, "$caracter[$i]");
                    curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($chs, CURLOPT_HEADER, 0);
                    $datas = curl_exec($chs);
                    curl_close($chs);
                    $personajes = json_decode($datas);
                    echo "<div class='characters_card'>";
                    echo "<img class='characters_img' src='$personajes->image'>";
                    echo "<div class='characters_Inf'>";
                    echo "<h1 class='characters-Name'>$personajes->name</h1>";
                    if($personajes->status == "Alive"){//
                        $personajes->status = "Vivo";
                    } else {
                        $personajes->status = "Muerto";
                    }
                    echo "<p>Estado:&nbsp$personajes->status</p>";
                    if($personajes->type == NULL){
                    $personajes->type = "Humano";
                    }
                    echo "<p>Tipo:&nbsp$personajes->type</p>";
                    if($personajes->gender == "Male"){
                        $personajes->gender = "Masculino";
                    } elseif ($personajes->gender == "Female"){
                        $personajes->gender = "Femenino";
                    } else {
                        $personajes->gender = "Desconocido";
                    }
                    echo "<p>Genero:&nbsp$personajes->gender</p>";
                    if($personajes->origin->name == "unknown"){
                        $personajes->origin->name = "Desconocido";
                    }
                    echo "<p>Origen:&nbsp".$personajes->origin->name."</p>";
                    echo "</div>";
                    echo "</div>";
                    $cont++;
                    if($cont == 4){
                        $cont = 0;
                        echo "</div>";
                        echo "<br></br>";
                        echo "<div class='Characters_Episodes'>";
                    }
                }
            ?>
        </div>
    </section>
    <script src="./main.js"></script>
</body>
</html>

