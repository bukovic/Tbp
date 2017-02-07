<?php

class CRUD {

    private static $korisnikID;
    public static $trenutni;
    private static $tipKorisnika;

    #IMENOVANJA
    public static $imena = array(
        'korisnici' => "Korisnici",
        'prijava' => "Prijava korisnika",
        'odjava' => "Odjava korisnika",
    );

    function __construct($sesijaID = '', $korisnikTip = '') {
        self::$korisnikID = $sesijaID;
        self::$tipKorisnika = $korisnikTip;
    }

    function kreirajOkomitiMeni() {

        $preskociDatoteke = Array("_footer.php", "_header.php", "prijava.php", "odjava.php", "aktivacija.php", "registracija.php", "editiraj.php", "_headerHTML.php", "_headerLogika.php", "error.php");
        $dopušteniLinkovi = Array();
        $sadrzaj = glob("*.php");

      

        #običan korisnik
       
            $dopušteniLinkovi = Array();
            ?>
            <nav class="navigacija">
                <ul>
                    <li><a href="#">Prijavljeni ste <?php echo self::$trenutni ?></a></li>
                    <li><a href="pocetna.php">Početna</a></li>
                  
                    <li><a href="KORISNIK_moji_projekti.php">Moji projekti</a></li>
                    <li><a href="KORISNIK_dodaj_projekt.php">Novi projekt</a></li>
                    <li><a href="KORISNIK_moje_verzije.php">Moje verzije</a></li>
                    <li><a href="KORISNIK_dodjeli_projekt.php">Dodjeli na projekt</a></li>
                    <li><a href="odjava.php">Odjava</a></li>

                </ul>
            </nav>
            <?php
       
     
    }

 

 

}
?>