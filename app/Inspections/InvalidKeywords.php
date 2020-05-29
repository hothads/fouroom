<?php


namespace App\Inspections;

use Exception;

class InvalidKeywords
{
    protected $keywords = [
        'yahoo customer support'
    ];

    public function detect($body)
    {

        foreach($this->keywords as $keyWord){
            if(stripos($body, $keyWord) !== false){
                throw new Exception('Your reply conrains spam');
            }
        }
    }
}
