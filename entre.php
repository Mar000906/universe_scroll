<?php
// entre.php
session_start();

// Connexion à la base de données avec mysqli
$host = "localhost";
$db = "universe_db";
$user = "root"; // ton utilisateur
$pass = "Mysql"; // ton mot de passe
$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Messages
$login_msg = "";
$register_msg = "";

// Connexion
if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Préparer la requête
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    if($stmt){
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if($res && $res->num_rows === 1){
            $row = $res->fetch_assoc();
            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: index.php"); // Redirection vers dashboard
                exit();
            } else {
                $login_msg = "❌ Mot de passe incorrect.";
            }
        } else {
            $login_msg = "❌ Utilisateur non trouvé.";
        }
    } else {
        $login_msg = "❌ Erreur SQL : ".$conn->error;
    }
}

// Création de compte
if(isset($_POST['register'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email_reg']);
    $password = trim($_POST['password_reg']);
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if($stmt){
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            $register_msg = "⚠️ Email déjà utilisé.";
        } else {
            $stmt2 = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
            if($stmt2){
                $stmt2->bind_param("sss", $username, $email, $hashed);
                if($stmt2->execute()){
                    $register_msg = "✅ Compte créé avec succès ! Vous pouvez vous connecter.";
                } else {
                    $register_msg = "❌ Erreur lors de la création du compte.";
                }
            } else {
                $register_msg = "❌ Erreur SQL : ".$conn->error;
            }
        }
    } else {
        $register_msg = "❌ Erreur SQL : ".$conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Universe Scroll - Entre</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
<style>
body, html {
    margin:0; padding:0; height:100%; font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #1a1a1a, #2c003e); color:white;
}
.container {display:flex; height:100vh;}
.login-side, .login-right {flex:1; display:flex; justify-content:center; align-items:center; padding:40px; position:relative;}
/* LEFT */
.login-side {
    background-color:#121212; flex-direction:column; border-right:2px solid #2c003e; box-shadow:0 0 20px rgba(255,215,0,0.2);
}
.login-side h2 {
    margin-bottom:25px; font-size:36px; font-weight:800;
    background: linear-gradient(90deg, #c396e7ff, #7125c7ff);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent;
    text-shadow:0 0 10px rgba(178, 110, 209, 0.96);
}
.login-side form {display:flex; flex-direction:column; width:100%; max-width:320px;}
.login-side input {
    margin-bottom:15px; padding:12px; border:1px solid #444; border-radius:8px;
    background:#2c2c2c; color:white; outline:none; transition:0.3s;
}
.login-side input:focus {border-color:#FFD700; box-shadow:0 0 8px rgba(255,215,0,0.6);}
.login-side button {
    background: linear-gradient(90deg,#FFD700,#FFA500); color:#121212;
    padding:12px; border:none; border-radius:8px; font-weight:bold; cursor:pointer;
    font-size:15px; box-shadow:0 4px 10px rgba(255,165,0,0.4); transition:0.3s;
}
.login-side button:hover {background:linear-gradient(90deg,#FFA500,#FFD700); transform:translateY(-2px);}
.login-side .message {margin-bottom:10px; font-weight:bold; color:#ff6666; text-align:center;}
/* RIGHT */
.login-right {
    background: url('https://cdn.futura-sciences.com/sources/images/actu/plus-grande-planete-systeme-solaire-jupiter.jpg') no-repeat center center/cover;
}
.login-right .overlay {
    background-color: rgba(0,0,0,0.7); padding:40px; border-radius:10px; text-align:center; max-width:350px;
}
.login-right h2 {
    background: linear-gradient(90deg, #d79cfdff, #dd86e0ff);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    margin-bottom:15px; font-size:28px; font-weight:700;
}
.login-right p {margin-bottom:20px; font-size:14px;}
.btn-signup {
    background: linear-gradient(90deg,rgba(124, 15, 128, 1));
    padding:12px 20px; color:# rgba(15, 10, 14, 0.53); text-decoration:none; border-radius:8px; font-weight:bold;
    display:inline-block; box-shadow:0 4px 10px rgba(175, 116, 177, 1); transition:0.3s;

   
}
.btn-signup:hover {background: linear-gradient(90deg,rgba(181, 158, 182, 1)); transform:translateY(-2px); box-shadow:0 6px 15px rgba(255,165,0,0.6);}
</style>
</head>
<body>
<div class="container">
    <!-- Left part: Login -->
    <div class="login-side">
        <h2>Login</h2>
        <?php if($login_msg!="") echo "<div class='message'>$login_msg</div>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <a href="dashboard.php" class="btn-signup">Login</a>
        </form>
    </div>

    <!-- Right part: Registration -->
    <div class="login-right">
        <div class="overlay">
            <h2>Welcome to our Planets</h2>
            <p>If you don't have an account yet, sign up now!</p>
            <a href="register.php" class="btn-signup">Sign Up</a>
        </div>
    </div>
</div>
</body>
</html>

