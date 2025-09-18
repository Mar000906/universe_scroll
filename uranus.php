<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Uranus - Universe Scroll</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: radial-gradient(circle at top, #0a0f2e, #000);
            color: white;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 50px;
            margin-bottom: 20px;
             background: linear-gradient(to right,#8A2BE2,#8A2BE2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            color: #ddd;
            max-width: 900px;
            margin: 0 auto 30px auto;
        }

        .btn-back {
             background: linear-gradient(to right,#8A2BE2,#8A2BE2);
            color:black;
            padding:12px 25px;
            font-size:16px;
            font-weight:bold;
            border:none;
            cursor:pointer;
            border-radius:25px;
            transition:0.3s;
            text-decoration: none;
        }
        .btn-back:hover {
            transform:scale(1.05);
            background:#0055cc;
            color:white;
        }

        .planet-image {
            margin: 30px 0;
        }

        .planet-image img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            box-shadow:0 0 40px  rgba(147, 32, 224, 0.8);
            animation: rotate 50s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <h1>Uranus has a diameter of 50,724 kilometers 🌀</h1>

    <div class="planet-image">
        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3d/Uranus2.jpg" alt="Uranus">
    </div>

    <p>
        Uranus is the seventh planet from the Sun and is classified as an ice giant. 
        It is unique among the planets because it rotates on its side, with its axis tilted 
        by about 98 degrees. This unusual tilt gives Uranus extreme seasonal variations, 
        with each pole experiencing 42 years of continuous sunlight followed by 42 years of darkness. 
        Uranus is composed mostly of hydrogen and helium, with a large proportion of water, methane, 
        and ammonia ices. The methane in its atmosphere gives the planet its distinct pale blue color. 
        It also has faint rings and 27 known moons. Despite being less studied than other gas giants, 
        Uranus remains an intriguing world for astronomers seeking to understand the diversity of planets 
        in our solar system.
    </p>

    <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

</body>
</html>
