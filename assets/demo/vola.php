<?php
include 'base.php';
// Récupérer les données depuis la base de données
$stmt = $conn->query('SELECT * FROM caisse');
$labels = array();
$data = array();
while ($row = $stmt->fetch()) {
  // Ajouter les données de la colonne 'dates' comme étiquettes
  $labels[] = $row['dates'];
  // Ajouter les données de la colonne 'fond' comme données
  $data[] = $row['fond'];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>


<body>
  <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
</body>

</html>
<script>

  // Bar Chart Example
  var ctx = document.getElementById("myBarChart");
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($labels); ?>,
      datasets: [{
        label: "Revenue",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: <?php echo json_encode($data); ?>,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 6
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            maxTicksLimit: 5
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });

</script>