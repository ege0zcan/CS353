<?php
$keyword = strval($_POST['query']);
$search_param = "{$keyword}%";
$conn =new mysqli('localhost:3306','root','root','cs353');

$sql = $conn->prepare("SELECT state FROM location NATURAL JOIN comp_user WHERE company_name = ? & state LIKE ?");
$sql->bind_param("s",$search_param);
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locationResult[] = $row["state"];
    }
    echo json_encode($locationResult);
}
$conn->close();

?>
