#! /usr/bin/env php

<?php

require 'vendor/autoload.php';

$app = new Symfony\Component\Console\Application('Tasks application', '1.0b');

try
{
    $pdo = new PDO('sqlite:db.sqlite');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $exception)
{
    echo 'Could not connect to the database';
    exit(1);
}

$dbAdapter = new AYashenkov\DatabaseAdapter($pdo);

$app->add(new AYashenkov\ShowCommand($dbAdapter));
$app->add(new AYashenkov\AddCommand($dbAdapter));
$app->add(new AYashenkov\CompleteCommand($dbAdapter));
$app->run();