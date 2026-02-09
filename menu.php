<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}
?>

<div class="sidebar">
    <div class="user-info">
        👤 <?php echo $_SESSION['admin_ad']; ?><br>
        🕒 Giriş: <?php echo $_SESSION['giris_saati']; ?>
    </div>
    
    <h2 style="text-align: center; color: white; margin-top: 10px;">YURT PANEL</h2>
    <hr style="border: 0.1px solid #34495e; margin: 0 15px 15px 15px;">
    
    <a href="index.php">📊 Dashboard</a>
    <a href="talepler.php">📋 Arıza Kayıtları</a> 
    <a href="ariza_bildir.php">📝 Arıza Bildir</a> 
    <a href="#">🛠 Teknisyenler</a> 
    <a href="#">⚙ Ayarlar</a> 

    <div class="logout-container">
        <hr style="border: 0.1px solid #34495e; margin: 15px;">
        <a href="cikis.php" style="color: #e74c3c;">🚪 Çıkış Yap</a>
    </div>
</div>

<style>
.sidebar { 
    width: 250px; 
    height: 100vh; 
    background: #2c3e50; 
    color: white; 
    padding: 0;
    position: fixed; 
    left: 0; 
    top: 0; 
    display: flex;
    flex-direction: column;
    z-index: 1000;
}

.user-info {
    padding: 15px;
    background: #34495e;
    text-align: center;
    font-size: 12px;
}

.sidebar a { 
    padding: 12px 20px; 
    color: #bdc3c7; 
    text-decoration: none; 
    transition: 0.3s;
}

.sidebar a:hover { background: #1a252f; color: white; }

.logout-container {
    margin-top: auto; 
    padding-bottom: 10px;
}
</style>