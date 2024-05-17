<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Ekskul Baru</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #007F73;
        font-family: 'Poppins', sans-serif;
        color: #fff;
        margin: 0;
    }
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        padding: 0 20px;
    }
    .form-container {
        background-color: #FFC700;
        padding: 20px;
        border-radius: 10px;
        width: 90%;
        max-width: 500px;
        margin-top: auto; /* Menempatkan kontainer kuning di tengah */
        margin-bottom: auto; /* Menempatkan kontainer kuning di tengah */
    }
    @media (max-width: 576px) {
        .form-container {
            width: 100%;
            max-width: none;
        }
    }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h3 class="text-black text-center">Buat Ekskul Baru</h3>
        <form action="create_ekskul_process.php" method="post">
            <div class="form-label mb-2" style="color: black;">
                Nama Ekskul
                <input type="text" placeholder="Masukkan nama ekskul" class="form-control py-2" id="nama" name="nama" required>
            </div>
            <div class="form-label mb-2" style="color: black;">
                Deskripsi
                <textarea placeholder="Masukkan deskripsi ekskul" class="form-control py-2" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-label mb-2" style="color: black;">
                Hari
                <input type="text" placeholder="Masukkan hari kegiatan" class="form-control py-2" id="hari" name="hari" required>
            </div>
            <div class="form-label mb-2" style="color: black;">
                Jam
                <input type="time" placeholder="Masukkan jam kegiatan" class="form-control py-2" id="jam" name="jam" required>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-secondary border-0 mx-3" type="submit" style="background-color: #007F73;" id="createButton">Buat Ekskul</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
