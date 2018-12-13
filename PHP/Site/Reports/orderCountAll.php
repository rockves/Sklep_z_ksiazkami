<?php
  if (!$_SESSION['czyPracownik']) {
  } else {
      require_once(__DIR__.'/../../../FusionCharts/integrations/php/fusioncharts-wrapper/fusioncharts.php');
      // Form the SQL query that returns the top 10 most populous countries
      $strQuery = "SELECT COUNT(zamowienia.Id) AS Ilosc, zamowienia.Data_zamowienia AS Data, uzytkownicy.Nazwa_uzytkownika AS Nazwa FROM zamowienia INNER JOIN uzytkownicy ON uzytkownicy.Id = zamowienia.Id_klienta GROUP BY uzytkownicy.Nazwa_uzytkownika ORDER BY Data_zamowienia ASC";
      // Execute the query, or else return the error message.
      $result = $connection->query($strQuery) or exit("Error code ({$connection->errno}): {$connection->error}");
      // If the query returns a valid response, prepare the JSON string
      if ($result) {
          // The `$arrData` array holds the chart attributes and data
          $arrData = array(
              "chart" => array(
                  "theme" => "fusion",
                  "caption" => "Lista wszystkich zamówień",
                  "subCaption" => "",
                  "yaxisname" => "Zamówień",
                  "showvalues" => "0",
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
          while ($row = mysqli_fetch_array($result)) {
              $ilosc += $row["Ilosc"];
              array_push(
                $arrData["data"],
                array(
                "label" => $row["Nazwa"],
                "value" => $row["Ilosc"],
                "color" => "#699148"
                )
            );
          }
          $arrData['chart']['subCaption'] = ($ilosc < 10) ? "Złożono $ilosc zamówienia" : "Złożono $ilosc zamówień";
          /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

          $jsonEncodedData = json_encode($arrData);

          /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

          $columnChart = new FusionCharts("bar2d", "top10", '100%', '85%', "chart", "json", $jsonEncodedData);

          // Render the chart
          $columnChart->render();

          // Close the database connection
      }
  }
    ?>
<div id="chart"></div>