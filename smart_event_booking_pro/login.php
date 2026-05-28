<?php 
session_start(); require_once 'config/db.php'; 
if(isset($_SESSION['user_id']))
    {header('Location: dashboard.php');exit;} 
$error=''; if($_SERVER['REQUEST_METHOD']==='POST'){ $email=trim($_POST['email']??''); 
$password=$_POST['password']??''; 
$stmt=$pdo->prepare('SELECT * FROM users WHERE email=? LIMIT 1'); 
$stmt->execute([$email]); $user=$stmt->fetch(PDO::FETCH_ASSOC); 
if($user && password_verify($password,$user['password'])){ $_SESSION['user_id']=$user['id']; 
$_SESSION['name']=$user['name']; 
$_SESSION['role']=$user['role']; 
header('Location: dashboard.php'); exit; } 
else {$error='Invalid email or password';}
} 
?><!DOCTYPE html><html><head><meta charset="UTF-8">
<title>Login</title><link rel="stylesheet" href="assets/style.css"></head><body>
    <div class="login-wrap">
        <form class="login-box" method="post">
            <h1>Smart Event Booking</h1>
            <p class="muted">Professional event booking system with responsible AI integration.</p>
            <?php 
            if($error): ?><div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <label>Email</label><input name="email" type="email" required value="admin@example.com">
            <label>Password</label><input name="password" type="password" required value="Admin123">
            <button class="btn btn-primary" style="width:100%;margin-top:18px">Login</button>
            <p class="muted">Admin: admin@example.com / Admin123<br>User: user@example.com / User123</p>
            <a href="register.php">Create a standard user account</a>
        </form>
    </div>
    </body>
    </html>