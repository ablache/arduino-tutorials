<?php
  include('php_serial.class.php');

  $serial = new PhpSerial();
  
  $serial->deviceSet("/dev/cu.usbmodem1461");
  $serial->confBaudRate(9600);
  $serial->confParity("none");
  $serial->confCharacterLength(8);
  $serial->confStopBits(1);
  $serial->confFlowControl("none");
  $serial->deviceOpen();

  $map = [
    1 => '2,0',
    2 => '2,255',
    3 => '4,0',
    4 => '4,255',
    5 => '6,0',
    6 => '6,255',
  ];

  if(!empty($_POST)) {
    $cmd = $_POST['command'];

    if($cmd >= 1 && $cmd <= 6) {
      $serial->sendMessage("\n");
      sleep(1);
      $serial->sendMessage($map[$cmd] . "\n");  
      
      $serial->deviceClose();
      
      echo 'success';
    }
  }
?>