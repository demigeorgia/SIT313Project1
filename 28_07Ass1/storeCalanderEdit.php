<?php

  session_start();

  //Gets values from editday.html
  $s1 = $_GET['date'];
  $s2 = $_GET['textInputOne'];
  $s3 = $_GET['textInputTwo'];
  $s4 = $_GET['textInputThree'];
  $r1 = $_GET['r1'];
  $r2 = $_GET['r2'];
  $r3 = $_GET['r3'];
  $r4 = $_GET['r4'];
  $r5 = $_GET['r5'];
  $r6 = $_GET['r6'];

  // connects to database
  $dbuser = "dgbr";
  $dbpass = "ilovecows";
  $db = "SSID";
  $connect = oci_connect($dbuser, $dbpass, $db);

  if (!$connect) {
      echo "An error occurred connecting to the database";
      exit;
  }

  $sql = "SELECT * FROM dates WHERE dateofentry = '$s1'";

  $stmt = oci_parse($connect, $sql);

  if(!$stmt)  {
  	echo "An error occurred in parsing the sql string.\n";
  	exit;
  }

   oci_execute($stmt);

	// username and password match, the username is stored and the user is logged in
  if (oci_fetch_array($stmt)) {

    if (!ctype_alpha($s2) || !ctype_alpha($s3) || !ctype_alpha($s4)) {
      $_SESSION['inputError'] = "Error: {$s1} was not updated. Input must only be letters.";
      header('location: quizhome.php');
    }
    else {
      $_SESSION['inputError'] = "";
    }

    $sql = "UPDATE dates SET TEXTINPUTONE = '{$s2}', TEXTINPUTTWO = '{$s3}', TEXTINPUTTHREE = '{$s4}', HAPPY = '{$r1}', SAD = '{$r2}', ANGRY = '{$r3}', SMITTEN = '{$r4}', STRESSED = '{$r5}', WORRIED = '{$r6}' WHERE DATEOFENTRY = '{$s1}'";

    $stmtTwo = oci_parse($connect, $sql);

    if(!$stmtTwo)  {
      echo "An error occurred in parsing the sql string.\n";
      exit;
    }

    oci_execute($stmtTwo);


  }
  else {
    if (!ctype_alpha($s2) || !ctype_alpha($s3) || !ctype_alpha($s4)) {
      $_SESSION['inputError'] = "{$s1} was not updated. Input must only be letters";
      header('location: quizhome.php');
    }
    else {
      $_SESSION['inputError'] = "";
    }

    $sql = "INSERT INTO dates
    (DATEOFENTRY, TEXTINPUTONE, TEXTINPUTTWO, TEXTINPUTTHREE, SAD, ANGRY, HAPPY, WORRIED, SMITTEN, STRESSED) VALUES
      ('{$s1}', '{$s2}', '{$s3}', '{$s4}',
      '{$r2}', '{$r3}', '{$r1}', '{$r6}', '{$r4}', '{$r5}')";

    $stmtTwo = oci_parse($connect, $sql);

  	if(!$stmtTwo)  {
  		echo "An error occurred in parsing the sql string.\n";
  		exit;
    }

  	oci_execute($stmtTwo);

  }
  header('location: quizhome.php');

	// redirects user to monitoringPage.php
  //header('location: monitoringPage.php?');

?>
