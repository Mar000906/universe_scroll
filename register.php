<?php
// register.php
include 'config.php';
session_start();

// Message d'inscription
$register_msg = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si email existe déjà
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $register_msg = "⚠️ Email déjà utilisé.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username,email,password,created_at) VALUES (?,?,?,NOW())");
        $stmt->bind_param("sss", $username,$email,$hashed);
        if ($stmt->execute()) {
            $register_msg = "✅ Compte créé avec succès ! Vous pouvez vous connecter.";
        } else {
            $register_msg = "❌ Erreur lors de la création du compte.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Register - Universe Scroll</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
<style>
:root {
    --violet-dark: #2E004F;
    --violet-mid: #4B0082;
    --violet-light: #A64DFF;
    --glass: rgba(255,255,255,0.08);
    --text-muted: #cfd8e3;
}

body, html {
    margin:0; padding:0; font-family:'Poppins', sans-serif;
    height:100%; background: radial-gradient(circle at top,#120024,#000010);
    color:white;
}

.container {display:flex; height:100vh; justify-content:center; align-items:center;}

/* Formulaire central */
.register-box {
    background: linear-gradient(to bottom right, var(--violet-dark), var(--violet-mid));
    padding:40px;
    border-radius:20px;
    box-shadow: 0 0 50px rgba(0,0,0,0.7);
    width:100%; max-width:400px;
    text-align:center;
}

.register-box h2 {
    font-size:32px;
    font-weight:800;
    color: var(--violet-light);
    text-shadow: 0 0 15px var(--violet-light);
    margin-bottom:25px;
}

.register-box form {
    display:flex; flex-direction:column;
}

.register-box input {
    padding:12px;
    margin-bottom:15px;
    border-radius:10px;
    border:none;
    background: rgba(255,255,255,0.1);
    color:white;
    font-size:14px;
    transition:0.3s;
}

.register-box input:focus {
    background: rgba(255,255,255,0.2);
    outline:none;
}

.register-box button {
    padding:12px;
    border:none;
    border-radius:10px;
    font-weight:bold;
    font-size:16px;
    cursor:pointer;
    color:white;
    background: var(--violet-light);
    transition:0.3s;
    box-shadow: 0 4px 15px rgba(166,77,255,0.5);
}

.register-box button:hover {
    background: var(--violet-mid);
    box-shadow: 0 6px 20px rgba(166,77,255,0.7);
    transform:translateY(-2px);
}

.message {
    margin-bottom:15px;
    padding:10px;
    border-radius:8px;
    font-weight:bold;
}

.success {background: rgba(0,255,128,0.15); color:#0f0;}
.error {background: rgba(255,0,64,0.15); color:#f00;}

a {color: var(--violet-light); text-decoration:none; font-weight:600;}
a:hover {text-decoration:underline;}
</style>
</head>
<body>
<div class="container">
    <div class="register-box">
        <h2>Créer un compte</h2>
        <?php if($register_msg!="") { 
            $class = strpos($register_msg,'✅')!==false ? 'success' : 'error';
            echo "<div class='message $class'>$register_msg</div>";
        } ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="register">S'inscrire</button>
        </form>
        <p>Vous avez déjà un compte ? <a href="entre.php">Connectez-vous</a></p>
    </div>
</div>
</body>
</html>
