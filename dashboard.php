<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - PHP Login System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 text-white">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-8 shadow-2xl text-center space-y-4">
        <h2 class="text-3xl font-bold">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
        <p class="text-gray-300 text-sm">You have successfully logged into your PHP system dashboard.</p>
        <a href="logout.php" class="block w-full py-3 bg-red-500/20 border border-red-500/40 hover:bg-red-500/30 text-red-300 font-semibold rounded-xl transition-all">Sign Out</a>
    </div>
</body>
</html>