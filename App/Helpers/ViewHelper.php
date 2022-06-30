<?php

namespace App\Helpers;

class ViewHelper
{

    public $dictionary = [
        'name' => 'jméno',
        'surname' => 'příjmení',
        'street' => 'adresa',
        'city' => 'město',
        'zipcode' =>    'PSČ',
        'phone' =>    'telefon',

        'ins_number' => 'číslo smlouvy',
        'ins_cat' => 'typ pojištění',
        'startdate'    => 'platnost od',
        'enddate'    => 'platnost do',
        'ins_status' => 'stav',
    ];



    public function translate($userData)
    {
        $singleArray = $this->multipleToSingle($userData);
        $userData = $this->getKeys($singleArray);

        $translated = [];

        foreach ($userData as $word) {
            $wordFromDictionary = strtr($word, $this->dictionary);
            array_push($translated, $wordFromDictionary);
        }
        return $translated;
    }

    private function getKeys(array $singleArray)
    {

        return array_keys($singleArray);
    }


    public function multipleToSingle(array $array)
    {
        $singleArray = [];


        foreach ($array as $item) {

            if (is_array($item)) {

                foreach ($item as $single) {
                    $singleArray = array_merge($single);
                } 
                
            } else {
                    $singleArray=$item;
                }
            }

        return $singleArray;
    }
}
    

