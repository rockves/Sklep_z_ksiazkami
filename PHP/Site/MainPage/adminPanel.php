<div class="adminPanel">
    <div class="functionList">
        <dl>
            <dt>Książki</dt>
            <dd><a href="mainPage.php?table=Ksiazki&action=add">Dodaj książkę</a></dd>
            <dd><a href="mainPage.php?table=Ksiazki&action=delete">Usuń książkę</a></dd>
            <dd><a href="mainPage.php?table=Ksiazki&action=update">Edytuj książkę</a></dd>
            <dt>Gatunki</dt>
            <dd><a href="mainPage.php?table=Gatunki&action=add">Dodaj gatunek</a></dd>
            <dd><a href="mainPage.php?table=Gatunki&action=delete">Usuń gatunek</a></dd>
            <dd><a href="mainPage.php?table=Gatunki&action=update">Edytuj gatunek</a></dd>
            <dd><a href="mainPage.php?table=Gatunki&action=list">Wyświetl gatunki</a></dd>
            <dt>Wydawnictwa</dt>
            <dd><a href="mainPage.php?table=Wydawnictwa&action=add">Dodaj wydawce</a></dd>
            <dd><a href="mainPage.php?table=Wydawnictwa&action=delete">Usuń wydawce</a></dd>
            <dd><a href="mainPage.php?table=Wydawnictwa&action=update">Edytuj wydawce</a></dd>
            <dd><a href="mainPage.php?table=Wydawnictwa&action=list">Wyświetl wydawców</a></dd>
            <dt>Sposoby płatności</dt>
            <dd><a href="mainPage.php?table=SposobyPlatnosci&action=add">Dodaj sposób płatności</a></dd>
            <dd><a href="mainPage.php?table=SposobyPlatnosci&action=delete">Usuń sposób płatności</a></dd>
            <dd><a href="mainPage.php?table=SposobyPlatnosci&action=update">Edytuj sposób płatności</a></dd>
            <dd><a href="mainPage.php?table=SposobyPlatnosci&action=list">Wyświetl sposoby płatności</a></dd>
            <dt>Sposoby wysyłki</dt>
            <dd><a href="mainPage.php?table=SposobyWysylki&action=add">Dodaj sposób wysyłki</a></dd>
            <dd><a href="mainPage.php?table=SposobyWysylki&action=delete">Usuń sposób wysyłki</a></dd>
            <dd><a href="mainPage.php?table=SposobyWysylki&action=update">Edytuj sposób wysyłki</a></dd>
            <dd><a href="mainPage.php?table=SposobyWysylki&action=list">Wyświetl sposoby wysyłki</a></dd>
            <dt>Użytkownicy</dt>
            <dd><a href="mainPage.php?table=Uzytkownicy&action=add">Dodaj użytkownika</a></dd>
            <dd><a href="mainPage.php?table=Uzytkownicy&action=delete">Usuń użytkownika</a></dd>
            <dd><a href="mainPage.php?table=Uzytkownicy&action=update">Edytuj użytkownika</a></dd>
            <dd><a href="mainPage.php?table=Uzytkownicy&action=list">Wyświetl użytkowników</a></dd>
            <dt>Zamówienia</dt>
            <dd><a href="mainPage.php?table=Zamowienia&action=delete">Usuń zamówienie</a></dd>
            <dd><a href="mainPage.php?table=Zamowienia&action=update">Edytuj zamówienie</a></dd>
            <dd><a href="mainPage.php?table=Zamowienia&action=list">Wyświetl zamówienia</a></dd>
        </dl>
    </div>
</div>
<?php 
 //if(!empty($_GET['table']) && !empty($_GET['action'])){if($_GET['table'] == 'Ksiazki' && $_GET['action'] == 'add'){ echo 'class="curAdminFunctionA"'; }else{ echo 'class="adminFunctionA"'; }} 
 ?>