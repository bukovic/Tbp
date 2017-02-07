                                                                                                                                                                                                                            <?php

class baza {
    /*
     * Podaci za spajanje na bazu ARKA
     */

    const server = "localhost";
    const baza = "postgres";
    const korisnik = "postgres";
    const lozinka = 'nikola';
    
  

    /*
     * FUNKCIJE BAZE
     */

    function spojiDB() {
        /*
         * Spajanje na bazu
         */
        
       
        $mysqli =  pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=nikola")or die('Neuspjesno');
       
        return $mysqli;
    }

    function prekiniDB($veza) {
        
        pg_close($veza);
    }

    function selectDB($upit) {

        $veza = self::spojiDB();
        
       
        $rezultat = pg_query($upit) or trigger_error("Greška kod upita: {$upit} - Greška: " . $veza->error . '' . E_USER_ERROR);

        if (!$rezultat) {
            $rezultat = null;
        }

        self::prekiniDB($veza);
        return $rezultat;
    }

    function updateDB($upit, $skripta = '') {
        $veza = self::spojiDB();
        if ($rezultat = pg_query($upit)) {

            self::prekiniDB($veza);
            #$veza->close();
            if ($skripta != '') {
                header("Location: {$skripta}");
            } else {
                return $rezultat;
            }
        } else {
            echo "Pogreška: " . $veza->error;
           #echo "Pogreška: " . pg_errormessage($veza);
            self::prekiniDB($veza);
            return $rezultat;
        }
    }



    function dohvati($upit) {
        $podaci = array();
        
        $dbc=pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=nikola")or die('Neuspjesno');
        if ($dbc) {
            $rs = pg_query($dbc, $upit) or die('nesupjesno');
            if (!$rs) {
                echo "Problem kod postavljanja upita bazi podataka!<br>";
                
                exit;
            } else {
                while ($row = pg_fetch_assoc($rs)) {
                    $podaci[] = $row;
                }
            }
        } else {
            echo "Neuspjelo spajanje na bazu podataka" . pg_errormessage($dbc);
        }
        pg_close($dbc);
        return $podaci;
    }

}

?>