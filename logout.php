<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logging Out... - Donut Shop</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #fffcf9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 30px rgba(109, 76, 65, 0.05); width: 320px; text-align: center; border: 1px solid #f5ede6; }
        h2 { color: #6d4c41; margin-bottom: 10px; font-weight: 600; }
        p { font-size: 15px; color: #8a7a72; margin: 0 0 25px 0; }
        
        .spinner {
            width: 45px;
            height: 45px;
            border: 5px solid #fdfbf9;
            border-top: 5px solid #ffd3e2; 
            border-radius: 50%;
            margin: 0 auto;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <script>
        setTimeout(function() {
            window.location.href = "login.php";
        }, 2000);
    </script>
</head>
<body>
    <div class="box">
        <h2>See you soon! 🍩</h2>
        <p>Logging you out safely from our shop! 🍩</p>
        <div class="spinner"></div>
    </div>
</body>
</html>