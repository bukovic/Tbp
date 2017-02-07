<?php
function autentikacija($user, $pass) {

    $result = -1;
    $dbc = pripremiBazuPodataka();

    $sql = "select idkorisnik, ime, prezime, lozinka FROM korisnik where kor_ime = '$user' ";
   
    $rs = pg_query($sql);
    
    if (!$rs) {
        trigger_error("Problem kod upita na bazu podataka!", E_USER_ERROR);
    }

    
    $broj = pg_num_rows($rs);
   
    
    $korisnik = new Korisnik();

   if ($broj == 1) {
        list($id,  $ime, $prezime,$lozinka, ) = pg_fetch_array($rs);
        
        

        if ($lozinka == $pass) {
            $korisnik->set_podaci($id, $user, $ime, $prezime, $lozinka );

            $result = 1;
        } else {
            $result = 0;
        }
    } else {
        $result = -1;
    }

    
    $korisnik->set_status($result);

    
    pg_close($dbc);
    
    

    return $korisnik;
}
?>
