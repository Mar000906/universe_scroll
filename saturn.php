<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saturn - Universe Scroll</title>
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
            background:#cc5200;
            color:white;
        }

        .planet-image {
            margin: 30px 0;
        }

        .planet-image img {
            width: 320px;
            height: 320px;
            border-radius: 50%;
            box-shadow:0 0 40px  rgba(147, 32, 224, 0.8);
            animation: rotate 80s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <h1>Saturn has a diameter of 116,460 kilometers 💫</h1>

    <div class="planet-image">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Saturn_during_Equinox.jpg" alt="Saturn">
    </div>

    <p>
        Saturn is the sixth planet from the Sun and the second largest in our solar system, 
        famous for its magnificent ring system. These rings are primarily composed of ice particles, 
        rocky debris, and dust, stretching thousands of kilometers wide but often less than a kilometer thick. 
        Saturn is a gas giant made mostly of hydrogen and helium, with a small rocky core. 
        Despite its massive size, Saturn has an extremely low density — it would float in water 
        if there were a body of water large enough! Saturn has at least 83 known moons, 
        the largest being Titan, which has a thick atmosphere and liquid methane lakes. 
        The beauty of Saturn and its rings has made it one of the most iconic planets 
        in astronomy and space exploration.
    </p>

    <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

</body>
</html>
