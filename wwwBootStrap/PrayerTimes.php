<?php
	//set timeszone for date() calls
	date_default_timezone_set('America/New_York');
	if(isset($_POST['month'])){
		$month=$_POST['month'];
	} else {
		$month = date("n");
	}
	$MONTHS = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$monthName = $MONTHS[intval($month)-1];
	$rpath = "/home/users/web/b1822/ipw.masjidumarcom/public_html/";
	$spath = "./files/timings/";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <title>Prayer Times</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/contact.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php include "navigation.php"; ?>
    <div class="site-wrapper">
    <div class="site-wrapper-inner">
        <p><a href="prayer.htm" target="_blank">Printer friendly yearly prayer timings</a></p>
        <div id="getMonth">
            <form action="PrayerTimes.php" method="post">
                <p>Select a month:</p>
                <select name="month">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <p><input type="submit" /></p>
            </form>
        </div>
        <div>
            <table id="prayertimestable">
                <caption><?php echo $monthName;?> Timesheet</caption>
                <tr>
                    <th></th>
                    <th colspan="2">Fajr</th>
                    <th>Sunrise</th>
                    <th colspan="2">Zuhr</th>
                    <th colspan="2">Asr</th>
                    <th colspan="2">Maghrib</th>
                    <th colspan="2">Isha</th>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>Adhaan</td>
                    <td>Iqaamah</td>
                    <td></td>
                    <td>Adhaan</td>
                    <td>Iqaamah</td>
                    <td>Adhaan</td>
                    <td>Iqaamah</td>
                    <td>Adhaan</td>
                    <td>Iqaamah</td>
                    <td>Adhaan</td>
                    <td>Iqaamah</td>
                </tr>
                <?php							
                    //open the p{$month}.xml file
                    $treep = simplexml_load_file($spath.'p'.$month.".xml") or die("Error: Cannot create object");
                    //open the j{$month}.xml file
                    $treej = simplexml_load_file($spath.'j'.$month.".xml") or die("Error: Cannot create object");
                    $day = 0;
                    while(!empty($treep->date[$day]) and !empty($treej->date[$day])){
                        $prayer = $treep->date[$day];
                        $jamaat = $treej->date[$day];
                        echo "<tr>";
                        echo "<td>".$prayer['day']."</td>";
                        echo "<td>".$prayer->fajr."</td>";
                        echo "<td>".$jamaat->fajr."</td>";
                        echo "<td>".$prayer->sunrise."</td>";
                        echo "<td>".$prayer->dhuhr."</td>";
                        echo "<td>".$jamaat->dhuhr."</td>";
                        echo "<td>".$prayer->asr."</td>";
                        echo "<td>".$jamaat->asr."</td>";
                        echo "<td>".$prayer->maghrib."</td>";
                        echo "<td>".$jamaat->maghrib."</td>";
                        echo "<td>".$prayer->isha."</td>";
                        echo "<td>".$jamaat->isha."</td>";
                        echo "</tr>";
                        $day = $day + 1;
                    }
                ?>
            </table>
        </div>

      <div class="site-wrapper-inner">

      </div>
      <?php include "footer.php"; ?>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
