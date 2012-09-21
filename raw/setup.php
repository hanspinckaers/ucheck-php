<?
## Copyright (c) 2011 by Hans Pinckaers 
##
## This work is licensed under the Creative Commons 
## Attribution-NonCommercial-ShareAlike 3.0 Unported License. 
## To view a copy of this license, visit 
## http://creativecommons.org/licenses/by-nc-sa/3.0/ 
##
## ucheck-php: https://github.com/HansPinckaers/ucheck-php
## ucheck-node: https://github.com/HansPinckaers/ucheck-node
##

if(!isset($DOCUMENT_ROOT))
{
    $DOCUMENT_ROOT = realpath($_SERVER['DOCUMENT_ROOT'])."/";
    $USES_UCHECK_API = true;
    $UCHECK_API_SERVER = "http://ucheck.nl/api/";
    $NODEJS_DIR = "/home/geneesleer/opt/bin/node"; // path to node.js bin;
    $NODEJS_SERVERJS_DIR = "/home/geneesleer/ucheck-node/server.js"; // path to uCheck server.js;
    
    // here you can tweak the CURL used to scrape
    function req($url, $post_str, $cookiefile)
    {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
        curl_setopt($ch, CURLOPT_URL, $url);
    
        curl_setopt($ch, CURLOPT_POST, substr_count($post_str, "&") + 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
    
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
    
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
        $html = curl_exec($ch);
    
        echo $html;

        unset($ch);
    
        return $html;
    }
}

?>
