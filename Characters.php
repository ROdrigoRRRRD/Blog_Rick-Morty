<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Icon" href="./images/R&M.ico"/>
    <link rel="stylesheet" href="Styles.css">
    <title>Personajes</title>
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
                    echo "<form action='Characters.php' method='get'>
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
        
                if($check < 42){
                    echo "<form action='Characters.php' method='get'>
                            <input class='contador' type='submit' name='check' value={$check}>
                        </form>";   
                }
            ?>
        </div>
    </section>
    <section class="Personajes">
        <?php
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/character/?page=".$check);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            $datos = json_decode($data);
            $Personajes = $datos->results;
            echo "<div class='Tittle_Characters'>";
            echo "<h1 class='Tittle-Page'>Pagína de Personajes:&nbsp$check</h1>";
            echo "</div>";
        ?>
        <div class="Characters_Cap">
            <?php
                $cont = 0;
                foreach($Personajes as $personaje){
                    echo "<div class='characters_card'>";
                    echo "<img class='characters_img' src='$personaje->image'>";
                    echo "<div class='characters_Inf'>";
                    echo "<h1 class='characters-Name'>$personaje->name</h1>";
                    if($personaje->status == "Alive"){//
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
    </section>
</body>
</html>
