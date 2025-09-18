<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mercury - Universe Scroll</title>
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
            animation: rotate 40s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <h1>Mercury is 4,879 kilometers in diameter ☿️</h1>

    <div class="planet-image">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/4a/Mercury_in_true_color.jpg" alt="Mercury">
    </div>

    <p>
        Mercury is the smallest planet in our solar system and the closest one to the Sun. 
        It has a diameter of just 4,879 kilometers, making it slightly larger than Earth’s Moon. 
        Because of its proximity to the Sun, Mercury experiences extreme temperatures, 
        ranging from scorching heat during the day to freezing cold at night. The planet 
        has a very thin atmosphere, meaning it cannot retain heat, which causes these dramatic shifts. 
        Mercury’s surface is covered with craters, much like our Moon, due to countless impacts 
        from asteroids and comets. Despite being so close to the Sun, Mercury is not the hottest 
        planet in the solar system — Venus holds that title because of its thick atmosphere 
        that traps heat. Studying Mercury helps scientists understand the formation and evolution 
        of rocky planets.
    </p>

    <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

</body>
</html>
