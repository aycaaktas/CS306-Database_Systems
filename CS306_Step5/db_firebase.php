<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('cs306-b1a4e-firebase-adminsdk-2dhho-e3558f7321.json')
    ->withDatabaseUri('https://cs306-b1a4e-default-rtdb.firebaseio.com/');

$database = $factory->createDatabase();

?>