<html><title>MoonOnThisDay~AGC007</title></html>

<?php

if($_GET['Date'] != "")#~GetDate
{
    $Date = $_GET['Date'];
    MoonOnThisDay($Date);
}

#-------------- AGC007 --------------#

function MoonOnThisDay($Date)#~MoonOnThisDay_API
{

   $Lunaf_Site_Res = file_get_contents("https://lunaf.com/lunar-calendar/".$Date);

   preg_match('"figure class=\"mimg\"(.*?)\">"' , $Lunaf_Site_Res , $Res_Reg_1);

   preg_match('"/img/moon/(.*?)\""' , $Res_Reg_1[1] , $IMG_Name);

   $Moon_IMG_LINK = "https://lunaf.com/img/moon/h-".$IMG_Name[1];

   echo(json_encode(array(
    'Moon On This Day v1',
    'MoonPictureLink' => $Moon_IMG_LINK ,
    'Developer' => 'AGC007'
    )));
}

#-------------- AGC007 --------------#

?>