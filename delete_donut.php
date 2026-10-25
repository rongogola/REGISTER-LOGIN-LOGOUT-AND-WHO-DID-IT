<?php
session_start();
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
}
require_once 'db_config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// Fetch the donut details first so we can show its name on the warning screen
$stmt = $pdo->prepare("SELECT * FROM donuts WHERE donut_id = ?");
$stmt->execute([$id]);
$donut = $stmt->fetch();

if (!$donut) {
    header("Location: index.php");
    exit;
}

// If the user confirms the deletion by clicking the red button
if (isset($_POST['confirm_delete'])) {
    $stmt = $pdo->prepare("DELETE FROM donuts WHERE donut_id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Donut Record</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #fffcf9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-container { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 30px rgba(109, 76, 65, 0.04); width: 360px; border: 1px solid #f5ede6; text-align: center; }
        .warning-icon { font-size: 48px; margin-bottom: 15px; display: inline-block; }
        h3 { margin-top: 0; color: #6d4c41; font-size: 22px; font-weight: 600; margin-bottom: 10px; }
        .target-item { background: #fdf6f0; color: #a1785c; padding: 12px; border-radius: 8px; font-weight: bold; font-size: 16px; margin-bottom: 20px; border: 1px dashed #ebdcd0; }
        .desc { color: #c62828; font-size: 13.5px; margin-bottom: 25px; line-height: 1.5; background: #ffebee; padding: 12px; border-radius: 8px; font-weight: 500; }
        .btn-group { display: flex; gap: 10px; }
        .btn { flex: 1; padding: 12px; border: none; font-weight: bold; border-radius: 20px; font-size: 14px; cursor: pointer; text-align: center; text-decoration: none; transition: all 0.2s; }
        .btn-danger { background: #ffebee; color: #c62828; box-shadow: 0 4px 10px rgba(198, 40, 40, 0.1); border: 1px solid rgba(198, 40, 40, 0.2); }
        .btn-danger:hover { background: #c62828; color: white; transform: translateY(-1px); }
        .btn-cancel { background: #f5f5f5; color: #666; }
        .btn-cancel:hover { background: #e0e0e0; }
    </style>
</head>
<body>

    <div class="form-container">
        <div class="warning-icon">⚠️</div>
        <h3>Delete Donut?</h3>
        
        <div class="target-item">
            🍩 <?php echo htmlspecialchars($donut['donut_name']); ?>
        </div>
        
        <div class="desc">
            <strong>Warning:</strong> Deleting this parent item will automatically wipe out all linked ingredients from the shop catalog!
        </div>
        
        <form method="POST">
            <div class="btn-group">
                <a href="index.php" class="btn btn-cancel">No, Keep It</a>
                <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete Record</button>
            </div>
        </form>
    </div>

</body>
</html>