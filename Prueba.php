<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <select name="Paginas" value="Lista_Capitulos" id="">
            <option>Capitulo 1</option>
            <option>">Capitulo 12</option>
        </select>
        <button onclick="<?php $capitulo=12; ?>">enviar</button>
    </form>

    <?php

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/".$capitulo);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $episodes = json_decode($data);
        echo "<h1 class='Tittle_Cap'>Capítulo&nbsp$episodes->name</h1>";
    ?>
</body>
</html>