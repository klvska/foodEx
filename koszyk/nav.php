<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');

        a{
            text-decoration: none;
            color: inherit;
        }
        .hamburger-menu {
            display: none;
        }

        .flex-nav {
            margin: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            font-family: 'Ubuntu', sans-serif;
            font-style: normal;
            font-size: 28px;
            font-weight: 700;
        }

        .flex-nav-left {
            display: flex;
            align-items: center;
        }

        .flex-nav-center {
            display: flex;
            align-items: center;
        }

        .flex-nav-right {
            display: flex;
            align-items: center;
        }

        .flex-nav-icon {
            margin: 20px;
        }

        .flex-nav-menu {
            display: none;
            flex-direction: column;
            align-items: flex-end;
            margin-top: 10px;
        }

        .flex-nav-menu.show {
            display: flex;
        }

        .flex-nav-menu-icon {
            display: none;
        }

        @media (max-width: 600px) {
            .hamburger-menu {
                display: block;
            }

            .flex-nav {
                flex-wrap: wrap;
                justify-content: space-between;
                padding: 10px;
            }

            .flex-nav-center {
                display: none;
            }

            .flex-nav-right {
                display: flex;
                align-items: center;
                margin-right: 10px;
            }

            .flex-nav-icon {
                margin: 5px;
            }

            .flex-nav-menu-icon {
                display: block;
            }

            #menu__toggle {
                opacity: 0;
            }

            #menu__toggle:checked + .menu__btn > span {
                transform: rotate(45deg);
            }

            #menu__toggle:checked + .menu__btn > span::before {
                top: 0;
                transform: rotate(0deg);
            }

            #menu__toggle:checked + .menu__btn > span::after {
                top: 0;
                transform: rotate(90deg);
            }

            #menu__toggle:checked ~ .menu__box {
                display: block;
            }

            .menu__btn {
                position: fixed;
                top: 60px;
                right: 30px;
                width: 30px;
                height: 30px;
                cursor: pointer;
                z-index: 1;
            }

            .menu__btn > span,
            .menu__btn > span::before,
            .menu__btn > span::after {
                display: block;
                position: absolute;
                width: 100%;
                height: 4px;
                background-color: black;
                transition-duration: .25s;
            }

            .menu__btn > span::before {
                content: '';
                top: -11px;
            }

            .menu__btn > span::after {
                content: '';
                top: 11px;
            }

            .menu__box {
                display: none;
                position: fixed;
                top: 0;
                right: 0;
                width: 300px;
                height: 100%;
                margin: 0;
                padding: 80px 0;
                list-style: none;
                background-color: #F07F00;
                box-shadow: 2px 2px 6px rgba(0, 0, 0, .4);
                transition-duration: .25s;
            }

            .menu__item {
                display: block;
                padding: 12px 24px;
                color: black;
                text-decoration: none;
                transition-duration: .25s;
            }

            .menu__item:hover {
                background-color: white;
            }
        }

        @media (max-width: 400px) {
            .flex-nav {
                font-size: 20px;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/9948b88951.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var menu = document.getElementById('flex-nav-menu');
            var icon = document.getElementById('menu__toggle');
            var menuBtn = document.getElementById('menu__btn');

            function toggleMenu() {
                menu.classList.toggle('show');
                menuBtn.classList.toggle('active');
            }

            menuBtn.addEventListener('click', toggleMenu);

            document.addEventListener('click', function(event) {
                var target = event.target;

                if (!menu.contains(target) && target !== menuBtn) {
                    menu.classList.remove('show');
                    menuBtn.classList.remove('active');
                }
            });
        });
    </script>
</head>
<body>
<div class="flex-nav">
    <div class="flex-nav-left">
        <div class="flex-nav-icon">FoodEx</div>
    </div>

    <div class="flex-nav-center">
        <div class="flex-nav-icon"><a href="#">Home</a></div>
        <div class="flex-nav-icon"><a href="../products.php">Menu</a></div>
        <div class="flex-nav-icon"><a href="../map.php">Map</a></div>
        <div class="flex-nav-icon"><a href="contact.php">Contact</a></div>
    </div>

    <div class="flex-nav-right">
        <div class="flex-nav-icon flex-nav-user-icon"><a href="../dashboard.php"><i class="fas fa-user fa-lg"></i></a></div>
        <div class="flex-nav-icon flex-nav-cart-icon"><a href="../koszyk/koszyk.php"><i class="fas fa-shopping-cart fa-lg"></i></a></div>
        <div class="hamburger-menu">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
                <span></span>
            </label>

            <ul class="menu__box" id="flex-nav-menu">
                <li><a class="menu__item" href="#">Home</a></li>
                <li><a class="menu__item" href="../products.php">Menu</a></li>
                <li><a class="menu__item" href="../map.php">Map</a></li>
                <li><a class="menu__item" href="#">Contact</a></li>
            </ul>
        </div>


    </div>
</div>
</body>
</html>

