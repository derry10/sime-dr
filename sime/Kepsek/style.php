<style>
    /* Custom CSS */
    
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background-color: #A6A6A6;
    }

        /* Optional: Hide the sidebar toggle button on larger screens if sidebar is always visible */
    .nav-link{
        background-color: #FF0000;
        color: white;
        border-radius: 8px;

    }
    .nav-link a{
        color: white;

    }
    .sidebar {
      background-color: #007F73;
      height: 100vh;
      width: 20%;
      position: fixed;
      top: 0;
      left: 0;
      padding-top: 3rem;

    }
    @media (min-width: 768px) {
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 48px 0 0; /* Height of the navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        .btn-close-sidebar {
            display: none; /* Hide close button on desktop views */
        }
    }
    .content {
      margin-left: 20%; /* Sesuaikan dengan lebar sidebar */
      padding: 2rem;
    }
    @media (max-width: 768px) {

      .sidebar {
            width: 100%;
        }
      .content {
        margin-left: 0%; /* Sesuaikan dengan lebar sidebar */
        padding: 0.2rem;
      }
    }
    .profile-card {
      background-color: #D9D9D9;
      padding: 1rem;
      border-radius: 10px;
    }
    .profile-img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }
    .logout-btn {
      margin-right: 1rem;
    }
    .menu-item {
      color: #fff;
      text-decoration: none;
    }
    .square-column {
        width: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .square-column img {
        max-width: 100%;
        max-height: 100%;
        margin-right: 20px; 
    }
    .modal-title{
        display: flex;
        align-items: center;
        justify-content: center;
        text-align:center;
    }
    
  </style>
