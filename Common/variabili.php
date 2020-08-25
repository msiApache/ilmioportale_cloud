<?php

$msg = '';
function msgSwitch($title, $body)
{
    $footer = '<br><br><h3 style="font-weight: normal">Questa mail e\' stata generata al solo scopo di avviso, per cui si prega di non rispondere !</h3><h3 style="font-weight: normal">Buona giornata da Gianluca Tuono(Amm. unico <a href="https://www.ilmioportale.cloud/">ilmioportale.cloud</a>)</h3>';
    $msgApriliaPegaso = '<h2 style="font-weight: normal">Gentile utente ,</h2><h2 style="font-weight: normal">il tuo portale ti informa di controllare lo stato delle scadenze inerente il seguente motoveicolo: APRILIA PEGASO 650 </h2><br><br>';
    $msgApriliaPegaso .= $body;
    $msgApriliaPegaso .= $footer;
    $msgSuzukiGsr = '<h2 style="font-weight: normal">Gentile utente ,</h2><h2 style="font-weight: normal">il tuo portale ti informa di controllare lo stato delle scadenze inerente il seguente motoveicolo: SUZUKI GSR 600 </h2><br><br>';
    $msgSuzukiGsr .= $body;
    $msgSuzukiGsr .= $footer;
    $msgOpelAstraH = '<h2 style="font-weight: normal">Gentile utente ,</h2><h2 style="font-weight: normal">il tuo portale ti informa di controllare lo stato delle scadenze inerente il seguente autoveicolo: OPEL ASTRA H </h2><br><br>';
    $msgOpelAstraH .= $body;
    $msgOpelAstraH .= $footer;
    $msgOpelInsignia = '<h2 style="font-weight: normal">Gentile utente ,</h2><h2 style="font-weight: normal">il tuo portale ti informa di controllare lo stato delle scadenze inerente il seguente autoveicolo: OPEL INSIGNIA </h2><br><br>';
    $msgOpelInsignia .= $body;
    $msgOpelInsignia .= $footer;
    switch ($title) {
        case 'msgApriliaPegaso' :
            return $msgApriliaPegaso;
        case 'msgSuzukiGsr' :
            return $msgSuzukiGsr;
        case 'msgOpelAstraH' :
            return $msgOpelAstraH;
        case 'msgOpelInsignia' :
            return $msgOpelInsignia;
        default :
            return $footer;
    }
}

function getMessage($title, $body){
    $message = [
        'msgApriliaPegaso' => msgSwitch('msgApriliaPegaso' ,$body),
        'msgSuzukiGsr' => msgSwitch('msgSuzukiGsr',$body),
        'msgOpelAstraH' => msgSwitch('msgOpelAstraH',$body),
        'msgOpelInsignia' => msgSwitch('msgOpelInsignia',$body)
    ];
    switch ($title) {
        case 'aprilia' :
            return $message['msgApriliaPegaso'];
        case 'suzuki' :
            return $message['msgSuzukiGsr'];
        case 'astra' :
            return $message['msgOpelAstraH'];
        case 'insignia' :
            return $message['msgOpelInsignia'];
        default :
            return '';
    }
}

function getVehicles(){
    $vehicles =  [
        'apriliaPegaso' => 'APRILIA PEGASO 650',
        'suzukiGsr' => 'SUZUKI GSR 600',
        'opelAstraH' => 'OPEL ASTRA H',
        'opelInsignia' => 'OPEL INSIGNIA'
    ];

    $apriliaPegaso = $vehicles['apriliaPegaso'];
    $suzukiGsr = $vehicles['suzukiGsr'];
    $opelAstraH = $vehicles['opelAstraH'];
    $opelInsignia = $vehicles['opelInsignia'];
}

