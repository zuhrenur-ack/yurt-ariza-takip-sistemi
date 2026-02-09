<?php
session_start();
include 'baglan.php';

if(isset($_POST['giris'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Prepared Statement (Güvenli Veri İşleme - Hocanın 6. maddesi)
    $stmt = mysqli_prepare($baglanti, "SELECT id, ad_soyad FROM kullanicilar WHERE kullanici_ad = ? AND sifre = ?");
    mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
    mysqli_stmt_execute($stmt);
    $sonuc = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($sonuc)){
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_ad'] = $row['ad_soyad'];
        $_SESSION['giris_saati'] = date('H:i:s');
        header("Location: index.php");
    } else {
        $hata = "Hatalı kullanıcı adı veya şifre!";
    }
}
?>
<div style="width:300px; margin:100px auto; padding:20px; border:1px solid #ddd; border-radius:10px; font-family:sans-serif;">
    <h2 style="text-align:center;">Panel Girişi</h2>
    <?php if(isset($hata)) echo "<p style='color:red'>$hata</p>"; ?>
    <form method="POST">
        Kullanıcı: <input type="text" name="user" style="width:100%; padding:10px; margin:10px 0;" required>
        Şifre: <input type="password" name="pass" style="width:100%; padding:10px; margin:10px 0;" required>
        <button name="giris" style="width:100%; padding:10px; background:#2c3e50; color:white; border:none; border-radius:5px;">Giriş Yap</button>
    </form>
</div>