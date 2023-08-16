<?php

$StatusMember = false;
//------------------- BotInfo ------------------------//
$BotToken = "--BotToken--";
$BotMainURL = "https://api.telegram.org/bot" . $BotToken;
define('BotMainAPI', $BotMainURL);
//---------------------- GetUpdate -------------------//
$Update = file_get_contents('php://input');
file_put_contents('data/Bot.Txt', $Update);
$Update = json_decode($Update, TRUE);

if (isset($Update['callback_query'])) {
    $BotMassegeId = $Update['callback_query']['message']['message_id'];
    $BotChatID = $Update['callback_query']['from']['id'];
    //$BotMessageText = $Update['message']['text'];
    $BotData = $Update['callback_query']['data'];
}
else
{
    $BotMassegeId = $Update['message']['message_id'];
    $BotChatID = $Update['message']['chat']['id'];
    $BotMessageText = $Update['message']['text'];
}

//---------------------- Function -------------------//
function sendMessage_Keyboard($ChatID, $MassegeText, $Keyboard) ///// sendMessageKeyboard /////
{
    file_get_contents(BotMainAPI . "/sendMessage?chat_id=" . $ChatID . "&text=" . $MassegeText . "&parse_mode=HTML&reply_markup=" . urlencode($Keyboard));
}

function editMessage_Keyboard($ChatID, $MassegeID, $MessageText, $Keyboard) ///// editMessageKeyboard /////
{
    file_get_contents(BotMainAPI . "/editMessageText?chat_id=" . $ChatID . "&message_id=" . $MassegeID . "&text=" . $MessageText . "&reply_markup=" . urlencode($Keyboard));
}

function deleteMessage($ChatID, $MassegeID) ///// deleteMessage /////
{
    file_get_contents(BotMainAPI . "/deleteMessage?chat_id=" . $ChatID . "&message_id=" . $MassegeID);
}

function sendPhoto($ChatID, $PhotoFile) ///// sendPhoto /////
{
    file_get_contents(BotMainAPI . "/sendPhoto?chat_id=" . $ChatID . "&photo=" . $PhotoFile);
}

function sendPhotoCaption($ChatID, $PhotoFile , $Caption) ///// sendPhoto /////
{
    file_get_contents(BotMainAPI . "/sendPhoto?chat_id=" . $ChatID . "&photo=" . $PhotoFile . "&caption=" . $Caption);
}

function sendPhotoKeyboard($ChatID, $PhotoFile , $Caption , $Keyboard) ///// sendPhoto /////
{
    file_get_contents(BotMainAPI . "/sendPhoto?chat_id=" . $ChatID . "&photo=" . $PhotoFile . "&parse_mode=HTML" . "&caption=" . $Caption . "&reply_markup=" . urlencode($Keyboard));
}

function sendVideoCaption($ChatID, $VideoFile , $Caption) ///// sendVideoCaption /////
{
    file_get_contents(BotMainAPI."/sendVideo?chat_id=".$ChatID."&video=".$VideoFile."&caption=".$Caption);
}

function sendAudioCaption($ChatID, $AudioFile , $Caption) ///// sendAudioCaption /////
{
    file_get_contents(BotMainAPI."/sendAudio?chat_id=".$ChatID."&audio=".$AudioFile."&caption=".$Caption);
}

function sendVoiceCaption($ChatID, $VoiceFile , $Caption) ///// sendVoiceCaption /////
{
    file_get_contents(BotMainAPI."/sendVoice?chat_id=".$ChatID."&voice=".$VoiceFile."&caption=".$Caption);
}

function sendDocumentCaption($ChatID, $DocumentFile , $Caption) ///// sendDocumentCaption /////
{
    file_get_contents(BotMainAPI."/sendDocument?chat_id=".$ChatID."&document=".$DocumentFile."&caption=".$Caption);
}


function getChatMember($ChatID, $Channel_ID) ///// getChatMember /////
{
    $GetReq = json_decode(file_get_contents(BotMainAPI . "/getChatMember?user_id=".$ChatID."&chat_id=".$Channel_ID), TRUE);
    $Status = $GetReq['result']['status'];

    if ($Status == 'left') {return 'false';} else {return 'true';}
}

function FunKeyboard($KeyText) ///// FunKeyboard /////
{
    //$Btn = array(array($KeyText));
    $Keybord = array('keyboard' => $KeyText, 'resize_keyboard' => true, 'one_time_keyboard' => false, 'selective' => true);

    $FinalKey = json_encode($Keybord, TRUE);
    return $FinalKey;
}

function FuninlineKey($KeyText, $KeyCallBackData , $KeyURL) ///// FuninlineKey /////
{
    $OPT = ['text' => $KeyText, 'callback_data' => $KeyCallBackData , 'url' => $KeyURL];
    return $OPT;
}

function FuninlineKey2($KeyText, $KeyCallBackData) ///// FuninlineKey /////
{
    $OPT = ['text' => $KeyText, 'callback_data' => $KeyCallBackData];
    return $OPT;

}
function Funinline(array $OPT) ///// Funinline /////
{
    $Reply = ['inline_keyboard' => $OPT];
    $Final_Reply = json_encode($Reply, TRUE);
    return $Final_Reply;
}
