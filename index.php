<?php 
include 'baglan.php'; 
include 'menu.php'; 

// Verileri çek
$toplam = mysqli_fetch_assoc(mysqli_query($baglanti, "SELECT COUNT(*) as t FROM arizalar"))['t'];
$bekleyen = mysqli_fetch_assoc(mysqli_query($baglanti, "SELECT COUNT(*) as b FROM arizalar WHERE durum='Beklemede'"))['b'];
$mobilya = mysqli_fetch_assoc(mysqli_query($baglanti, "SELECT COUNT(*) as m FROM arizalar WHERE kategori_id=3"))['m'];

$elektrik = mysqli_fetch_assoc(mysqli_query($baglanti, "SELECT COUNT(*) as s FROM arizalar WHERE kategori_id=1"))['s'];
$su = mysqli_fetch_assoc(mysqli_query($baglanti, "SELECT COUNT(*) as s FROM arizalar WHERE kategori_id=2"))['s'];

$sorgu_liste = mysqli_query($baglanti, "SELECT arizalar.*, kategoriler.kategori_ad FROM arizalar JOIN kategoriler ON arizalar.kategori_id = kategoriler.id ORDER BY arizalar.tarih DESC LIMIT 5");
?>

<div style="margin-left: 250px; padding: 20px; background: #f4f7f6; min-height: 100vh;">
    <h2 style="margin-top: 0; color: #2c3e50;">📊 Yönetici Dashboard</h2>
    
    <div style="display: flex; gap: 15px; margin-bottom: 20px;">
        <div style="flex:1; background:#3498db; color:white; padding:20px; border-radius:10px;">
            <small>Toplam Arıza</small>
            <h2 style="margin:5px 0;"><?php echo $toplam; ?></h2>
        </div>
        <div style="flex:1; background:#f1c40f; color:white; padding:20px; border-radius:10px;">
            <small>Bekleyen İşler</small>
            <h2 style="margin:5px 0;"><?php echo $bekleyen; ?></h2>
        </div>
        <div style="flex:1; background:#a35d1c; color:white; padding:20px; border-radius:10px;">
            <small>Mobilya Arızaları</small>
            <h2 style="margin:5px 0;"><?php echo $mobilya; ?></h2>
        </div>
    </div>

    <div style="display: flex; gap: 20px; align-items: flex-start;">
        <div style="flex: 2; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h4 style="margin-top:0;">Son Gelen Talepler</h4>
            <table style="width:100%; border-collapse: collapse;">
                <tr style="border-bottom: 2px solid #eee; text-align: left;">
                    <th style="padding:10px;">Oda</th>
                    <th>Kategori</th>
                    <th>Durum</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($sorgu_liste)) { ?>
                <tr style="border-bottom: 1px solid #f9f9f9;">
                    <td style="padding:10px;"><b><?php echo $row['oda_no']; ?></b></td>
                    <td><?php echo $row['kategori_ad']; ?></td>
                    <td><span style="padding:4px 8px; border-radius:5px; font-size:11px; background:<?php echo ($row['durum']=='Beklemede'?'#ffeaa7':'#55efc4');?>"><?php echo $row['durum']; ?></span></td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <div style="flex: 1; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
            <h4 style="margin-top:0;">Kategori Dağılımı</h4>
            <canvas id="myChart" style="max-height: 200px;"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('myChart'), {
        type: 'pie',
        data: {
            labels: ['Elektrik', 'Su', 'Mobilya'],
            datasets: [{
                data: [<?php echo (int)$elektrik; ?>, <?php echo (int)$su; ?>, <?php echo (int)$mobilya; ?>],
                backgroundColor: ['#3498db', '#2ecc71', '#a35d1c']
            }]
        }
    });
</script>