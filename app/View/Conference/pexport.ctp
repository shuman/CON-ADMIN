<?php

$line= $poll['Poll'];
$this->CSV->addRow(array_keys($line));
$this->CSV->addRow(array_values($line));
$this->CSV->addRow([0 => '']);
 foreach ($poll['PresetPollAnswer'] as $ekey => $epoll) {
	$this->CSV->addRow(array_keys($epoll));
	break;
 }
 foreach ($poll['PresetPollAnswer'] as $ekey => $epoll) {
	$this->CSV->addRow(array_values($epoll));
 }
 $filename='Poll';
 echo  $this->CSV->render($filename);
?>