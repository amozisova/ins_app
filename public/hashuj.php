<?php


/**
 * pro generování hashovaných hesel do databáze
 * 
 */




$sadaHesel = ['jedna','dva','tri','ctyri','pet','adela'];


foreach ($sadaHesel as $pswd) {

$pswd = password_hash($pswd, PASSWORD_DEFAULT);

echo $pswd.'<p>';
}

/*
$2y$10$oYUx.wSQguDW7s.yHosRxOqcz0yGw6ECzufIXMBdifKzQEkqTVlzm

$2y$10$/x/52mXv0jECJYXA/RAIPeXOmSgeU5up2QtapklgT6A7hnJgDQKXS

$2y$10$xUSV1OuqZzq30kFhCNa5eeKupi64wYKvM1zf3cPFtAp1D/lf28vZW

$2y$10$k.iy4sPJNVWiHjYFCeItO.RKBGNf4jaF4cZibeScxeTkQQw0kn8cK

$2y$10$FcYHqp6/L9tASHW7Bi33eObFp4146u1fvWnjvZWxAIyZl8uj4WXoC

$2y$10$5ocY2bKS5Yce3oVYJdRqbONPMjVPIV2Ah49nvgZnqLvvv15LA9JEO
*/



