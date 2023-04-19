<!DOCTYPE html>
<html>
<head>
	<title>피자주문</title>
</head>
<body>
	<h1>피자주문</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>불고기:</label>
		<input type="number" name="불고기" required><br><br>
		<label>새우:</label>
		<input type="number" name="새우" required><br><br>
        <label>치즈:</label>
		<input type="number" name="치즈" required><br><br>
        <label>햄:</label>
		<input type="number" name="햄" required><br><br>
        <label>올리브:</label>
		<input type="number" name="올리브" required><br><br>
		<input type="submit" value="주문">
	</form>
	<?php
	// 폼이 제출되면 회원 정보를 처리하는 코드
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// 데이터베이스 연결
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pizza";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// 이름과 이메일 데이터 가져오기
		$불고기 = $_POST["불고기"];
		$새우 = $_POST["새우"];
        $치즈 = $_POST["치즈"];
        $햄 = $_POST["햄"];
        $올리브 = $_POST["올리브"];

		// SQL 쿼리 실행
		$sql = "INSERT INTO users (불고기, 새우, 치즈, 햄, 올리브) VALUES ('$불고기', '$새우','$치즈', '$햄', '$올리브')";
		if ($conn->query($sql) === TRUE) {
			echo "주문이 완료되었습니다.";
			exit(header("Location: pie.php"));
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
	?>
</body>
</html>
