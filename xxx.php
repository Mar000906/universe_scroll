<?php
include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Universe Scroll - Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: radial-gradient(circle at top, #120024, #000);
            color: white;
            overflow-x: hidden;
        }

        /* Effet étoiles animées */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: transparent url('https://www.transparenttextures.com/patterns/stardust.png') repeat;
            opacity: 0.35;
            z-index: -1;
            animation: twinkle 12s infinite linear;
        }
        @keyframes twinkle {
            from { background-position: 0 0; }
            to { background-position: 1000px 1000px; }
        }

        /* Menu amélioré */
        nav {
            background: rgba(0,0,0,0.85);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            border-bottom: 2px solid #a64dff;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-left, .nav-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        nav a {
            color:white;
            text-decoration:none;
            font-weight:bold;
            position: relative;
            transition:0.3s;
        }
        nav a::after {
            content: "";
            position: absolute;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #a64dff, #ff6ec7);
            left: 0;
            bottom: -5px;
            transition: width 0.3s ease;
        }
        nav a:hover::after {
            width: 100%;
        }

        /* Boutons nav */
        .btn-nav {
            background: linear-gradient(to right,#a64dff,#ff6ec7);
            color:white;
            padding:8px 18px;
            font-size:16px;
            font-weight:bold;
            border:none;
            cursor:pointer;
            border-radius:20px;
            transition:0.3s;
            box-shadow:0 0 15px rgba(166,77,255,0.4);
        }
        .btn-nav:hover {
            transform:scale(1.05);
            background: linear-gradient(to right,#ff6ec7,#a64dff);
            box-shadow:0 0 25px rgba(255,110,199,0.7);
        }

        /* Sections principales */
        #intro, #planet-detail, #venus-detail, #all-planets {
            display:none;
            padding:50px;
        }

        /* Intro */
        #intro {
            text-align:center;
        }
        #intro h1 {
            font-size:60px;
            margin-bottom:10px;
            background: linear-gradient(to right,#a64dff,#ff6ec7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        #intro p { font-size:20px; color:#ddd; margin-bottom:30px; }

        /* Boutons */
        .btn {
            background: linear-gradient(to right,#a64dff,#ff6ec7);
            color:white; padding:14px 30px; font-size:18px; font-weight:bold;
            border:none; cursor:pointer; border-radius:25px; transition:0.3s;
            box-shadow:0 0 15px rgba(166,77,255,0.5);
        }
        .btn:hover { transform:scale(1.05); background: linear-gradient(to right,#ff6ec7,#a64dff); }

        /* Détail de la planète */
        #planet-detail {
            display:flex;
            justify-content: space-around;
            align-items:center;
            flex-wrap: wrap;
        }
        .planet-info {
            flex:1;
            max-width:500px;
            text-align:left;
        }
        .planet-info h2 { font-size:50px; margin-bottom:20px; color:#a64dff; }
        .planet-info p { font-size:18px; line-height:1.5; color:#ddd; margin-bottom:20px; }
        .planet-info .btn { margin-top:10px; }

        .planet-globe {
            flex:1;
            max-width:400px;
        }
        .planet-globe img {
            width:100%;
            border-radius:50%;
            animation: rotate 20s linear infinite;
            box-shadow:0 0 40px rgba(255,110,199,0.7);
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Détail de Vénus */
        #venus-detail {
            text-align:center;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 15px;
            padding: 30px;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: 0 0 20px rgba(166,77,255,0.4);
        }
        #venus-detail h2 {
            font-size: 40px;
            margin-bottom: 20px;
            color: #ff6ec7;
        }
        #venus-detail p {
            font-size: 18px;
            line-height: 1.6;
            color: #ddd;
            margin-bottom: 30px;
        }

        /* Grid des planètes */
        #all-planets {
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
            gap:50px;
            padding:50px;
        }
        .planet-card {
            background: rgba(255,255,255,0.05);
            border-radius:20px;
            padding:25px;
            transition:0.4s;
            box-shadow:0 0 20px rgba(0,0,0,0.6);
            text-align:center;
            backdrop-filter: blur(8px);
        }
        .planet-card:hover {
            transform:scale(1.08);
            background: rgba(255,255,255,0.15);
            box-shadow:0 0 40px rgba(166,77,255,0.7);
        }
        .planet-card h3 {
            margin:10px 0;
            font-size:24px;
            color:#a64dff;
        }
        .planet-card p {
            font-size:15px;
            line-height:1.5;
            color:#ddd;
            margin-bottom:20px;
        }
        .planet-card img {
            width:170px;
            height:170px;
            border-radius:50%;
            animation: rotate 20s linear infinite;
            box-shadow:0 0 35px rgba(255,110,199,0.9);
            margin-bottom:15px;
            transition:0.4s;
        }
        .planet-card img:hover {
            transform:scale(1.1);
            box-shadow:0 0 50px rgba(255,255,255,1);
        }

        /* Bouton Voir plus */
        .btn-detail {
            display: inline-block;
            background: linear-gradient(to right, #a64dff, #ff6ec7);
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 25px;
            text-decoration: none;
            transition: 0.3s;
            margin-top: 10px;
            box-shadow:0 0 15px rgba(166,77,255,0.5);
        }
        .btn-detail:hover {
            transform: scale(1.05);
            background: linear-gradient(to right, #ff6ec7, #a64dff);
            color: white;
            box-shadow: 0 0 25px rgba(255,110,199,0.8);
        }
    </style>
</head>
<body>

<!-- Menu -->
<nav>
    <div class="nav-left">
        <a href="dashboard.php">Planets</a>
        <a href="trailer.php">Trailer</a>
        <a href="simulation.php">Simulation</a>
        <a href="graph.php">Graph</a>
      
    </div>
    <div class="nav-right">
        <button class="btn-nav" onclick="window.location.href='entre.php'">Login</button>
        <button class="btn-nav" onclick="window.location.href='logout.php'">Logout</button>
    </div>
</nav>

<!-- Intro -->
<div id="intro">
    <h1>Earth</h1>
    <p>Bienvenue dans votre voyage à travers l'Univers 🌌</p>
    <button class="btn" onclick="showPlanetDetail()">Commencer</button>
</div>

<!-- Planet Detail -->
<div id="planet-detail">
    <div class="planet-info">
        <h2>Earth</h2>
        <p>Earth is the third planet from the Sun. Earth's axis of rotation is tilted with respect to its orbital plane, producing seasons on Earth. The gravitational interaction between Earth and the Moon causes tides, stabilizes Earth's orientation on its axis, and gradually slows its rotation.</p>
        <button class="btn" onclick="showVenusDetail()">Learn More</button>
    </div>
    <div class="planet-globe">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/97/The_Earth_seen_from_Apollo_17.jpg" alt="Earth">
    </div>
</div>

<!-- All planets grid -->
<div id="all-planets">
    <div class="planet-card">
        <p>Venus is the second largest and hottest planet in the solar system.</p>
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e5/Venus-real_color.jpg" alt="Vénus">
        <a class="btn-detail" href="venus.php">Voir plus</a>
        <h3>Vénus</h3>
    </div>
    <div class="planet-card">
        <p>Mars is the fourth planet in the solar system and is known as the red planet.</p>
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/02/OSIRIS_Mars_true_color.jpg" alt="Mars">
        <a class="btn-detail" href="mars.php">Voir plus</a>
        <h3>Mars</h3>
    </div>
    <div class="planet-card">
        <p>Jupiter is the largest planet in the solar system, a gas giant.</p>
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Jupiter.jpg" alt="Jupiter">
        <a class="btn-detail" href="jupiter.php">Voir plus</a>
        <h3>Jupiter</h3>
    </div>
    <div class="planet-card">
        <p>Mercury is the closest planet to the Sun and the smallest.</p>
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/4a/Mercury_in_true_color.jpg" alt="Mercury">
        <a class="btn-detail" href="mercury.php">Voir plus</a>
        <h3>Mercury</h3>
    </div>
    <div class="planet-card">
        <p>Uranus is an ice giant with a highly tilted rotation axis.</p>
        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3d/Uranus2.jpg" alt="Uranus">
        <a class="btn-detail" href="uranus.php">Voir plus</a>
        <h3>Uranus</h3>
    </div>
    <div class="planet-card">
        <p>Saturn is famous for its beautiful rings.</p>
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Saturn_during_Equinox.jpg" alt="Saturn">
        <a class="btn-detail" href="saturn.php">Voir plus</a>
        <h3>Saturn</h3>
    </div>
</div>

<script>
function showPlanetDetail(){
    document.getElementById("intro").style.display="none";
    document.getElementById("planet-detail").style.display="flex";
}

function showVenusDetail(){
    document.getElementById("planet-detail").style.display="none";
    document.getElementById("venus-detail").style.display="block";
}

function showAllPlanets(){
    document.getElementById("venus-detail").style.display="none";
    document.getElementById("all-planets").style.display="grid";
}
</script>

</body>
</html>




