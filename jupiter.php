<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jupiter - Universe Scroll</title>
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
            width: 320px;
            height: 320px;
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

    <h1>Jupiter is 139,820 kilometers in diameter 🪐</h1>

    <div class="planet-image">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Jupiter.jpg" alt="Jupiter">
    </div>

    <p>
        Jupiter is the largest planet in our solar system, often referred to as a "gas giant." 
        It is more than 11 times wider than Earth and is made mostly of hydrogen and helium. 
        Jupiter is famous for its colorful bands of clouds and the Great Red Spot, a giant storm 
        that has raged for centuries. The planet has a very strong magnetic field and dozens of moons, 
        the four largest being Io, Europa, Ganymede, and Callisto. Some of these moons are considered 
        prime candidates in the search for extraterrestrial life, especially Europa, which may harbor 
        a vast ocean beneath its icy surface. Jupiter plays a crucial role in the solar system by 
        deflecting comets and asteroids with its immense gravity, helping to protect the inner planets.
    </p>

    <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

</body>
</html>
