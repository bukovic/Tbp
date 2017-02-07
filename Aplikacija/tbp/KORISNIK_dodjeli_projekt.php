<?php
include '_headerLogika.php';
include_once('./okvir/korisnik.php');
include_once('./okvir/bazaPodataka.php');
include_once('./okvir/autentikacija.php');
include_once('./okvir/provjeraKorisnika.php');
include './classes/ConfigArray.php';

if (isset($_POST['dodjelaProjekta'])) {

    $getkorisnik = $korisnik->get_id();

    $Korisnik = $_POST['Korisnik'];
    $Projekt = $_POST['Projekt'];


    #IZVRSAVANJE UPITA 
    $upit = "INSERT INTO posjeduje (projekt,korisnik, datum) VALUES ('{$Projekt}','{$Korisnik}',NOW())";
   
    $baza::updateDB($upit, 'pocetna.php');
}
?>


<!DOCTYPE html>
<?php
$naziv = "Dodjela Projekata";
include '_headerHTML.php';

?>
<section id="sadrzaj">
    <form name="dodjelaProjekta" id="dodjelaProjekta" class="forma" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <br>
        <h3> Dodjela korisnika na projekt</h3>
        
        <label for="Projekt" >Projekt</label>
        <?php
       
        $upit = "SELECT distinct idprojekt,naziv FROM projekt, posjeduje,korisnik where idprojekt=projekt and korisnik=idkorisnik and korisnik='{$korisnik->get_id()}'";
        $result = baza::dohvati($upit);

        #PADAJUCE LISTE
        print " <select id='Projekt' name='Projekt'>";
        print "<option value='' selected> ...  </option>";
        foreach ($result as $kor) {
            print "<option value='" . $kor['idprojekt'] . "'>" . $kor['naziv'] . "</option>";
        }
        print "</select>";
        ?>

        <label for="Korisnik" >Korisnik</label>
        <?php
        $upit = "SELECT prezime,ime,idkorisnik FROM korisnik where idkorisnik != '{$korisnik->get_id()}'";
        $result = baza::dohvati($upit);

        #PADAJUCE LISTE
        print " <select id='Korisnik' name='Korisnik'>";
        print "<option value='' selected> ...  </option>";
        foreach ($result as $kor) {
            print "<option value='" . $kor['idkorisnik'] . "'>" . $kor['ime'] . '&nbsp' . $kor['prezime'] . "</option>";
        }
        print "</select>";
        ?>
        
        <br><br><input id="dodjelaProjekta" class="gumb" name="dodjelaProjekta" type="submit" value="Dodjeli">
    </form>
</section>

<?php
include "_footerHTML.php"
?>


