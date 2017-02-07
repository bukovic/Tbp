<?php
include './_headerLogika.php';



$naziv = "Projekt";
include '_headerHTML.php';

//KORISNIK - projekti
if (isset($_GET['akcija']) && isset($_GET['idprojekt']) ) {

    //ažuriraj tablicu projekti
    if ($_GET['akcija'] == 25) {
        
        $datoteka=$_POST['datoteka'];
        $upit = "UPDATE projekt SET naziv ='{$_POST['naziv']}',opis='{$_POST['opis']}',datoteka=lo_import('{$datoteka}') WHERE idprojekt='{$_GET['idprojekt']}'";

        $baza->updateDB($upit, "KORISNIK_moji_projekti.php");
    }

    //editiraj tablicu projekti
    if ($_GET['akcija'] == 26) {
        $korisnik = isset($_SESSION["PzaWeb"]) ? $_SESSION["PzaWeb"]->get_id() : "";
        $upit = "SELECT distinct idprojekt,naziv,opis,datoteka FROM projekt WHERE idprojekt = '{$_GET['idprojekt']}'";
        $rezultatUpit = $baza->selectDB($upit);
        $naziv = "Editiraj projekt";
        

        if (pg_num_rows($rezultatUpit) == 1) {

            $red = pg_fetch_assoc($rezultatUpit);
            ?>
            <section id="sadrzaj">

                <form id="forma" method="post" name="forma" action="<?php echo $aktivnaSkripta . "?akcija=25&idprojekt=" . $red['idprojekt']; ?>">
                    <br>
                   
                    <h3>Promijena verzije</h3>

                    <label for="naziv" class="poljeLabel" >Naziv :</label>
                    <input type="text" name="naziv"  class="polje"placeholder="Unesite naziv" id="naziv" maxlength="30"value="<?php echo $red['naziv']; ?>" size="20"><br>

                    <label for="opis" class="poljeLabel">Opis :</label>    
                    <input type="text" name="opis"  class="polje"placeholder="Unesite opis" id="opis" maxlength="50" value="<?php echo $red['opis']; ?>"size="20"><br>

                    <label for="datoteka" class="poljeLabel">Datoteka:</label>
                    <input type="text" id="tipGoriva"  class="polje"name="datoteka" maxlength="200" placeholder="Putanja datoteke  " value="<?php echo $red['datoteka']; ?>">

     
                    <br><br><input type="submit" value="Nastavi" class="gumb polje" name="forma">

                </form>
            </section>
            <?php
        }
    }

    // obriši projekt iz tablice
    if ($_GET['akcija'] == 27) {
        $upit = "delete  from projekt where idprojekt= '{$_GET['idprojekt']}'";
        $baza->updateDB($upit, "KORISNIK_moji_projekti.php");
    }
    //preuzmi projekt
      if ($_GET['akcija'] == 28) {
        $upit = "SELECT lo_export(datoteka, 'C:/xampp/tmp/{$_GET['idprojekt']}' || tip) FROM projekt WHERE idprojekt = '{$_GET['idprojekt']}'";
        
        $baza->updateDB($upit, "KORISNIK_moji_projekti.php");
    }
    #prikaz sudionika na projektu
      if ($_GET['akcija'] == 29) {
            $baza = new baza();
    $ispis="";
    $korisnik = isset($_SESSION["PzaWeb"]) ? $_SESSION["PzaWeb"]->get_id() : "";
    $upit = "SELECT distinct naziv, opis,datum, ime, prezime FROM projekt, posjeduje,korisnik where projekt=idprojekt and '{$_GET['idprojekt']}'=projekt and korisnik=idkorisnik order by datum desc";
    $rezultat = $baza->selectDB($upit);
    $ispis .= "<section id='sadrzaj'><caption><h2>Sudionici na projektu</h2></caption>";
    $ispis .= "<table border=1,id='tablicaOstale'><thead><tr><th>Naziv</th><th>Opis</th><th>Datum</th><th>Ime</th><th>Prezime</th></thead>";
    while (list( $naziv, $opis,$datum, $ime,$prezime) = pg_fetch_array($rezultat)) {
        $ispis.="<tr>";

        
        $ispis.="<td>$naziv</td>";
        $ispis.="<td>$opis</td>";
        $ispis.="<td>$datum</td>";
        $ispis.="<td>$ime</td>";
        $ispis.="<td>$prezime</td>";
   


        $ispis.="</tr>";
    }
    $ispis = $ispis . "<tbody>";
    $ispis.="</tbody></table>";

  
    echo $ispis;
    }
        
             
    
  
    
} 

#preuzimanje verzije 
else if (isset($_GET['akcija']) && isset($_GET['projekt']) ) {

 
      if ($_GET['akcija'] == 30) {
        $upit = "SELECT lo_export(verzije.datoteka, 'C:/xampp/tmp/{$_GET['projekt']}' || tip) FROM verzije,projekt WHERE idprojekt = '{$_GET['projekt']}'";
        
        $baza->updateDB($upit, "KORISNIK_moje_verzije.php");
    }
    
} else {
    header("Location: error.php?idGreske=1");
}

include './_footerHTML.php';
