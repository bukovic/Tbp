<?php

include '_headerLogika.php';
include_once('./okvir/korisnik.php');
include_once('./okvir/bazaPodataka.php');
include_once('./okvir/autentikacija.php');
include_once('./okvir/provjeraKorisnika.php');
include './classes/ConfigArray.php';

$naziv = "Moji projekti";
include '_headerHTML.php';
?>
<section id="sadrzaj">
<?php

function mojiprojekti() {
    $baza = new baza();
    $ispis="";
    $korisnik = isset($_SESSION["PzaWeb"]) ? $_SESSION["PzaWeb"]->get_id() : "";
    $upit = "SELECT distinct idprojekt,naziv, opis, (detalji).svrha,(detalji).kreatori,(detalji).cilj,datoteka,datum FROM projekt, posjeduje,korisnik where idprojekt=projekt and korisnik='{$korisnik}'order by datum desc";
    $rezultat = $baza->selectDB($upit);
    $ispis .= "<caption><h2>Moji projekti</h2></caption>";
    $ispis .= "<thead><tr><th>Naziv</th><th>Opis</th><th>Svrha</th><th>Kreatori</th><th>Cilj</th><th>Datoteka</th><th>Datum</th><th>Verzija</th><th>Obriši</th><th>Preuzmi</th><th>Osobe</th></thead>";
    while (list($idprojekt, $naziv, $opis, $svrha,$kreatori,$cilj, $datoteka,$datum) = pg_fetch_array($rezultat)) {
        $ispis.="<tr>";

        
        $ispis.="<td>$naziv</td>";
        $ispis.="<td>$opis</td>";
        $ispis.="<td>$svrha</td>";
        $ispis.="<td>$kreatori</td>";
        $ispis.="<td>$cilj</td>";
        $ispis.="<td>$datoteka</td>";
        $ispis.="<td>$datum</td>";
        $ispis.="<td><a href='editiraj.php?akcija=26&idprojekt=$idprojekt'>Nova</a></td>";
        $ispis.="<td><a href='editiraj.php?akcija=27&idprojekt=$idprojekt'>Obriši</a></td>";
        $ispis.="<td><a href='editiraj.php?akcija=28&idprojekt=$idprojekt'>Preuzmi</a></td>";
        $ispis.="<td><a href='editiraj.php?akcija=29&idprojekt=$idprojekt'>Osobe</a></td>";


        $ispis.="</tr>";
    }
    $ispis = $ispis . "<tbody>";
    $ispis.="</tbody>";

  
    echo $ispis;

}
?>



 <table id="tablicaOstale">
    <?php

    mojiprojekti();
    ?>
    </table>
    <input type="button" class="gumbmali" value="Dodaj novi" onclick="window.location.href = 'KORISNIK_dodaj_projekt.php'" />

</section>

<?php

include '_footer.php';
?>
