<?php

  if(!empty($_POST)) {
    $red = $_POST['red'];
    $green = $_POST['green'];
    $blue = $_POST['blue'];

    $url = '172.20.18.8?red=' . prfx($red) . '&green=' . prfx($green) . '&blue=' . prfx($blue);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
    ));
  
    $response = curl_exec($curl);
  
    curl_close($curl);
    echo $response;
  }



  function prfx($val) {
    if($val < 10) {
      return '00' . $val;
    }
    else if($val >= 10 && $val < 100) {
      return '0' . $val;
    }

    return $val;
  }