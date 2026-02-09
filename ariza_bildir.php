<?php 
include 'baglan.php'; 
include 'menu.php'; // Session kontrolü ve ortak menü
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Arıza Bildirimi</title>
    <style>
        .content { margin-left: 270px; padding: 40px; }
        .form-box { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); max-width: 500px; }
        label { font-weight: bold; color: #2c3e50; display: block; margin-top: 15px; }
        input, select, textarea { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        input[type="file"] { border: 1px dashed #3498db; background: #f0f7fd; padding: 10px; cursor: pointer; }
        button { background: #3498db; color: white; padding: 15px; border: none; border-radius: 6px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; margin-top: 20px; transition: 0.3s; }
        button:hover { background: #2980b9; }
        h2 { color: #2c3e50; }
        .uyari { font-size: 12px; color: #7f8c8d; margin-top: -5px; }
    </style>
</head>
<body>

<div class="content">
    <h2>Yeni Arıza Kaydı Oluştur</h2>
    <p>Lütfen arıza detaylarını eksiksiz doldurunuz.</p>
    
    <div class="form-box">
        <form action="islem.php" method="POST" enctype="multipart/form-data">
            
            <label>Oda Numaranız:</label>
            <input type="text" name="oda_no" placeholder="Örn: 204" required>

            <label>Arıza Kategorisi:</label>
            <select name="kategori_id" required>
                <?php 
                $sorgu = mysqli_query($baglanti, "SELECT * FROM kategoriler");
                while($kat = mysqli_fetch_assoc($sorgu)){
                    echo "<option value='".$kat['id']."'>".$kat['kategori_ad']."</option>";
                }
                ?>
            </select>

            <label>Sorun Nedir? (Kısaca açıklayın):</label>
            <textarea name="aciklama" rows="4" required placeholder="Örn: Çalışma masasının çekmecesi kapanmıyor..."></textarea>

            <label>Arıza Fotoğrafı (Opsiyonel):</label>
            <input type="file" name="ariza_foto" accept="image/*">
            <p class="uyari">* Sadece JPG, PNG formatları ve maks. 3MB.</p>

            <button type="submit" name="ariza_kaydet">Talebi Gönder</button>
        </form>
    </div>
</div>

</body>
</html>