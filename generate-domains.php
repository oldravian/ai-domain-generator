<?php
require_once __DIR__ . '/vendor/autoload.php';

function generateDomains(){
    $env = parse_ini_file('.env');
    $yourApiKey = $env['openai_api_key'];
    $client = OpenAI::client($yourApiKey);
    $business_description = $_POST['description'];
    $domains_count_to_generate = $env['domains_count_to_generate'];
    $prompt = "This is a short description of what my business is about: {$business_description}. Generate {$domains_count_to_generate} creative business names. Follow these instructions about result
    Dont include any spaces in doamin name.
    Append .com as tld with each domain.
    Dont include any other thing in the result except domains.
    Strictly output the result like 'name1,name2,name3' 
    ";

    try{
        $result = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => 500,
        ]);
        $domains =  $result['choices'][0]['text'];
        $domains = trim($domains);
        $domains = trim($domains, "'");

        $domains = explode(",", $domains);
        $domains = array_map(function($domain){
            $domain = trim($domain);
            $domain = trim($domain, ".");
            //$domain = $domain.".com";
            return $domain;
        }, $domains);
        return $domains;
    }
    catch(\Exception $e){
        echo $e->getMessage();
    }
}

?>