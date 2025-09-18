<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Venus - Universe Scroll</title>
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

    <h1>Venus is 12,104 kilometers in diameter 🌍</h1>

    <div class="planet-image">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e5/Venus-real_color.jpg" alt="Venus">
    </div>

    <p>
        Venus is the second planet from the Sun and is Earth’s closest planetary neighbor. 
        It’s one of the four inner, terrestrial planets and is often called Earth’s twin because 
        it’s similar in size and density. Venus has a thick, toxic atmosphere made up mainly of 
        carbon dioxide and clouds of sulfuric acid that trap heat, making it the hottest planet 
        in our solar system. Surface temperatures reach up to 465°C (869°F) – hot enough to melt lead. 
        Unlike most other planets, Venus rotates in the opposite direction, causing the Sun to rise in the west 
        and set in the east. Its surface is marked by volcanoes, mountains, and vast plains, making it a 
        fascinating but hostile world.
    </p>

    <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

</body>
</html>
