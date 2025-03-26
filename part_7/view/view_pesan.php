<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh View Pesan</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Pesan</th>
            <th>Status</th>
        </tr>
        <?php
        foreach($data_ke_view as $d) {
        echo "<tr>";
            echo "<td>".$d['nama_pengirim']."</td>";
            echo "<td>".$d['isi_pesan']."</td>";
            echo "<td>".$d['status']."</td>";
        echo "</tr>";
        }
        ?>
        
    </table>
</body>
</html>