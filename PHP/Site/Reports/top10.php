<?php
	require_once(__DIR__.'/../../../FusionCharts/integrations/php/fusioncharts-wrapper/fusioncharts.php');
      // Form the SQL query that returns the top 10 most populous countries
      $strQuery = "SELECT Tytul, Sprzedanych FROM ksiazki ORDER BY Sprzedanych DESC LIMIT 10";

      // Execute the query, or else return the error message.
      $result = $connection->query($strQuery) or exit("Error code ({$connection->errno}): {$connection->error}");

      // If the query returns a valid response, prepare the JSON string
      if ($result) {
          // The `$arrData` array holds the chart attributes and data
          $arrData = array(
              "chart" => array(
                  "caption" => "10 Bestsellers",
                  "showValues" => "0",
                  "theme" => "fusion",
                  "yAxisName" => "Sprzedanych",
                  "numberSuffix" => " szt",
                )
            );

          $arrData["data"] = array();

  // Push the data into the array
          while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row["Tytul"],
                "value" => $row["Sprzedanych"],
                "color" => "#699148"
                )
            );
          }

          /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

          $jsonEncodedData = json_encode($arrData);

  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

          $columnChart = new FusionCharts("column2D", "top10" , '100%', '60%', "chart", "json", $jsonEncodedData);

          // Render the chart
          $columnChart->render();

          // Close the database connection
      }
    ?>
<div id="chart"></div>