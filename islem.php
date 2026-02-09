<?php
include 'baglan.php';
session_start();

// --- 1. ARIZA KAYDETME (CREATE) ---
if(isset($_POST['ariza_kaydet'])){
    $oda_no = htmlspecialchars($_POST['oda_no']); 
    $kategori_id = $_POST['kategori_id'];
    $aciklama = htmlspecialchars($_POST['aciklama']);
    $foto_ad = "yok.jpg"; // Varsayılan değer

    // Fotoğraf Yükleme İşlemi
    if(isset($_FILES['ariza_foto']) && $_FILES['ariza_foto']['error'] == 0){
        $izin_verilenler = ['jpg', 'jpeg', 'png'];
        $dosya_adi = $_FILES['ariza_foto']['name'];
        $uzanti = strtolower(pathinfo($dosya_adi, PATHINFO_EXTENSION));
        
        // Uzantı ve 3MB Boyut Kontrolü
        if(in_array($uzanti, $izin_verilenler) && $_FILES['ariza_foto']['size'] < 3000000){ 
            $yeni_ad = uniqid() . "." . $uzanti; // Dosya adını benzersiz yap (Hoca Madde 5)
            
            // yuklemeler klasörü yoksa oluştur
            if (!is_dir('yuklemeler')) { mkdir('yuklemeler', 0777, true); }

            if(move_uploaded_file($_FILES['ariza_foto']['tmp_name'], "yuklemeler/" . $yeni_ad)){
                $foto_ad = $yeni_ad;
            }
        }
    }

    // Sorguya 'fotograf' sütununu ekledik
    $sql = "INSERT INTO arizalar (oda_no, kategori_id, aciklama, durum, fotograf) VALUES (?, ?, ?, 'Beklemede', ?)";
    $sorgu = mysqli_prepare($baglanti, $sql);
    
    // 4 parametre: s (string), i (int), s (string), s (string)
    mysqli_stmt_bind_param($sorgu, "siss", $oda_no, $kategori_id, $aciklama, $foto_ad);
    
    if(mysqli_stmt_execute($sorgu)){
        header("Location: index.php?mesaj=basarili");
        exit();
    } else {
        die("Hata: " . mysqli_error($baglanti));
    }
}

// --- 2. ARIZA TAMAMLA (UPDATE) ---
if(isset($_GET['bitir'])){
    $id = $_GET['bitir'];
    $stmt = mysqli_prepare($baglanti, "UPDATE arizalar SET durum = 'Tamamlandı' WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if(mysqli_stmt_execute($stmt)){
        header("Location: talepler.php?durum=guncellendi");
        exit();
    }
}
?>