<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Icon" href="./images/R&M.ico"/>
    <link rel="stylesheet" href="Styles.css">
    <title>Episodios</title>
</head>
<body>
    <nav class="navbar">
        <a href="./index.php" class="logo"><img class="logo_img"src="./images/logo.png" alt=""></a>
        <input class="checkbox" type="checkbox" id="toggler">
        <label for="toggler"><img src="./images/menu.png" class="hambuergesa"></label>
        <div class="menu">
            <ul class="list">
                <li class="opcion"><a href="./Characters.php">Personajes</a></li>
                <li class="opcion"><a href="./episodes.php">Capitulos</a></li>
            </ul>
        </div>
    </nav>

    <section class="botones">
        <div>
            <?php
                $check = 1;
                if(isset($_GET["check"])){
                    $check = $_GET["check"] - 1;
                } else{
                    $check = $_GET["descontar"] = 1;
                    $check = $_GET["check"] = 0; 
                } 
        
                if($_GET["check"] > 0){
                    echo "<form action='episodes.php' method='get'>
                            <input class='descontar' type='submit' name='check' value={$check}>
                        </form>";   
                } 
            ?>
        </div>
        <div>
            <?php
                $check = 1;
                if(isset($_GET["check"])){
                    $check = $_GET["check"] + 1;
                } else{
                    $check = $_GET["contador"] = 1;
                } 
        
                if($check < 51){
                    echo "<form action='episodes.php' method='get'>
                            <input class='contador' type='submit' name='check' value={$check}>
                        </form>";   
                }
            ?>
        </div>
    </section>

    <section class="contenido">
        <?php
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/".$check);
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
        <div class="cards">
            <div class="Conteiner_Cap">
                <div class="Characters_Cap">
                    <?php
                        $cont = 0;
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
                                echo "<div class='Characters_Cap'>";
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="characters_randoms">
                <div class="Recomendaciones">
                    <h1 class="Tittle_Recomendaciones">Recomendaciones</h1>
                </div>
                <?php
                    $numero1 = rand(1, 826);
                    $numero2 = rand(1, 826);
                    $numero3 = rand(1, 826);
                    $numero4 = rand(1, 826);
                    $numero5 = rand(1, 826);
                    $aleaotrio = "https://rickandmortyapi.com/api/character/"."[".$numero1.",".$numero2.",".$numero3.",".$numero4.",".$numero5."]";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $aleaotrio);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    $data = curl_exec($ch);
                    curl_close($ch);
                    $personajes = json_decode($data);
                    foreach($personajes as $personaje){
                        echo "<div class='characters_card characters_card-Random'>";
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
        </div>
    </section>
</body>
</html>