<?php
// baglan.php
$host = "127.0.0.1";
$user = "root";
$pass = ""; 
$db   = "yurt_otomasyon";
$port = 3307; // Senin my.ini dosyasındaki port

// Hata raporlamayı geçici olarak kapatalım ki sistem beyaz sayfa yerine asıl hatayı göstersin
mysqli_report(MYSQLI_REPORT_OFF);

$baglanti = mysqli_connect($host, $user, $pass, $db, $port);

if (!$baglanti) {
    // Eğer bağlantı hala kurulamazsa hatayı ekrana dök
    die("Bağlantı başarısız: " . mysqli_connect_error() . " (Hata Kodu: " . mysqli_connect_errno() . ")");
}

mysqli_set_charset($baglanti, "utf8mb4");
?>