<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

function isDomainAvailable($domain){
    $client = new Client();
    $env = parse_ini_file('.env');

    try{
        $qry = [
            'credits' => 'DA',
            'domainName' => $domain,
            'apikey' => $env['whoisxml_api_key']
        ];
    
        //get a long-lived User access token
        $response = $client->request('GET', "https://domain-availability.whoisxmlapi.com/api/v1"
        , ['query' => $qry]);
    
        $body = $response->getBody();
        $data = json_decode($body->getContents());
        if(!isset($data->DomainInfo->domainAvailability) || $data->DomainInfo->domainAvailability=="UNAVAILABLE"){
            return false;
        }
        else{
            return true;
        }  
    }
    catch (\GuzzleHttp\Exception\RequestException $e){
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            var_dump($response->getReasonPhrase()); // Response message;
            var_dump(json_decode((string) $response->getBody())); // Body as the decoded JSON;
        }
        else{
            var_dump($e->getMessage());
        }
    }
}

?>