<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/2");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $episodes = json_decode($data);
        $caracter = $episodes->characters;
        $tamaño = sizeof($caracter);
        for($i = 0; $i < $tamaño; $i++){
            $chs = curl_init();
            curl_setopt($chs, CURLOPT_URL, "$caracter[$i]");
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chs, CURLOPT_HEADER, 0);
            $datas = curl_exec($chs);
            curl_close($chs);
            $personajes = json_decode($datas);
            echo "<img src='$personajes->image'>";

        }
    ?>
</body>
</html>