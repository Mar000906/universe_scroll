<?php
// trailer.php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Universe Scroll - Trailer</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <style>
    :root{
      --accent1: #A64DFF;
      --accent2: #FF6EC7;
      --accent3: #C47FFF;
      --glass: rgba(255,255,255,0.08);
      --text-muted: #cfd8e3;
    }

    *{box-sizing:border-box}
    body{
      margin:0;
      font-family: "Poppins", Arial, sans-serif;
      color:#ffffff;
      background: radial-gradient(1200px 600px at 10% 10%, #120024 0%, #000010 40%, #000000 100%);
      min-height:100vh;
      overflow-x:hidden;
    }

    body::before{
      content:"";
      position:fixed;
      inset:0;
      background: url('https://www.transparenttextures.com/patterns/stardust.png') repeat;
      opacity:0.25;
      z-index:0;
      animation: starMove 80s linear infinite;
    }
    @keyframes starMove {
      from { transform: translateY(0) }
      to   { transform: translateY(-800px) }
    }

    /* Menu style dashboard violet */
    nav {
      background: rgba(0,0,0,0.85);
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 18px;
      border-bottom: 2px solid var(--accent1);
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
      background: linear-gradient(to right, var(--accent1), var(--accent2));
      left: 0;
      bottom: -5px;
      transition: width 0.3s ease;
    }
    nav a:hover::after {
      width: 100%;
    }

    .btn-nav {
      background: linear-gradient(to right,var(--accent1),var(--accent2));
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
      background: linear-gradient(to right,var(--accent2),var(--accent1));
      box-shadow:0 0 25px rgba(255,110,199,0.7);
    }

    .hero{
      text-align:center;
      padding:90px 20px 50px;
      position:relative;
      z-index:1;
    }
    .hero h1{
      margin:0;
      font-size:52px;
      background: linear-gradient(90deg,var(--accent1),var(--accent2),var(--accent3));
      -webkit-background-clip:text;
      -webkit-text-fill-color:transparent;
    }
    .hero p{
      color:var(--text-muted);
      margin:16px 0 28px;
      font-size:17px;
    }

    .play-primary{
      display:inline-flex;
      align-items:center;
      gap:12px;
      background: linear-gradient(90deg,var(--accent1),var(--accent2));
      color:#000;
      padding:16px 30px;
      border-radius:40px;
      border:none;
      font-weight:800;
      cursor:pointer;
      font-size:16px;
      box-shadow: 0 0 25px rgba(80,120,255,0.3);
      transition: transform .2s, box-shadow .2s;
    }
    .play-primary:hover{ transform:scale(1.07); box-shadow:0 0 40px rgba(80,120,255,0.55); }
    .play-icon{
      width:0; height:0;
      border-left: 18px solid #000;
      border-top: 11px solid transparent;
      border-bottom: 11px solid transparent;
    }

    .trailers-wrap{
      max-width:1300px;
      margin:50px auto 100px;
      padding:0 18px;
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap:30px;
      z-index:1;
      position:relative;
    }

    .card{
      background: var(--glass);
      border-radius:14px;
      padding:14px;
      overflow:hidden;
      transition: transform .3s ease, box-shadow .3s ease;
      cursor:pointer;
      border: 1px solid rgba(255,255,255,0.06);
    }
    .card:hover{
      transform: translateY(-12px) scale(1.04);
      box-shadow: 0 20px 50px rgba(16,24,48,0.6);
    }

    .poster{
      width:100%;
      aspect-ratio:16/9;
      border-radius:10px;
      background-size:cover;
      background-position:center;
      box-shadow: inset 0 0 50px rgba(0,0,0,0.3);
      transition: transform .35s ease;
    }
    .card:hover .poster{ transform: scale(1.05); }

    .card .meta{ padding:12px 6px 0; text-align:left; }
    .card h3{ margin:0 0 6px; font-size:17px; color:#fff; }
    .card p{ margin:0; font-size:13px; color:var(--text-muted); line-height:1.4; }

    .tag{
      display:inline-block;
      padding:6px 12px;
      border-radius:999px;
      font-size:12px;
      color:#000;
      background:linear-gradient(90deg,var(--accent1),var(--accent2));
      font-weight:700;
      margin-top:10px;
    }

    .modal{
      position:fixed;
      inset:0;
      display:none;
      align-items:center;
      justify-content:center;
      background: rgba(0,0,0,0.8);
      z-index:120;
      padding:32px;
    }
    .modal.open{ display:flex; }

    .player {
      width:min(1100px, 95%);
      aspect-ratio:16/9;
      background:#000;
      border-radius:14px;
      overflow:hidden;
      box-shadow: 0 30px 80px rgba(0,0,0,0.9);
      position:relative;
    }
    .close-btn{
      position:absolute;
      top:12px; right:12px;
      background: rgba(255,255,255,0.08);
      border:none;
      color:#fff;
      padding:8px 14px;
      border-radius:8px;
      cursor:pointer;
      font-size:16px;
      z-index:20;
    }
    .player iframe, .player video{
      width:100%; height:100%; border:0; display:block;
    }

    .note{ text-align:center; color:var(--text-muted); margin-bottom:70px; font-size:14px; }

    @media (max-width:900px){
      .trailers-wrap{ grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width:600px){
      .hero h1{ font-size:38px; }
      .play-primary{ width:90%; justify-content:center; }
      .trailers-wrap{ grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  <nav>
    <div class="nav-left">
      <a href="dashboard.php">Planets</a>
      <a href="trailer.php">Trailer</a>
      <a href="simulation.php">Simulation</a>
      <a href="graph.php">Blog</a>
     
    </div>
    <div class="nav-right">
      <button class="btn-nav" onclick="window.location.href='entre.php'">Login</button>
      <button class="btn-nav" onclick="window.location.href='logout.php'">Logout</button>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <h1>✨ Official Trailers ✨</h1>
    <p>Discover the magic of Universe Scroll through epic trailers and teasers. Choose one below or play the main trailer.</p>

    <button class="play-primary" id="open-main" data-type="youtube" data-id="2Vv-BfVoq4g">
      <span class="play-icon"></span>
      <span>Play Main Trailer</span>
    </button>
  </section>

  <!-- GALLERY -->
  <main class="trailers-wrap">
    <!-- Card 1 -->
    <article class="card" data-type="youtube" data-id="ScMzIvxBSi4">
      <div class="poster" style="background-image:url('https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?q=80&w=1200');"></div>
      <div class="meta">
        <span class="tag">YouTube</span>
        <h3>Cosmic Journey</h3>
        <p>Travel through galaxies in this breathtaking teaser.</p>
      </div>
    </article>

    <!-- Card 2 -->
    <article class="card" data-type="file" data-src="videos/trailer.mp4">
      <div class="poster" style="background-image:url('https://images.unsplash.com/photo-1444703686981-a3abbc4d4fe3?q=80&w=1200');"></div>
      <div class="meta">
        <span class="tag">Local</span>
        <h3>Local Demo</h3>
        <p>Preview a local MP4 trailer stored in your project.</p>
      </div>
    </article>

    <!-- Card 3 -->
    <article class="card" data-type="youtube" data-id="YE7VzlLtp-4">
      <div class="poster" style="background-image:url('https://images.unsplash.com/photo-1483729558449-99ef09a8c325?q=80&w=1200');"></div>
      <div class="meta">
        <span class="tag">YouTube</span>
        <h3>Voyage to Mars</h3>
        <p>Prepare your journey to the red planet with this trailer.</p>
      </div>
    </article>

    
    <!-- Card 4 -->
    <article class="card" data-type="youtube" data-id="1w8Z0UOXVaY">
      <div class="poster" style="background-image:url('https://images.unsplash.com/photo-1454789548928-9efd52dc4031?q=80&w=1200');"></div>
      <div class="meta">
        <span class="tag">YouTube</span>
        <h3>Saturn’s Rings</h3>
        <p>A closer look at the beauty and mystery of Saturn’s rings.</p>
      </div>
    </article>


    <!-- Card 6 -->
    <article class="card" data-type="youtube" data-id="XHTrLYShBRQ">
      <div class="poster" style="background-image:url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200');"></div>
      <div class="meta">
        <span class="tag">YouTube</span>
        <h3>The Blue Planet</h3>
        <p>Dive into Earth’s beauty from space in this amazing trailer.</p>
      </div>
    </article>

    <!-- Card 7 -->
    <article class="card" data-type="youtube" data-id="H8X6xZD3y4k">
      <div class="poster" style="background-image:url('https://images.unsplash.com/photo-1462331940025-496dfbfc7564?q=80&w=1200');"></div>
      <div class="meta">
        <span class="tag">YouTube</span>
        <h3>Beyond the Stars</h3>
        <p>Experience deep space exploration like never before.</p>
      </div>
    </article>
  </main>

  <p class="note">Tip: Replace YouTube IDs (<code>data-id</code>) and images with your real trailers and posters.</p>

  <!-- MODAL -->
  <div class="modal" id="modal">
    <div class="player" id="player">
      <button class="close-btn" id="closeModal">✕</button>
    </div>
  </div>

  <script>
    const modal = document.getElementById('modal');
    const player = document.getElementById('player');
    const closeBtn = document.getElementById('closeModal');

    function openPlayer({type, id, src}) {
      while (player.firstChild) player.removeChild(player.firstChild);
      player.appendChild(closeBtn);

      if (type === 'youtube') {
        const iframe = document.createElement('iframe');
        iframe.src = `https://www.youtube.com/embed/${id}?autoplay=1&rel=0&showinfo=0`;
        iframe.allow = "autoplay; encrypted-media; fullscreen";
        iframe.setAttribute('allowfullscreen', '');
        player.appendChild(iframe);
      } else if (type === 'file') {
        const video = document.createElement('video');
        video.src = src;
        video.controls = true;
        video.autoplay = true;
        player.appendChild(video);
      }

      modal.classList.add('open');
      document.body.style.overflow = 'hidden';
    }

    function closePlayer() {
      modal.classList.remove('open');
      while (player.firstChild) player.removeChild(player.firstChild);
      player.appendChild(closeBtn);
      document.body.style.overflow = '';
    }

    document.getElementById('open-main').addEventListener('click', function(){
      const type = this.getAttribute('data-type');
      const id = this.getAttribute('data-id');
      if(type === 'youtube') openPlayer({type:'youtube', id});
    });

    document.querySelectorAll('.card').forEach(card => {
      const type = card.getAttribute('data-type');
      const id = card.getAttribute('data-id');
      const src = card.getAttribute('data-src');
      card.addEventListener('click', ()=> {
        if(type === 'youtube') openPlayer({type:'youtube', id});
        else if(type === 'file') openPlayer({type:'file', src});
      });
    });

    closeBtn.addEventListener('click', closePlayer);
    modal.addEventListener('click', (e) => { if(e.target === modal) closePlayer(); });
    document.addEventListener('keydown', (e) => { if(e.key === 'Escape') closePlayer(); });
  </script>
</body>
</html>



