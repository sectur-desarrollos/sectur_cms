<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/bootnavbar.css" />

    <title>
        Multi level hover dropdown Navbar for bootstrap 4 and bootstrap 5
    </title>
    <meta name="description" content="Multi level hover dropdown Navbar for bootstrap 4 and bootstrap 5" />
    <meta name="keywords" content="Multi level hover dropdown Navbar for bootstrap 4 and bootstrap 5" />
    <style>
        .dropdown-menu {
            margin-top: 0;
        }

        .dropdown-menu .dropdown-toggle::after {
            vertical-align: middle;
            border-left: 4px solid;
            border-bottom: 4px solid transparent;
            border-top: 4px solid transparent;
        }

        .dropdown-menu .dropdown .dropdown-menu {
            left: 100%;
            top: 0%;
            margin: 0 20px;
            border-width: 0;
        }

        .dropdown-menu .dropdown .dropdown-menu.left {
            right: 100%;
            left: auto;
        }

        @media (min-width: 768px) {
            .dropdown-menu .dropdown .dropdown-menu {
                margin: 0;
                border-width: 1px;
            }

            .dropdown-menu>li a:hover,
            .dropdown-menu>li.show {
                background: #007bff;
                color: white;
            }

            .dropdown-menu>li.show>a {
                color: white;
            }
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="main_navbar">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Menu 1
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item dropdown">
                                <a class="dropdown-item dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    Submenu 1
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item dropdown">
                                        <a class="dropdown-item dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown">
                                            Submenu 2
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li>
                                                <a class="dropdown-item" href="#">Another action</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Action</a></li>

                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="#">Action</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="alert alert-info">
            <a href="https://github.com/kmlpandey77/bootnavbar#readme">
                How to use bootNavbar
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function bootnavbar(options) {
            const defaultOption = {
                selector: "main_navbar",
                animation: true,
                animateIn: "animate__fadeIn",
            };

            const bnOptions = {
                ...defaultOption,
                ...options
            };

            init = function () {
                var dropdowns = document
                    .getElementById(bnOptions.selector)
                    .getElementsByClassName("dropdown");

                Array.prototype.forEach.call(dropdowns, (item) => {
                    //add animation
                    if (bnOptions.animation) {
                        const element = item.querySelector(".dropdown-menu");
                        element.classList.add("animate__animated");
                        element.classList.add(bnOptions.animateIn);
                    }

                    //hover effects
                    item.addEventListener("mouseover", function () {
                        this.classList.add("show");
                        const element = this.querySelector(".dropdown-menu");
                        element.classList.add("show");
                    });

                    item.addEventListener("mouseout", function () {
                        this.classList.remove("show");
                        const element = this.querySelector(".dropdown-menu");
                        element.classList.remove("show");
                    });
                });
            };

            init();
        }

    </script>
    <script>
        new bootnavbar();

    </script>
</body>

</html>
