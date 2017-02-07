<?php
include './classes/Baza.class.php';
include './classes/CRUD.class.php';

$baza = new baza();
$baza->spojiDB();
$naziv="Pocetna";
include '_header.php';
?>

<!DOCTYPE html>

<section id="sadrzaj">
    <article>
        <h2>Dobro došli na stranice verzioniranja</h2>
    </article>

    <article class="biografija">

        <p> Sustav služi za verzioniranje vaših projekata. 

        </p>
       


    
</section>
<?php
include '_footer.php';
?>

