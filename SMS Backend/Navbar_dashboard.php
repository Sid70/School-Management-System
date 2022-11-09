<?

    require_once('config.php');

?>

<!-- Navbar start -->

<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">My School</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
            aria-controls="staticBackdrop" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="home">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <li class="nav-item dropdown px-3">
                    <a class="nav-link dropdown-toggle text-white" href="#dashboard" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Dashboard
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#Manage-Account" onclick="openMenu('Manage-Account');">Manage Account</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../index.html">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h2><a class="navbar-brand" href="#">My School</a></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr>
    <div class="offcanvas-body">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#Home" onclick="openMenu('Home');">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#Admission"
                    onclick="openMenu('Admission');">Admission</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link active" href="#Assesment" role="button" onclick="openMenu('Assesment');">
                    Assesment
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#Fee-Structure"
                    onclick="openMenu('Fee-Structure');">Fee Structure</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#Faculty"
                    onclick="openMenu('Faculty');">Faculty</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#Time-Table" onclick="openMenu('Time-Table');">Time
                    Table</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    More
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#Manage-Account" onclick="openMenu('Manage-Account');">Manage Account</a></li>
                    <li><a class="dropdown-item" href="../index.html">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>


<!-- Navbar End -->

<!-- Left fixed Navbar -->
<div class="sidebar">
    <a class="active" href="#Home" onclick="openMenu('Home');"><i class="fa-solid fa-house-chimney"></i>
        Home</a>
    <a href="#Admission" onclick="openMenu('Admission');"><i class="fa-solid fa-school"></i> Student Admission</a>
    <a href="#Assesment" onclick="openMenu('Assesment');"><i class="fa-solid fa-square-poll-vertical"></i>
        Assesment</a>
    <a href="#Fee-Structure" onclick="openMenu('Fee-Structure');"><i class="fa-solid fa-chalkboard-user"></i>
        Fee
        Structure</a>
    <a href="#Faculty" onclick="openMenu('Faculty');"><i class="fa-solid fa-school"></i> Faculty</a>
    <a href="#Time-Table" onclick="openMenu('Time-Table');"><i class="fa-solid fa-school"></i> Time Table</a>
</div>