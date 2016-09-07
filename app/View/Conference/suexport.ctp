<?php

$line= $survey['Survey'];
$this->CSV->addRow(array_keys($line));
$this->CSV->addRow(array_values($line));
$this->CSV->addRow([0 => '']);
 foreach ($survey['Question'] as $ekey => $esur) {
 	foreach ($esur['PresetAnswer'] as $enkey => $eans) {
 		$this->CSV->addRow(array_keys($eans));
 		break;
 	}
	break;
 }

 foreach ($survey['Question'] as $ekey => $esur) {
 	foreach ($esur['PresetAnswer'] as $enkey => $eans) {
 		$this->CSV->addRow(array_values($eans));
 	}
 }
 $filename='Survey';
 echo  $this->CSV->render($filename);
?>