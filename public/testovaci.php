<?php


/*
Array
(
    [user] => Array
        (
            [0] => Array
                (
                    [ins_number] => 22061020
                    [ins_cat] => pojištění osob
                    [startdate] => 2015-06-10
                    [enddate] => 2024-06-10
                    [ins_status] => aktivní
                )

            [1] => Array
                (
                    [ins_number] => 21021410
                    [ins_cat] => pojištění vozidel
                    [startdate] => 2021-02-03
                    [enddate] => 2023-02-03
                    [ins_status] => čeká na schválení změn
                )

        )

)



*/




$multiArr=[

        '0' => [
                
                    'ins_number' => '22061020',
                    'ins_cat' => 'pojištění osob',
                    'startdate' => '2015-06-10',
                    'enddate' => '2024-06-10',
                    'ins_status' => 'aktivní',
                
        ],
        '1' => [
                
                    'ins_number' => '21021410',
                    'ins_cat' => 'pojištění vozidel',
                    'startdate' => '2021-02-03',
                    'enddate' => '2023-02-03',
                    'ins_status' => 'čeká na schválení změn',
                
            ]

];


//print("<pre>".print_r($multiArr,true)."</pre>");



$intArr=[
'name' => 'Alžběta',
'surname' => 'Možíšová',
'street' => 'Květinová 25',
'city' => 'Veverská Bítýška',
'zipcode' => '66471',
'email' => 'bet@bet.cz',
'phone' => '789456123',
];

$array=[
    'user' => $multiArr];

//print_r($array);
print("<pre>".print_r($array,true)."</pre>");

function multipleToSingle(array $multiArray)
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

print_r(multipleToSingle($array));

print("<pre>".print_r(multipleToSingle($array),true)."</pre>");