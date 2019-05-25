<?php


namespace App\Service;


class Slugify
{

    public function generate(string $input): string
    {
        $forbidenLetters = ['à','é', 'è', 'ê' , ' ', '\'', '--','!',',' , ', ',' !' ];
        $replacementLetters = ['a','e', 'e', 'e', '-', '', '-','','','',''];

        $input=  strtolower(str_replace($forbidenLetters, $replacementLetters,$input));
        $input= trim ( $input , $character_mask = " \t\n\r\0\x0B\-" );
        return $input;
    }
}