<?php
	require_once(__DIR__.'/../../../FusionCharts/integrations/php/fusioncharts-wrapper/fusioncharts.php');
      // Form the SQL query that returns the top 10 most populous countries
  if(!empty($_GET['sort'])){
    if($_GET['sort'] == '123'){
      $strQuery = "SELECT Tytul, Sprzedanych FROM ksiazki ORDER BY Sprzedanych DESC";
      echo "<a href='mainPage.php?report=sellList&sort=abc'>ABC</a>";
    }else if($_GET['sort'] == 'abc'){
      $strQuery = "SELECT Tytul, Sprzedanych FROM ksiazki ORDER BY Tytul ASC";
      echo "<a href='mainPage.php?report=sellList&sort=123'>123</a>";
    }
    
  }else{
    $strQuery = "SELECT Tytul, Sprzedanych FROM ksiazki ORDER BY Sprzedanych DESC";
    echo "<a href='mainPage.php?report=sellList&sort=abc'>ABC</a>";
  }
      

      // Execute the query, or else return the error message.
      $result = $connection->query($strQuery) or exit("Error code ({$connection->errno}): {$connection->error}");

      // If the query returns a valid response, prepare the JSON string
      if ($result) {
          // The `$arrData` array holds the chart attributes and data
          $arrData = array(
              "chart" => array(
                  "theme" => "fusion",
                  "caption" => "Lista sprzedaży",
                  "subCaption" => "",
                  "yaxisname" => "Sprzedanych",
                  "showvalues" => "0",
                  "numberSuffix" => " szt",
                  "numVisiblePlot" => "12",
                  "scrollheight" => "10",
                  "flatScrollBars" => "1",
                  "scrollShowButtons" => "0",
                  "scrollColor" => "#cccccc",
                  "showHoverEffect" => "1",
                  "useEllipsesWhenOverflow " => "1",
                  "maxLabelWidthPercent" => "15",
                  "adjustDiv" => "1"
                )
            );

          $arrData["data"] = array();
          $ilosc = 0;
  // Push the data into the array
          while($row = mysqli_fetch_array($result)) {
            $ilosc += $row["Sprzedanych"];
            array_push($arrData["data"], array(
                "label" => $row["Tytul"],
                "value" => $row["Sprzedanych"],
                "color" => "#699148"
                )
            );
          }
          $arrData['chart']['subCaption'] = "Sprzedano: $ilosc szt";
          /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

          $jsonEncodedData = json_encode($arrData);

  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

          $columnChart = new FusionCharts("bar2d", "top10" , '100%', '85%', "chart", "json", $jsonEncodedData);

          // Render the chart
          $columnChart->render();

          // Close the database connection
      }
    ?>
<div id="chart"></div>