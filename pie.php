<?php
// 데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizza";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 데이터 가져오기
$sql = "SELECT 불고기, 새우, 치즈, 햄, 올리브 FROM users ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

// 데이터 포맷 변환
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$jsonData = json_encode($data);

$conn->close();
?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var jsonData = '<?php echo $jsonData; ?>';
            var dataArray = [
                ['Task', 'Count'],
                ['불고기', 0],
                ['새우', 0],
                ['치즈', 0],
                ['햄', 0],
                ['올리브', 0]
            ];
            var rows = JSON.parse(jsonData);
            for (var i = 0; i < rows.length; i++) {
                dataArray[1][1] += parseInt(rows[i]['불고기']);
                dataArray[2][1] += parseInt(rows[i]['새우']);
                dataArray[3][1] += parseInt(rows[i]['치즈']);
                dataArray[4][1] += parseInt(rows[i]['햄']);
                dataArray[5][1] += parseInt(rows[i]['올리브']);
            }

            var data = google.visualization.arrayToDataTable(dataArray);
            var options = {
                title: '나의 피자이야기'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
 </head>
 <body> 
    <div id="piechart" style="width: 900px; height: 500px;"></div>
 </body>
</html>