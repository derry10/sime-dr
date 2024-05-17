<?php
include 'config.php';

$sql = "SELECT * FROM anggota";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nama"]. "</td><td>" . $row["tanggal_lahir"]. "</td><td>" . $row["kota"]. "</td></tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
