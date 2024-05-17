<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        margin-top: 8%;
    }
    .login-container {
        background-color: #FFF455;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        width: 90%;
        max-width: 500px;
    }
    .form-container {
        background-color: #FFC700;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
    }

    @media (max-width: 576px) {
        .login-container {
            width: 100%;
            max-width: none;
        }
    }
    </style>

</head>
<body>

<div class="container">
    <h3 class="">Register</h3>
    <div class="login-container px-6">
        <div class="form-container mx-8">
            <form action="register_process.php" method="post">
                <div class="form-label mb-2" style="color: black;">
                    Nama Lengkap
                    <input type="text" placeholder="Masukan nama lengkap" class="form-control py-2"  id="namalengkap" name="namalengkap" required>
                </div>
                <div class="form-label mb-2" style="color: black;">
                    Email
                    <input type="email" placeholder="Masukan email" class="form-control py-2"  id="email" name="email" required>
                </div>
                <div class="form-label mb-2" style="color: black;">
                    Password
                    <input type="password" placeholder="Masukan password" class="form-control py-2" id="password" name="password" required>
                </div>
                <div class="form-label mb-2" style="color: black;">
                    Ketik Ulang Password
                    <input type="password" placeholder="Ketik ulang password" class="form-control py-2" id="ulangpassword" name="ulangpassword" required>
                </div>
                <div class="mb-2" style="color: black;">
                    Pilih Level
                    <div class="dropdown">
                        <a class="btn btn-secondary border-0 py-2" style="background-color: white; color: black" id="levelButton">Level</a>
                        <button class="btn btn-secondary dropdown-toggle py-2" type="button" id="dropdownMenuButtonLevel" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu dropdown-menu-level" aria-labelledby="dropdownMenuButtonLevel">
                            <li><a class="dropdown-item level" href="#" data-value="anggota">Anggota</a></li>
                            <li><a class="dropdown-item level" href="#" data-value="pembina">Pembina</a></li>
                        </ul>
                        <input type="hidden" name="level" id="selectedLevel">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="login.php" class="btn btn-danger border-0 me-3">Kembali</a>
                    <button class="btn btn-secondary border-0 mx-3" type="submit" style="background-color: #007F73;" id="registerButton">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const dropdownItemsLevel = document.querySelectorAll('.level');
    const selectedLevelInput = document.getElementById('selectedLevel');

    dropdownItemsLevel.forEach(item => {
        item.addEventListener('click', function() {
            const selectedValue = this.getAttribute('data-value');
            selectedLevelInput.value = selectedValue;
            document.getElementById('dropdownMenuButtonLevel').textContent = this.textContent;
        });
    });
</script>
</body>
</html>
