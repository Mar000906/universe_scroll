<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mars - Universe Scroll</title>
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
            color: rgba(255, 255, 255, 0.8);
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
            background:#ff9900;
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
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <h1>Mars is 6,779 kilometers in diameter 🔴</h1>

    <div class="planet-image">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/02/OSIRIS_Mars_true_color.jpg" alt="Mars">
    </div>

    <p>
        Mars, often called the "Red Planet," is the fourth planet from the Sun. Its reddish appearance 
        comes from iron oxide, or rust, on its surface. Mars is about half the size of Earth and has a thin 
        atmosphere composed mostly of carbon dioxide. Temperatures are much colder than on Earth, averaging 
        around −60°C (−80°F). Mars features the largest volcano in the solar system, Olympus Mons, and a 
        canyon system called Valles Marineris that stretches for thousands of kilometers. Scientists are 
        particularly interested in Mars because evidence suggests it once had liquid water, and it may 
        have conditions suitable for past microbial life. Today, numerous missions are exploring Mars to 
        uncover its secrets and prepare for possible future human exploration.
    </p>

    <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

</body>
</html>
