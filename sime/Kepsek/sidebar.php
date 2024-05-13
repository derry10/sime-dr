 <!-- Sidebar Toggle Button for Mobile View -->
 <div class="sidebar collapse d-md-block" id="sidebarMenu">
        <button class="btn btn-close float-end m-2 btn-close-sidebar" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        <div>
            <h2 class="rounded-end p-2 me-5" style="background-color:#FFF455; color: #007F73;">SIMe</h2>
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item d-flex align-items-center mx-2">
                <a class="btn btn-outline-secondary border-0 mx-3" style="color:white;" href="dashboard.php">
                    <img src="../img/home.png" alt="Home" width="28" height="28"> Dashboard
                </a>
            </li>
            <li class="nav-item d-flex align-items-center mx-2">
                <a class="btn btn-outline-secondary border-0 mx-3" style="color:white;" href="profil.php">
                    <img src="../img/profil.png" alt="Profile" width="28" height="38"> Lihat Profil
                </a>
            </li>
            <li class="nav-item d-flex align-items-center mx-2">
                <a class="btn btn-outline-secondary border-0 mx-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../img/ekskul.png" alt="Reports" width="28" height="28"> Laporan
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="pesertaNilai.php">Laporan Peserta dan Nilai</a></li>
                    <li><a class="dropdown-item" href="kegiatan.php">Laporan Kegiatan</a></li>
                    <li><a class="dropdown-item" href="kehadiran.php">Laporan Kehadiran</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Finish sidebar -->