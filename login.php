<?php
require_once 'db.php';
session_start();

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - PHP Login System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 text-white">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-8 shadow-2xl">
        <h2 class="text-2xl font-bold mb-6 text-center">Sign In</h2>
        <?php if(isset($_GET['success'])): ?>
            <div class="mb-4 p-3 bg-green-500/20 border border-green-500/40 text-green-300 rounded-lg text-sm text-center"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>
        <?php if($message): ?>
            <div class="mb-4 p-3 bg-red-500/20 border border-red-500/40 text-red-300 rounded-lg text-sm text-center"><?= $message ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs uppercase tracking-wider text-gray-400 mb-1">Email</label>
                <input type="email" name="email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-wider text-gray-400 mb-1">Password</label>
                <input type="password" name="password" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500">
            </div>
            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 font-semibold rounded-xl shadow-lg transition-all">Login</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-400">Don't have an account? <a href="register.php" class="text-indigo-400 hover:underline">Register here</a></p>
    </div>
</body>
</html>