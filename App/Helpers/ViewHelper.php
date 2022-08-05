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

        'pay_ammount' => 'pojistné', 
        'pay_until' => 'zaplaceno do' , 
        'pay_via' => 'způsob platby', 
        'frequency' => 'frekvence splátky', 
        'pay_to' => 'platba na účet č.', 
        'pay_status' => 'stav platby',


    ];

    /**
     * Translate data passed from the controller to the view according to the $dictionary
     * Get column names of database data in a view
     * Return translated values
     *
     * @param array $userData data passed to View from Controller
     * @return array
     */
    public function translate($userData)
    {
        $dataColumns = $this->getColumnNames($userData);
    
        $translated = [];

        foreach ($dataColumns as $word) {
            $wordFromDictionary = strtr($word, $this->dictionary);
            array_push($translated, $wordFromDictionary);
        }
        return $translated;
    }


    /**
     * Get column names from array of user data and turn them into a single array of unique values
     * Check for multiple nesting of array data
     * Iterrate over multidimensional array to remove several layers of nesting and join values into a single array
     * Remove duplicate values
     *
     * @param array $userData
     * @return array $simpleArray
     */
    private function getColumnNames(array $userData)
    {
            $simpleArray = []; 
     
            if (!is_array($userData)) { 
              return $userData; 
            } 
    
            foreach ($userData as $key => $value) { 
              
                if (!is_array($value)) { 
                $key = array_push($simpleArray, $key);
                
                } else {
                $simpleArray = array_merge($simpleArray, $this->getColumnNames($value)); 

                }
            } 

            return array_unique($simpleArray); 
    }
}