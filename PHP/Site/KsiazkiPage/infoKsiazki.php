<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Zobacz książke</title>
    <?php 
    require_once(__DIR__.'\..\Untitles\connection.php'); 
    require_once(__DIR__.'\..\Untitles\Tables\Ksiazki\classKsiazki.php');
    ?>
    <link rel="stylesheet" type="text/css" media="screen" href="../../../CSS/infoKsiazki.css" />
</head>

<body>
    <?php
        $path = '/GitKraken/Sklep_z_ksiazkami/PHP/Site/Okladki'; //Jeśli coś się psuje z okładka to tu
        $name = "/okladkaID";
        $default_name = "/default";
        $source = '';
        $errMsg = '';
        if(empty($_GET['product'])){
            $errMsg = 'Nie podano produktu';
            echo $errMsg;
            die();
        }

        $query = "SELECT ksiazki.Id, ksiazki.Tytul, ksiazki.Autor,ksiazki.Opis, gatunki.Gatunek,ksiazki.Data_wydania,wydawnictwa.Wydawca AS Wydawnictwo,ksiazki.Ocena_ksiazki,ksiazki.Cena,ksiazki.Sprzedanych FROM ((ksiazki INNER JOIN gatunki ON gatunki.Id = ksiazki.Gatunek) INNER JOIN wydawnictwa ON wydawnictwa.Id = ksiazki.Wydawnictwo) WHERE ksiazki.Id = '".$_GET['product']."'";
        if(!($result = $connection->query($query))){
            $errMsg = 'Błąd bazy danych';
            $result->close();
        }else if($result->num_rows == 0){
            $errMsg = 'Taka książka nie istnieje';
            $result->close();
        }else{
            $row = $result->fetch_assoc();
            $result->close();
            $id = $row['Id'];
            $tytul = $row['Tytul'];
            $autor = $row['Autor'];
            $opis = $row['Opis'];
            $gatunek = $row['Gatunek'];
            $data = $row['Data_wydania'];
            $wydawnictwo = $row['Wydawnictwo'];
            $ocena = $row['Ocena_ksiazki'];
            $cena = $row['Cena'];
            $sprzedanych = $row['Sprzedanych'];
        }
        if($errMsg != ''){
            echo $errMsg;
            die();
        }
        clearstatcache();
        if(file_exists("C:\\xampp\\htdocs\\GitKraken\\Sklep_z_ksiazkami\\PHP\\Site\\Okladki\\okladkaID".$id.'.jpg')){
            $source = $path.$name.$id.'.jpg';
        }else{
            $source = $path.$default_name.'.png';
        }
        $self = htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'utf-8');
        echo <<<END
        <div class='ksiazkiInfo'>
        <img src='$source' height="30" width="30">
        <div id="tytul"><h2>$tytul<h2></div>
        <div id="autor"><h3>$autor<h3></div>
        <div id="opis">$opis</div>
        <div id="gatunek">$gatunek</div>
        <div id="data">$data</div>
        <div id="wydawnictwo">$wydawnictwo</div>
        <div id="ocena">$ocena</div>
        <div id="cena">$cena</div>
        <div id="sprzedane">$sprzedanych</div>
        <button type="button" onclick="window.location.href='$self?cart=add&product=$id'">DO KOSZYKA</button>
        </div>
END;
    ?>
</body>

</html>