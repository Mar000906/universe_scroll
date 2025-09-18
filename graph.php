<?php
include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Universe Scroll - Statistiques</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin:0;
            font-family:'Poppins', Arial, sans-serif;
            background: radial-gradient(circle at top, #120024, #000);
            color:white;
        }
        body::before {
            content:"";
            position:fixed; top:0; left:0;
            width:100%; height:100%;
            background: transparent url('https://www.transparenttextures.com/patterns/stardust.png') repeat;
            opacity:0.35; z-index:-1;
            animation: twinkle 12s infinite linear;
        }
        @keyframes twinkle {
            from { background-position:0 0; }
            to { background-position:1000px 1000px; }
        }
        nav {
            background: rgba(0,0,0,0.85);
            padding:15px 30px;
            display:flex; justify-content:space-between; align-items:center;
            font-size:18px; border-bottom:2px solid #a64dff; position:sticky; top:0; z-index:50;
        }
        .nav-left, .nav-right { display:flex; gap:25px; }
        nav a { color:white; text-decoration:none; font-weight:bold; position:relative; transition:0.3s; }
        nav a::after {
            content:""; position:absolute; width:0; height:2px;
            background:linear-gradient(to right,#a64dff,#ff6ec7); left:0; bottom:-5px;
            transition: width 0.3s ease;
        }
        nav a:hover::after { width:100%; }
        .btn-nav {
            background:linear-gradient(to right,#a64dff,#ff6ec7);
            color:white; padding:8px 18px; font-size:16px; font-weight:bold;
            border:none; cursor:pointer; border-radius:20px;
            transition:0.3s; box-shadow:0 0 15px rgba(166,77,255,0.4);
        }
        .btn-nav:hover {
            transform:scale(1.05);
            background:linear-gradient(to right,#ff6ec7,#a64dff);
            box-shadow:0 0 25px rgba(255,110,199,0.7);
        }
        header {
            text-align:center;
            font-size:26px;
            font-weight:bold;
            padding:20px;
            background: rgba(0,0,0,0.6);
            border-bottom:2px solid #a64dff;
            color: #ff6ec7;
        }
        #charts-wrap { 
            display:flex; flex-wrap:wrap; gap:20px; padding:20px; justify-content:center;
        }
        .chart-container {
            background: rgba(29,6,45,0.9);
            padding:15px;
            border-radius:12px;
            box-shadow:0 8px 30px rgba(166,77,255,0.25);
            width:400px; max-width:90%;
        }
        .chart-container h3 { text-align:center; color:#ff6ec7; margin-bottom:10px; }
    </style>
</head>
<body>
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

<header>📊 Planet Statistics</header>

<div id="charts-wrap">
    <div class="chart-container">
        <h3>Orbital Speed ​​vs. Distance from the Sun</h3>
        <canvas id="orbitalSpeedChart"></canvas>
    </div>
    <div class="chart-container">
        <h3>Mass vs. Distance from the Sun</h3>
        <canvas id="massDistanceChart"></canvas>
    </div>
    <div class="chart-container">
        <h3>Kinetic Energy and Distance</h3>
        <canvas id="kineticEnergyChart"></canvas>
    </div>
    <div class="chart-container">
        <h3>Orbital Speed ​​vs Mass</h3>
        <canvas id="speedMassChart"></canvas>
    </div>
</div>

<script>
// Données planètes
const planets = [
    {name:"Mercury", dist:70, mass:0.33, speed:1.6},
    {name:"Venus", dist:110, mass:4.87, speed:1.2},
    {name:"Earth", dist:150, mass:5.97, speed:1.0},
    {name:"Mars", dist:190, mass:0.642, speed:0.8},
    {name:"Jupiter", dist:280, mass:1898, speed:0.55},
    {name:"Saturn", dist:360, mass:568, speed:0.45},
    {name:"Uranus", dist:420, mass:86.8, speed:0.35}
];

const labels = planets.map(p => p.name);
const orbitalSpeeds = planets.map(p => p.speed);
const masses = planets.map(p => p.mass);
const distances = planets.map(p => p.dist);
const kineticEnergy = planets.map(p => 0.5 * p.mass * p.speed * p.speed);

// Graphique 1: Vitesse orbitale vs Distance
new Chart(document.getElementById('orbitalSpeedChart'), {
    type:'bar',
    data:{ labels:labels, datasets:[{ label:'Vitesse orbitale', data:orbitalSpeeds, backgroundColor:'#a64dff' }]},
    options:{ responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}} }
});

// Graphique 2: Masse vs Distance
new Chart(document.getElementById('massDistanceChart'), {
    type:'line',
    data:{ labels:distances, datasets:[{ label:'Masse (10^24 kg)', data:masses, borderColor:'#ff6ec7', backgroundColor:'rgba(255,110,199,0.2)', fill:true, tension:0.3 }]},
    options:{ responsive:true, plugins:{legend:{display:true}}, scales:{ x:{ title:{display:true,text:'Distance au Soleil (10^6 km)'} }, y:{ title:{display:true,text:'Masse (10^24 kg)'}, beginAtZero:true} } }
});

// Graphique 3: Énergie cinétique vs Distance
new Chart(document.getElementById('kineticEnergyChart'), {
    type:'line',
    data:{ labels:distances, datasets:[{ label:'Énergie Cinétique (arbitraire)', data:kineticEnergy, borderColor:'#00ffff', backgroundColor:'rgba(0,255,255,0.2)', fill:true, tension:0.3 }]},
    options:{ responsive:true, plugins:{legend:{display:true}}, scales:{ x:{ title:{display:true,text:'Distance au Soleil (10^6 km)'} }, y:{ title:{display:true,text:'Énergie Cinétique (units arbitraires)'}, beginAtZero:true} } }
});

// Graphique 4: Vitesse orbitale vs Masse
new Chart(document.getElementById('speedMassChart'), {
    type:'scatter',
    data:{
        datasets:[{
            label:'Vitesse orbitale vs Masse',
            data:planets.map(p=>({x:p.mass, y:p.speed})),
            backgroundColor:'#ff6ec7'
        }]
    },
    options:{
        responsive:true,
        plugins:{legend:{display:true}},
        scales:{
            x:{ title:{display:true,text:'Masse (10^24 kg)'} },
            y:{ title:{display:true,text:'Vitesse orbitale'} }
        }
    }
});
</script>
</body>
</html>
