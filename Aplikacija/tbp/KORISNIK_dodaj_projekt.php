<?php
include '_headerLogika.php';
include_once('./okvir/korisnik.php');
include_once('./okvir/bazaPodataka.php');
include_once('./okvir/autentikacija.php');
include_once('./okvir/provjeraKorisnika.php');
include './classes/ConfigArray.php';

if (isset($_POST['forma'])) {

    $naziv = $_POST['naziv'];
    $opis = $_POST['opis'];
    
    $kreator=$_POST['kreator'];
    $svrha=$_POST['svrha'];
    $cilj=$_POST['cilj'];
    $datoteka = $_POST['datoteka'];
    $tip = $_POST['tip'];
    $getKorisnik = $korisnik->get_id();

    $greske = "";

    if ($greske == "") {

        $upit = "INSERT INTO projekt(naziv,opis,detalji,datoteka,tip) VALUES('{$naziv}','{$opis}',ROW('{$svrha}','{$kreator}','{$cilj}'),lo_import('{$datoteka}'),'{$tip}')";
        $upit1 = "INSERT INTO posjeduje  VALUES ((SELECT idprojekt from projekt order by idprojekt desc limit 1),'{$korisnik->get_id()}',NOW())";
    
        $baza::updateDB($upit,'pocetna.php');
        $baza::updateDB($upit1,'pocetna.php');
       
    }
}
$naziv = "Novi projekt";
include '_headerHTML.php';

?>

<section id="sadrzaj">

    <form id="forma" method="post" name="forma" action="<?php echo $_SERVER['PHP_SELF'];
        ?>">
        <br>
    
        <h3>Dodaj projekt</h3>
        

        <label for="naziv" class="poljeLabel" >Naziv :</label>
        <input type="text"  class="polje" name="naziv" placeholder="Unesite naziv" id="marka" maxlength="30" size="20"><br>

        <label for="opis"  class="poljeLabel">Opis :</label>    
        <input type="text"  class="polje" name="opis" placeholder="Unesite opis" id="opis" maxlength="50" size="20"><br>

        <label for="kreator"  class="poljeLabel">Kreator :</label>    
        <input type="text"  class="polje" name="kreator" placeholder="Unesite kretore" id="kreator" maxlength="50" size="20"><br>

        <label for="svrha"  class="poljeLabel">Svrha :</label>    
        <input type="text" class="polje"  name="svrha" placeholder="Unesite svrhu" id="svrha" maxlength="50" size="20"><br>

        <label for="cilj"  class="poljeLabel">Cilj:</label>    
        <input type="text" class="polje"  name="cilj" placeholder="Unesite cilj" id="cilj" maxlength="50" size="20"><br>

        <label for="datoteka" class="poljeLabel">Datoteka :</label>    
        <input type="text" class="polje"  name="datoteka" placeholder="Unesite putanju" id="datoteka" maxlength="50" size="20"><br>
        
        <label for="tip"  class="poljeLabel">Tip:</label>    
        <input type="text" class="polje"  name="tip" placeholder="Unesite tip" id="tip" maxlength="50" size="20"><br>


        <input type="submit" class="gumb polje"  value="Nastavi" class="gumb" name="forma">

        </form>
        </section>
        <?php
        include "_footerHTML.php";
        ?>
