<?php

include '_headerLogika.php';
include_once('./okvir/korisnik.php');
include_once('./okvir/bazaPodataka.php');
include_once('./okvir/autentikacija.php');
include_once('./okvir/provjeraKorisnika.php');
include './classes/ConfigArray.php';

$naziv = "Moje verzije";
include '_headerHTML.php';
?>
<section id="sadrzaj">
<?php

function mojeverzije() {
    $baza = new baza();
    $ispis="";
    $korisnik = isset($_SESSION["PzaWeb"]) ? $_SESSION["PzaWeb"]->get_id() : "";
    $upit = "select distinct verzije.projekt, verzije.opis,verzije.naziv,do_kad,verzije.datoteka from verzije,projekt,korisnik,posjeduje where projekt.idprojekt=verzije.projekt and projekt.idprojekt=posjeduje.projekt and korisnik='{$korisnik}' order by do_kad desc";
    $rezultat = $baza->selectDB($upit);
    $ispis .= "<caption><h2>Moje verzije</h2></caption>";
    $ispis .= "<thead><tr><th>Opis</th><th>Naziv</th><th>Do kad je aktivna</th><th>Datoteka</th><th>Preuzimanje</th></thead>";
    while (list($projekt, $opis, $naziv,$do_kad, $datoteka) = pg_fetch_array($rezultat)) {
        $ispis.="<tr>";

        $ispis.="<td>$opis</td>";
        $ispis.="<td>$naziv</td>";
        $ispis.="<td>$do_kad</td>";
        $ispis.="<td>$datoteka</td>";
        $ispis.="<td><a href='editiraj.php?akcija=30&projekt=$projekt'>Preuzmi</a></td>";
       


        $ispis.="</tr>";
    }
    $ispis = $ispis . "<tbody>";
    $ispis.="</tbody>";

  
    echo $ispis;
}
?>



 <table id="tablicaOstale">
    <?php

    mojeverzije();
    ?>
 </table>
</section>

<?php

include '_footer.php';
?>
