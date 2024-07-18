<?php
require_once 'HTTP/Request2.php';
$request = new HTTP_Request2();
$request->setUrl('https://1vkved.api.infobip.com/whatsapp/1/message/template');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
    'follow_redirects' => TRUE
));
$request->setHeader(array(
    'Authorization' => 'App ee6ce6254c19466d0f5dcc0918d6bd72-a17c6f71-99fb-441b-84bb-b53cc91996f1',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json'
));
$request->setBody('{"messages":[{"from":"447860099299","to":"918754362873","messageId":"0d36211a-01c0-464e-9088-d1e544b3bacb","content":{"templateName":"message_test","templateData":{"body":{"placeholders":["Surya"]}},"language":"en"}}]}');
try {
    $response = $request->send();
    if ($response->getStatus() == 200) {
        echo $response->getBody();
    }
    else {
        echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
        $response->getReasonPhrase();
    }
}
catch(HTTP_Request2_Exception $e) {
    echo 'Error: ' . $e->getMessage();
}