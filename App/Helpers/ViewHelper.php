<?php

namespace App\Helpers;

class ViewHelper
{
    /**
     * Dictionary for translation of database data to the view
     *
     * @var array
     */
    private array $dictionary = [
        'name' => 'jméno',
        'surname' => 'příjmení',
        'street' => 'ulice, číslo',
        'city' => 'město',
        'zipcode' =>    'PSČ',
        'phone' =>    'telefon',

        'ins_number' => 'číslo smlouvy',
        'ins_cat' => 'typ pojištění',
        'startdate'    => 'platnost od',
        'enddate'    => 'platnost do',
        'ins_status' => 'stav',

        'event_num' => 'číslo pojistné události',
        'event_date' => 'datum vzniku',
        'status' => 'stav',
    ];


    /**
     * Display formatted names of database data in a view
     * Translate data passed from the controller to the view according to the $dictionary
     *
     * @param array $userData data passed to View from Controller
     * @return array
     */
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

    /**
     * Extract keys from array and turn them into values
     *
     * @param array $singleArray 
     * @return array 
     */
    private function getKeys(array $singleArray)
    {
        return array_keys($singleArray);
    }

    /**
     * Remove multiple nesting of array data
     * Iterrates over multidimensional array to remove several layers of nesting
     *
     * @param array $array
     * @return array
     */
    private function multipleToSingle(array $multiArray)
    {
        $simpleArray = [];

        foreach ($multiArray as $item) {

            if (is_array($item)) {

                $simpleArray =  array_merge_recursive($item);
            } else {
                return $multiArray;
            }
        }
        return $simpleArray;
    }
}
