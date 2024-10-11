<?php
include("conexao.php");
$db = new Conexao();
$id = $_GET['id'];
$sql = "DELETE FROM membros WHERE id = '$id'";
$result = mysqli_query($db->conn, $sql);
if($result){
    header("Location:welcome.php?msg=Deletado com sucesso"); 
}else{
    echo "Error: " . $sql . "<br>" . $db->conn->error;
}
?>