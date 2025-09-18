<?php
include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Universe Scroll - Simulation</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: radial-gradient(circle at top, #120024, #000);
            color: white;
            overflow: hidden;
        }

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

        header {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            padding: 20px;
            background: rgba(0,0,0,0.6);
            border-bottom: 2px solid #a64dff;
            color: #ff6ec7;
        }

        /* canvas occupies viewport below header */
        #canvas-wrap { position: relative; width: 100%; height: calc(100vh - 100px); }
        canvas {
            display: block;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, #120024, #000);
        }

        .legend {
            position: absolute;
            bottom: 20px;
            left: 30px;
            background: rgba(0,0,0,0.6);
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 15px;
            box-shadow: 0 0 15px rgba(166,77,255,0.5);
        }
        .legend span {
            display: inline-block;
            margin-right: 15px;
        }
        .dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 5px;
        }

        /* panneau des calculs (contrôles + infos) */
        .calculs {
            position: absolute;
            top: 120px;
            right: 20px;
            width: 300px;
            background: linear-gradient(180deg, rgba(29,6,45,0.9), rgba(12,3,22,0.85));
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(166,77,255,0.25);
            font-size: 14px;
            max-height: 70vh;
            overflow-y: auto;
            color: #e7e7ff;
            z-index: 60;
        }
        .calculs h3 {
            margin: 0 0 10px;
            color: #ff6ec7;
            font-size: 16px;
            text-align: center;
        }
        .calculs p { margin: 6px 0; color: #ddd; font-size: 13px; }
        .calculs .status { font-weight:700; color: #a64dff; }
        .controls { display:flex; gap:10px; margin-top:10px; }
        .controls button {
            flex:1;
            padding:8px 10px;
            border-radius:10px;
            border:none;
            cursor:pointer;
            font-weight:700;
            background: linear-gradient(90deg,#a64dff,#ff6ec7);
            color:white;
            box-shadow: 0 6px 18px rgba(166,77,255,0.12);
        }
        .controls button.pause { background: linear-gradient(90deg,#ff6ec7,#a64dff); }
        .controls button.step { background: rgba(255,255,255,0.06); color:#fff; box-shadow:none; font-weight:600; }

        .small-note { margin-top:10px; font-size:12px; color:#bfb8f8; }
        pre { background: rgba(0,0,0,0.25); padding:8px; border-radius:8px; overflow:auto; color:#e8e8ff; font-size:12px; }

        /* responsive */
        @media (max-width:900px){
            .calculs { position: static; width: calc(100% - 40px); margin: 12px 20px; }
            #canvas-wrap { height: calc(100vh - 240px); }
        }
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

<header>🌌 Gravitational Simulation of Planets</header>

<div id="canvas-wrap">
    <canvas id="universe"></canvas>

    <div class="legend">
        <span><span class="dot" style="background:gray;"></span>Mercury</span>
        <span><span class="dot" style="background:orange;"></span>Venus</span>
        <span><span class="dot" style="background:blue;"></span>Earth</span>
        <span><span class="dot" style="background:red;"></span>Mars</span>
        <span><span class="dot" style="background:gold;"></span>Jupiter</span>
        <span><span class="dot" style="background:beige;"></span>Saturn</span>
        <span><span class="dot" style="background:cyan;"></span>Uranus</span>
    </div>

    <!-- panneau calculs + contrôles -->
    <div class="calculs" id="calculs">
        <h3>📊 Data & Controls</h3>
        <p>Status : <span id="simStatus" class="status">Running</span></p>
        <p>Planets : <span id="nbPlanetes"></span></p>
        <div style="margin-top:8px;">
            <div class="controls">
                <button id="toggleSim" class="pause">Pause</button>
                <button id="stepBtn" class="step" title="Avancer d'une étape">Step</button>
            </div>
        </div>
        <div class="small-note">Click on the canvas to Pause/Resume as well.</div>
        <hr style="border:0;border-top:1px solid rgba(255,255,255,0.05);margin:10px 0;">
        <div id="details"></div>
    </div>
</div>

<script>
// ======== SIMULATION AVEC LOI DE NEWTON (avec pause/resume/step) ========
const canvas = document.getElementById("universe");
const ctx = canvas.getContext("2d");
function resizeCanvas(){
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight - 100;
    // reposition sun center when resizing
    sun.x = canvas.width/2;
    sun.y = canvas.height/2;
}
window.addEventListener("resize", resizeCanvas);

// Constantes (échelle simplifiée pour visualisation)
const G = 0.1;
const sun = { x: window.innerWidth/2, y: (window.innerHeight - 100)/2, mass: 50000, radius: 35, color: "yellow" };

// Planètes (initial positions and velocities)
const planets = [
    {name:"Mercury", color:"gray", mass:0.33, x:sun.x+70, y:sun.y, vx:0, vy:1.6},
    {name:"Venus", color:"orange", mass:4.87, x:sun.x+110, y:sun.y, vx:0, vy:1.2},
    {name:"Earth", color:"blue", mass:5.97, x:sun.x+150, y:sun.y, vx:0, vy:1.0},
    {name:"Mars", color:"red", mass:0.642, x:sun.x+190, y:sun.y, vx:0, vy:0.8},
    {name:"Jupiter", color:"gold", mass:1898, x:sun.x+280, y:sun.y, vx:0, vy:0.55},
    {name:"Saturn", color:"beige", mass:568, x:sun.x+360, y:sun.y, vx:0, vy:0.45},
    {name:"Uranus", color:"cyan", mass:86.8, x:sun.x+420, y:sun.y, vx:0, vy:0.35}
];

// drawing helpers
function drawSun(){
    ctx.beginPath();
    ctx.arc(sun.x, sun.y, sun.radius, 0, Math.PI*2);
    ctx.fillStyle = sun.color;
    ctx.shadowColor = "yellow";
    ctx.shadowBlur = 50;
    ctx.fill();
    ctx.shadowBlur = 0;
}
function drawPlanet(p){
    ctx.beginPath();
    ctx.arc(p.x, p.y, 8, 0, Math.PI*2);
    ctx.fillStyle = p.color;
    ctx.fill();
}

// physics update using Newton's law F = G * m1 * m2 / r^2
function updatePlanet(p){
    let dx = sun.x - p.x;
    let dy = sun.y - p.y;
    let r = Math.sqrt(dx*dx + dy*dy);

    // prevent division by zero and excessive acceleration
    if (r < 5) r = 5;

    let F = (G * sun.mass * p.mass) / (r*r);

    // acceleration components: a = F/m ; direction = dx/r, dy/r
    let ax = (F * dx / r) / p.mass;
    let ay = (F * dy / r) / p.mass;

    p.vx += ax;
    p.vy += ay;

    p.x += p.vx;
    p.y += p.vy;
}

// simulation control variables
let running = true;
let animId = null;

// update the info panel
function updateCalculs(){
    document.getElementById("nbPlanetes").innerText = planets.length;
    let details = "";
    planets.forEach(p => {
        const speed = Math.sqrt(p.vx*p.vx + p.vy*p.vy);
        details += `<p><b>${p.name}</b> — x:${p.x.toFixed(0)} y:${p.y.toFixed(0)} • v:${speed.toFixed(3)}</p>`;
    });
    document.getElementById("details").innerHTML = details;
    document.getElementById("simStatus").innerText = running ? "Running" : "Paused";
}

// single simulation frame (useful for Step)
function singleFrame(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    drawSun();
    planets.forEach(p => { updatePlanet(p); drawPlanet(p); });
    updateCalculs();
}

// animation loop
function animate(){
    // if stopped, do not schedule further frames
    if(!running) {
        return;
    }
    ctx.clearRect(0,0,canvas.width,canvas.height);
    drawSun();
    planets.forEach(p => {
        updatePlanet(p);
        drawPlanet(p);
    });
    updateCalculs();
    animId = requestAnimationFrame(animate);
}

// start/resume simulation
function startSim(){
    if(!running){
        running = true;
        document.getElementById('toggleSim').textContent = 'Pause';
        document.getElementById('toggleSim').classList.add('pause');
        animate();
        updateCalculs();
    }
}

// stop/pause simulation
function stopSim(){
    if(running){
        running = false;
        document.getElementById('toggleSim').textContent = 'Resume';
        document.getElementById('toggleSim').classList.remove('pause');
        if(animId) cancelAnimationFrame(animId);
        updateCalculs();
    }
}

// toggle function
function toggleSim(){
    if(running) stopSim();
    else startSim();
}

// Attach events
document.getElementById('toggleSim').addEventListener('click', (e) => {
    e.stopPropagation();
    toggleSim();
});
document.getElementById('stepBtn').addEventListener('click', (e) => {
    e.stopPropagation();
    // if running, pause then step once to avoid double-stepping
    const wasRunning = running;
    if(wasRunning) stopSim();
    singleFrame();
    if(wasRunning) startSim();
});

// clicking on canvas toggles pause/resume
canvas.addEventListener('click', () => {
    toggleSim();
});

// initialize canvas & start animation
resizeCanvas();
updateCalculs();
animate();

// pause simulation automatically if tab hidden to save CPU
document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        stopSim();
    } else {
        // do not auto-resume — keep user in control (optional: uncomment to auto-resume)
        // startSim();
    }
});
</script>

</body>
</html>
