<?php

require 'vendor\autoload.php';

use Phpml\CrossValidation\RandomSplit;
use Phpml\CrossValidation\Split;
use Phpml\Dataset\ArrayDataset;
require 'vendor\autoload.php';
use Phpml\Classification\KNearestNeighbors;
use Phpml\SupportVectorMachine\Kernel;
use Phpml\Metric\Accuracy;



$con=new mysqli("localhost","root","","fishernet");
$query = $con->query("SELECT * FROM penjualan WHERE MONTH(tanggal)=MONTH(now())-$periode");
$jumlah = array();
$ikan = array();
while($d = $query->fetch_assoc()){
	array_push($jumlah,[$d['jumlah_terjual']]);
	array_push($ikan,strval($d['id_jenis_ikan']));
}


$dataset = new ArrayDataset($jumlah, $ikan);
$dataset = new RandomSplit($dataset, 0.3, 1234);

$classifier = new KNearestNeighbors();
$classifier->train($dataset->getTrainSamples(),$dataset->getTrainLabels());
// train group
$predictedLabels=$classifier->predict($dataset->getTestSamples());
$akurasi=Accuracy::score($dataset->getTestLabels(), $predictedLabels);
// test group
