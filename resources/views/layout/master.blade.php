<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <title>@yield('title', 'My Site')</title> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* === GENERAL STYLES === */
        html,
        body {
            height: 100%;
            margin: 0;
        }

        #page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #content-wrap {
            flex: 1;
        }

        /* === HEADER STYLES === */
        .header-main {
            background-color: #E0E0E0;
            padding: 20px;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo {
            padding-right: 8%;
            text-decoration: none;
            font-size: 20px;
            color: #fff;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .menu li {
            margin-right: 50px;
        }

        .menu li:last-child {
            margin-right: 0;
        }

        .menu li a {
            color: #000000;
            text-decoration: none;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .bar {
            width: 25px;
            height: 3px;
            background-color: #000000;
            margin: 3px 0;
        }

        /* === RESPONSIVE HEADER === */
        @media screen and (max-width: 1010px) {
            .menu {
                display: none;
                flex-direction: column;
                background: #E0E0E0;
                position: absolute;
                top: 70px;
                right: 20px;
                width: 100%;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 10px 20px;
                border-radius: 5px;
                z-index: 999;
            }

            .menu.active {
                display: flex;
            }

            .menu-toggle {
                display: flex;
            }

            .menu-toggle.active .bar:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
            }

            .menu-toggle.active .bar:nth-child(2) {
                opacity: 0;
            }

            .menu-toggle.active .bar:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
            }

            .logo {
                padding-right: 5%;
            }
        }

        @media screen and (max-width: 350px) {
            .navbar {
                flex-direction: column;
                align-items: center;
            }

            .menu-toggle {
                margin-top: 10px;
            }
        }

        /* === LINK STYLES === */
        .hyperlink {
            color: black;
            font-size: 17px;
            text-decoration: none;
        }

        .hyperlink:hover {
            color: #5480AF;
            text-decoration: none;
        }

        /* === FOOTER === */
        .footer {
            background-color: #e2e2e2;
            padding: 40px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .footer h6 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .footer a {
            color: #000;
            text-decoration: none;
            display: block;
            margin-bottom: 8px; 
        }

        .footer a:hover {
            text-decoration: underline;
        } 

        .footer .social-icons a {
            margin-right: 10px;
            font-size: 16px;
            color: #000;
        }

        .footer .social-icons a:hover {
            color: #007bff;
        }

        .footer .logo {
            font-weight: bold;
            font-size: 18px;
        }
        .custom-border{
            border-right: 1px solid #000
        }
    </style>
</head>

<body>
    <div id="page-container">
        <div id="content-wrap">
            @include('layout.header')
            @yield('content')
        </div>
        @include('layout.footer')
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<script>
    function toggleMenu() {
    const menu = document.querySelector('.menu');
    const toggle = document.querySelector('.menu-toggle');
    menu.classList.toggle('active');
    toggle.classList.toggle('active');
}
</script>

</html>