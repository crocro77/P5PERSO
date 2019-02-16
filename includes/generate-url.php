<?php

function generateURL($path)
{
    $domain = 'http://localhost';
    $directory = 'PROJET5PERSO';

    $url = $domain.'/'.$directory.'/'.$path;

    return $url;

}   