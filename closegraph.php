<!DOCTYPE HTML>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>CV Queue Graph</title>

<?php
include "base.php";
$query = mysql_query("Select unix_timestamp(`Time`) AS Time, NumInQueue from closequeue");
//$query = mysql_query("Select `Time`, NumInQueue from closequeue");

while ($row = mysql_fetch_array($query)) {
  $datetime = $row["Time"];
  $datetime *= 1000; // convert from Unix timestamp to JavaScript time
  $numInQueue = $row["NumInQueue"];
  $data[] = "[$datetime, $numInQueue]";
}
?>

                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        </head>
        <body>
<script src="/highcharts/js/highcharts.js"></script>
<script src="/highcharts/js/modules/exporting.js"></script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">

var chart = new Highcharts.Chart({
      title: {
         text: 'SO Close Vote Queue'
      },
      chart: {
         renderTo: 'container'
      },
      xAxis: {
         title: {
            text: 'Date & Time'
         },
         type: 'datetime',
      },
      yAxis: {
         title: {
            text: 'Number in CV Queue'
         },
      },
      series: [{
         name: 'Q\'\s in CV Queue',
         data: [<?php echo join($data, ',') ?>]
      }]
});
                </script>

        </body>
</html>
