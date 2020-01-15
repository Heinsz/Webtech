<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <title>Aufgabe 6</title>
    <style>
        button {margin-top: 10px;}
        button>a:hover{text-decoration: none; color: white;}
    </style>
    <?php
        require_once "./mockdataarray.php";
    ?>
</head>
<body>

<div class="container">
    <div style="text-align: right">
        <button type="button" class="btn btn-secondary btn-success">
            <a href="../index.html" alt="zurück" style="color: white;">zurück</a>
        </button>
    </div>
    <h1>Teilnehmerinnen</h1>
    <?php
    if (isset($_GET['id'])):    /*wenn das Get-Array befüllt ist*/
        $id=$_GET['id'];
        echo "<form action='./aufgabe6.php' method='post'>   <!--wird mit Click auf Button gesendet in ein Post-Array $_POST 'vorname-->
            <div class='form-group row'>
                 <label for='vorname' class='col-2'>Vorname</label>
                 <input type='text' class='form-control col-10' name='vorname' value='".$members[$id][0]."' />  <!--wir wollen im Textfeld schon einen womöglich zu ändernden Namen haben, darum Zugriff auf members-Array, Zugriff auf die id, die wir mit edit geklickt haben-->
            </div>
            <div class='form-group row'>
                 <label for='nachname' class='col-2'>Nachname</label>
                 <input type='text' class='form-control col-10' name='nachname' value='".$members[$id][1]."' />  <!--wir wollen im Textfeld schon einen womöglich zu ändernden Namen haben, darum Zugriff auf members-Array, Zugriff auf die id, die wir mit edit geklickt haben-->
            </div>
            <div class='form-group row'>
                 <label for='email' class='col-2'>Email</label>
                 <input type='text' class='form-control col-10' name='Email' value='".$members[$id][2]."' />  <!--wir wollen im Textfeld schon einen womöglich zu ändernden Namen haben, darum Zugriff auf members-Array, Zugriff auf die id, die wir mit edit geklickt haben-->
            </div>
            <input type='hidden' name='id' value='".$id."' />    <!--wir haben im Post-Array Schlüssel vergeben (über name) und brauchen die id, um alles zu speichern. ID soll aber nicht geändert werden und interessiert auch niemanden. Darum hidden input.-->
            <button type='submit' class='btn btn-primary'>Save changes</input> 
            </form>
";
    else :     /*sonst die Tabelle ausgeben. Oder auch: Wenn es ein Post-Array gibt, dann Daten speichern: */

          if (isset($_POST['id'])):

                $id=$_POST['id'];           /*erstmal Werte auslesen, ist aber nicht nötig*/
                $vorname=filter_var($_POST['vorname'], FILTER_SANITIZE_STRING);  /*Filter prüft, ob die Eingabe einem String entspricht*/
                $nachname=filter_var($_POST['nachname'], FILTER_SANITIZE_STRING);
                $email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $members[$id][0]=$vorname;
                $members[$id][1]=$nachname;
                $members[$id][2]=$email;       /*hier sind die Werte zwar im Array, aber nicht in der Ursprungsdatei, darum reinschreiben*/

                $datei=fopen("./mockdataarray.php", "r+");
                $output='<?php $members='.var_export($members, true).'; ?>'; /*weil wir uns eine php-Variable definieren, darum auch php..*/
                fwrite($datei, $output);
                fclose($datei);
          endif;

    /*  die print_r()-Funktion ist nur zur Kontrolle, ob das $members-Array
        befüllt ist. Kommentieren Sie diese Anweisung aus.
        Das Auslesen des $members-Array erfolgt dann unten in der Tabelle

    print_r($members);

        in diesem php-Tag könnten Sie stattdessen prüfen, ob das $_GET-Array
        oder das $_POST-Array befüllt ist
        falls $_GET-Array, dann Formular mit den passenden Werten
        falls $_POST-Array, dann das Array ändern und in die Datei schreiben
        In die Datei schreiben:
            $datei = fopen("./mockdataarray.php", "r+");
            $output = '<?php $members='.var_export($members, true).'; ?>';
            fwrite($datei, $output);
            fclose($datei);
    */
    ?>
    <table class="table table-striped">
        <thead>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>E-Mail</th>
        <th>Edit</th>
        </thead>
        <tbody>

        <!-- hier die einzelnen Zeilen einfügen
             jede Zeile ist ein Array aus dem 2-dimensionalen
             $members-Array
             -->
        <?php
            foreach($members as $id => $member)
            {
                echo "<tr>";
                echo "<td>".$member[0]."</td>";
                echo "<td>".$member[1]."</td>";
                echo "<td>".$member[2]."</td>";
                echo "<td> <a href='./aufgabe6.php?id=".$id."'>edit</a></td>";
                echo "</tr>";
            }
        ?>
        </tbody>

    </table>
    <?php
    endif; ?>  <!-- schließt das if/else von oben -->
</div>
</body>
</html>