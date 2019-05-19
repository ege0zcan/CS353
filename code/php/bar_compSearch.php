<?php
$keyword = strval($_POST['query']);
$search_param = "{$keyword}%";
$conn =new mysqli('localhost:3306','root','root','cs353');

$sql = $conn->prepare("SELECT company_name FROM comp_user WHERE company_name LIKE ?");
$sql->bind_param("s",$search_param);
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $companyResult[] = $row["company_name"];
    }
    echo json_encode($companyResult);
}
$conn->close();

?>
