<?php
require realpath(__DIR__ . '/../') . '/vendor/autoload.php';

use Naucon\Iban\Iban;
$type = new Iban('DE68210501700012345678');

echo 'IBAN<br/>';
echo $type->getIban(); // DE68210501700012345678
echo '<br/>';
echo $type->getBban(); // 210501700012345678
echo '<br/>';
echo $type->getCountryCode(); // DE
echo '<br/>';
echo $type->getCountryName(); // Germany
echo '<br/>';
echo $type->getBankcode();  // 21050170
echo '<br/>';
echo $type->getAccount();   // 0012345678
echo '<br/>';
echo $type->getCheckDigits(); // 68
echo '<br/>';

if ($type->isValid()) {
    echo 'IBAN is Valid';
    echo '<br/>';
}