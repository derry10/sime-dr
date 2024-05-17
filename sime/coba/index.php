<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>

    <!-- Tag head lainnya -->
</head>
<body>
    <!-- Konten lainnya -->
    <body>
    <h1>Data Anggota</h1>
    <a href="create.php">Tambah Anggota Baru</a>
    <br><br>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Kota</th>
        </tr>
        <?php include 'read.php'; ?>
    </table>
</body>
    <!-- JavaScript -->
    <script>
        // Setelah simpan sukses, tampilkan data dalam modal
        function showModalWithData(data) {
            // Ubah konten modal dengan data yang baru ditambahkan
            document.getElementById("nama").innerHTML = data.nama;
            document.getElementById("tanggal_lahir").innerHTML = data.tanggal_lahir;
            document.getElementById("kota").innerHTML = data.kota;
            
            // Tampilkan modal
            var myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();
        }

        // Mendengarkan form submit event
        document.getElementById("form").addEventListener("submit", function(event){
            event.preventDefault(); // Mencegah form untuk submit secara default
            
            // Kirim data ke server menggunakan AJAX
            var formData = new FormData(this);
            fetch('add.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showModalWithData(data); // Tampilkan data dalam modal
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
