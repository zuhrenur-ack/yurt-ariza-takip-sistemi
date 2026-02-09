<?php 
include 'baglan.php'; 
include 'menu.php'; 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Arıza Yönetimi</title>
    <style>
        /* Sadece bu sayfaya özel tablo stilleri */
        .content { margin-left: 270px; padding: 30px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #34495e; color: white; }
        .btn-tamam { background: #27ae60; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 13px; font-weight: bold; }
        .btn-tamam:hover { background: #219150; }
        .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .beklemede { background: #ffeaa7; color: #d35400; }
        .tamamlandi { background: #55efc4; color: #00b894; }
        h2 { color: #2c3e50; margin-bottom: 20px; }

        /* talepler.php style bölümüne ekle */
table { 
    width: 100%; 
    border-spacing: 0; /* Boşlukları kaldırır */
    border-radius: 8px;
    overflow: hidden;
}

th { background-color: #34495e; padding: 18px; font-size: 14px; }
td { padding: 15px; border-bottom: 1px solid #f1f1f1; }
    </style>
</head>
<body>

<div class="content">
    <h2>Arıza Taleplerini Yönet</h2>
    <table>
        <thead>
            <tr>
                <th>Oda No</th>
                <th>Kategori</th>
                <th>Açıklama</th>
                <th>Kayıt Tarihi</th>
                <th>Durum</th>
                <th>İşlem</th>
            </tr>
        </thead>
        
            <tbody>
            <?php 
            $sorgu = mysqli_query($baglanti, "SELECT arizalar.*, kategoriler.kategori_ad 
                                              FROM arizalar 
                                              LEFT JOIN kategoriler ON arizalar.kategori_id = kategoriler.id 
                                              ORDER BY tarih DESC");
            
            while($row = mysqli_fetch_assoc($sorgu)): 
                $durumClass = ($row['durum'] == 'Beklemede') ? 'beklemede' : 'tamamlandi';
            ?>
            <td>
    <?php if($row['fotograf'] != 'yok.jpg'): ?>
        <a href="yuklemeler/<?php echo $row['fotograf']; ?>" target="_blank">🖼️ Gör</a>
    <?php else: ?>
        Yok
    <?php endif; ?>
</td>
            <tr>
                <td><b><?php echo $row['oda_no']; ?></b></td>
                <td><?php echo $row['kategori_ad']; ?></td>
                <td><?php echo $row['aciklama']; ?></td>
                <td><?php echo date('d.m.Y H:i', strtotime($row['tarih'])); ?></td>
                <td><span class="status-badge <?php echo $durumClass; ?>"><?php echo $row['durum']; ?></span></td>
                <td>
                    <?php if($row['durum'] == 'Beklemede'): ?>
                        <a href="islem.php?bitir=<?php echo $row['id']; ?>" class="btn-tamam">Tamamla</a>
                    <?php else: ?>
                        <span style="color: #27ae60; font-weight: bold;">✅ Bitti</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        </table>
</div> </body>
</html>