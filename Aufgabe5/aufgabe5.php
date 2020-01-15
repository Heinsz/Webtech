<!DOCTYPE html>
<html lang="eng">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        th {background-color: grey;}
    </style>

    <?php
    function zufzahl($max, $anzahl, $stellen)
    {
        echo "<table class='table'>";
        echo "<thead> <tr>
        <th>Zufallszahlen</th>";
        for ($j=1; $j<=$stellen; $j++)
        {
            if($j==1)
            {
                echo "<th> gerundet um $j Stelle</th>";
            }
            else{
                echo "<th> gerundet um $j Stellen</th>";
            }
        }
        echo "</tr> </thead> <body>";

        for ($i=1; $i<=$anzahl; $i++)
        {
            $zzahl= rand(1,$max);
            if ($zzahl<10000) echo "<tr style='background-color:orange;'>";
            else echo "<tr style='background-color: dodgerblue;'>";

            /*
            $gerundet2=abschneiden($zzahl, 2);
            $gerundet3=abschneiden($zzahl, 3);
            echo "$zzahl $gerundet2 $gerundet3 <br/>";
            */
            echo "<td> $zzahl </td>";
            for ($j=1; $j<=$stellen; $j++)
            {
                echo "<td>".abschneiden($zzahl, $j)." </td>";
            }
        }
        echo "</table>";
    }

    function abschneiden($zahl, $stellen=2)
    {
        $base=pow(10, $stellen);
        return $zahl - ($zahl % $base);
    }

    ?>
</head>

<body class="container">
<h1>Zufallszahlen</h1>

<?php  zufzahl(20000, 20, 3); ?>



</body>
