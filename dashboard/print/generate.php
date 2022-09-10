<?php

require 'vendor/autoload.php';

$redColor = [255, 255, 255];

// $generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG(); // Vector based SVG
// $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG(); // Pixel based PNG
// $generatorJPG = new Picqer\Barcode\BarcodeGeneratorJPG(); // Pixel based JPG
// $generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML(); // Pixel based HTML
// $generatorHTML = new Picqer\Barcode\BarcodeGeneratorDynamicHTML(); // Vector based HTML


// This will output the barcode as HTML output to display in the browser
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
// echo $generator->getBarcode('9522-449651', $generator::TYPE_CODE_128);

echo '<br>';

$generatorIMG = new Picqer\Barcode\BarcodeGeneratorPNG();
echo '<img src="data:image/png;base64,' . base64_encode($generatorIMG->getBarcode('81622-685303', $generatorIMG::TYPE_CODE_128, 1, 30)) . '">';
echo '<br>';