<?php

include './Terminal.php';

$terminal = new Terminal();

// Test One
// ZA,YB,FC,GD,ZA,YB,ZA,ZA
$terminal->scan('ZA');
$terminal->scan('YB');
$terminal->scan('FC');
$terminal->scan('GD');
$terminal->scan('ZA');
$terminal->scan('YB');
$terminal->scan('ZA');
$terminal->scan('ZA');

echo "\n";
echo "Test One:\n";
echo $terminal->getTotal();
echo $terminal->clear();
echo "\n\n";

// FC, FC, FC, FC, FC, FC, FC
$terminal->scan('FC');
$terminal->scan('FC');
$terminal->scan('FC');
$terminal->scan('FC');
$terminal->scan('FC');
$terminal->scan('FC');
$terminal->scan('FC');

echo "Test Two:\n";
echo $terminal->getTotal();
echo $terminal->clear();
echo "\n\n";

// Test Three
// ZA,YB,FC,GD
$terminal->scan('ZA');
$terminal->scan('YB');
$terminal->scan('FC');
$terminal->scan('GD');

echo "Test Three:\n";
echo $terminal->getTotal();
echo $terminal->clear();
echo "\n\n";

?>
