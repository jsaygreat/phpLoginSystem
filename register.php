<?php
require_once 'db.php';
session_start();

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!empty($name) && !empty($email) && !empty($_POST['password'])) {
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $password]);
            header("Location: login.php?success=Registered successfully");
            exit();
        } catch (PDOException $e) {
            $message = "Email already exists or database error.";
        }
    } else {
        $message = "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - PHP Login System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 text-white">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-8 shadow-2xl">
        <h2 class="text-2xl font-bold mb-6 text-center">Create Account</h2>
        <?php if($message): ?>
            <div class="mb-4 p-3 bg-red-500/20 border border-red-500/40 text-red-300 rounded-lg text-sm text-center"><?= $message ?></div>
        <?php endif; ?>
        <form action="register.php" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs uppercase tracking-wider text-gray-400 mb-1">Full Name</label>
                <input type="text" name="name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-wider text-gray-400 mb-1">Email</label>
                <input type="email" name="email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs uppercase tracking-wider text-gray-400 mb-1">Password</label>
                <input type="password" name="password" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500">
            </div>
            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 font-semibold rounded-xl shadow-lg transition-all">Register</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-400">Already have an account? <a href="login.php" class="text-indigo-400 hover:underline">Login here</a></p>
    </div>
</body>
</html>