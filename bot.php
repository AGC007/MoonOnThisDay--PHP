<?php
#---- FUNCATION ----#
   include('funcation.php');
#---- FUNCATION ----#

#---- API ----#
function  MoonOnThisDay($Date)#~MoonOnThisDay_API
{

   $Lunaf_Site_Res = file_get_contents("https://lunaf.com/lunar-calendar/".$Date);

   preg_match('"figure class=\"mimg\"(.*?)\">"' , $Lunaf_Site_Res , $Res_Reg_1);

   preg_match('"/img/moon/(.*?)\""' , $Res_Reg_1[1] , $IMG_Name);

   return $Moon_IMG_LINK = "https://lunaf.com/img/moon/h-".$IMG_Name[1];

}
#---- API ----#

#---- ROBOT ----#

$Channel_Lock = getChatMember($BotChatID,"@CFG_WORLD");

if($Channel_Lock == "true")
{

if($BotMessageText == "/start")
{
    $BTN_SEND_START = array(array(FuninlineKey('👽 AGC007 👽' , '1' , "https://github.com/AGC007")));
    sendMessage_Keyboard($BotChatID , "<b><i>🌙Hi - Moon On This Day[v1] By @AGC007™🌙</i></b>" , Funinline($BTN_SEND_START));
}

if(strstr($BotMessageText , "/") && $BotMessageText != "/start")
{
    $Date = $BotMessageText;

    $MoonPictureLink = MoonOnThisDay($Date);

    $Site_URL = "https://lunaf.com/lunar-calendar/".$Date;
    $API_URL = "--Address--MoonOnThisDay_Bot/MoonOnThisDay_api.php?Date=".$Date;
    $BTN_Send_Message = array(array(FuninlineKey('🔮 Open Site Page 🔮' , '1' , $Site_URL)),array(FuninlineKey('🧿 Open API 🧿' , '2' , $API_URL)));
    sendPhotoKeyboard($BotChatID , $MoonPictureLink , "🔺 Moon On This Day 🔺" , Funinline($BTN_Send_Message));
}

} elseif($Channel_Lock == "false"){
    $Lock_inline_BTN = array(array(FuninlineKey('🔹 Join the channel - CFG_WORLD 🔹' , '1' , "https://t.me/CFG_WORLD")));
    sendMessage_Keyboard($BotChatID , "<b><i>🔆 Join To The Channel To Use The Moon On This Day Bot 🔆</i></b>" , Funinline($Lock_inline_BTN));
}

#---- ROBOT ----#
?>

