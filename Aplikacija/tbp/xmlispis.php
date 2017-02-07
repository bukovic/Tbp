<?php

session_start();
header("Cache-control: private");
$naziv="Popis projekata";
//connect to the database.
include 'classes/Baza.class.php';
include '_header.php';
$baza = new Baza();
$baza->spojiDB();

//Get the data
$Query = "SELECT idprojekt,naziv, opis, (detalji).svrha,(detalji).kreatori,(detalji).cilj,datoteka FROM projekt";
$Result = pg_query($Query); 
$XML = "";
$NumFields = pg_num_fields($Result);
$XML .= "<?xml version='1.0' encoding='iso-8859-1'?>\n<entries>\n";
$row = true;
while ($row = pg_fetch_row($Result)){
	$XML .= "<entry>";
	for ($i=0; $i < $NumFields; $i++)
    {   
	    $XML .= "<" . pg_field_name($Result, $i) . ">" . $row[$i] . "</" . pg_field_name($Result, $i) . ">";
    }
	$XML .= "</entry>\n";
}
$XML .= "</entries>";


 $oXML = simplexml_load_string($XML);  
 if (!$oXML) {  
      die('xml format not valid or simplexml module missing.');  
 }  
   
 $oXmlRoot = $oXML; // or can be [$oXML->food]  
   
 echo xmlToHtmlTable($oXmlRoot);  
   
   
 function xmlToHtmlTable($p_oXmlRoot) {  
      $bIsHeaderProceessed = false;  
        
      $sTHead = '';  
      $sTBody = '';       
      foreach ($p_oXmlRoot as $oNode) {  
           $sTBody .= '<tr>';  
           foreach ($oNode as $sName => $oValue){  
                if (!$bIsHeaderProceessed) {  
                     $sTHead .= "<th>{$sName}</th>";  
                }  
                $sValue = (string)$oValue;  
                $sTBody .= "<td>{$sValue}</td>";                 
           }  
           $bIsHeaderProceessed = true;  
           $sTBody .= '</tr>';  
      }  
        
      $sHTML = "<table border=1>  
                     <thead><tr>{$sTHead}</tr></thead>  
                     <tbody>{$sTBody}</tbody>  
                </table>";  
      return $sHTML;  
 }  




pg_free_result($Result);


include '_footer.php';
