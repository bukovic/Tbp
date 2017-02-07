<html>
    <head>
        <meta charset="utf-8"> 
        <title><?php echo $naziv; ?></title>

        <link rel="stylesheet" type="text/css" href="css/nbukovic.css">
        <link rel="stylesheet" type="text/css" href="css/nbukovic_mobitel.css" media="screen and (max-width:450px)"> 
        <link rel="stylesheet" type="text/css" href="css/nbukovic_tablet.css" media="screen and (min-width:450px) and (max-width:800px)"> 
        <link rel="stylesheet" type="text/css" href="css/nbukovic_pc.css" media="screen and (min-width:800px) and (max-width:1000px)"> 
        <link rel="stylesheet" type="text/css" href="css/nbukovic_tv.css" media="screen and (min-width:1000px)">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css">  

        

        <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                $('#example').dataTable();
            });
        </script>
    </head>
    <body>
        <header>
            <h3>
                <a href="index.php">
                    <img src="./img/logo1.png" max width="10%" alt="Stack Overflow" align="left" /><br></a>
                Teorija baza podatka 2016
            </h3>

        </header>
        <nav class="navigacija">
            <ul>
                <li><a href="index.php">Početna stranica</a></li>                              
                <li><a href="xmlispis.php">Ispis projekata (xml)</a></li>
                <li><a href="prijava.php">Prijava</a></li>
                <li><a href="registracija.php">Registracija</a></li>
            </ul>
        </nav>