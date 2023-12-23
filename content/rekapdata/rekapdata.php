<script>
	function paySPP(idSPP, bulan, idUser) {
		const yakin = confirm('Apakah anda yakin ingin membayar? aksi ini tidak bisa dibatalkan');
		if(yakin && idSPP && bulan && idUser) {
			fetch(`/backend/action/payment.php?id=${idUser}&idSPP=${idSPP}&bulan=${bulan}`);
			alert('Pembayaran berhasil!');
			location.reload();
		}
	}
</script>
<?php
	if($data['sppCount'] < 36 || $data['sppCount'] > 36) {
?>
	<script>
		alert('Server Error, klik OK untuk memperbaikinya');
		fetch('/backend/action/generateSPPData.php?id=<?= $data['user']['id'] ?>');
		location.reload();
	</script>
<?php
	}
	$count = 0;
	$monthNumber = 0;
	$atYear = 1;
	$type = $_GET['type'];
	$tahun = 0;

	if(!isset($type)) {
		header('Location: /index.php');
	}
?>
<h2 class="rekap-data-header">Data SPP yang <?= $type === 'belum_dibayar' ? 'Belum Dibayar' : 'Sudah Dibayar' ?></h2>
<?php
	while($spp = mysqli_fetch_array($data['spp'])) {
		if($spp['status'] !== $type) {
			continue;
		}

		$count++;
		switch($spp['bulan']) {
			case 'januari':
				$monthNumber = 1;
				break;
			case 'februari':
				$monthNumber = 2;
				break;
			case 'maret':
				$monthNumber = 3;
				break;
			case 'april':
				$monthNumber = 4;
				break;
			case 'mei':
				$monthNumber = 5;
				break;
			case 'juni':
				$monthNumber = 6;
				break;
			case 'juli':
				$monthNumber = 7;
				break;
			case 'agustus':
				$monthNumber = 8;
				break;
			case 'september':
				$monthNumber = 9;
				break;
			case 'oktober':
				$monthNumber = 10;
				break;
			case 'november':
				$monthNumber = 11;
				break;
			case 'desember':
				$monthNumber = 12;
				break;
		}

		$year = $spp['tahun'];
		if($monthNumber < 7) {
			$year = $spp['tahun'] + 1;
		}

		$dueDate = "$year-$monthNumber-$spp[tenggat_bayar]";
		$dueTimestamp = strtotime($dueDate);
		$currentTimestamp = time();
		$differenceInSeconds = $dueTimestamp - $currentTimestamp;
		$daysLeft = floor($differenceInSeconds / (60 * 60 * 24));
		$invoiceMessage = $daysLeft < 0 ? "Terlambat ".$daysLeft * -1 ." hari" : "$daysLeft hari lagi";

		if($tahun === 0 || $tahun < $spp['tahun']) {
			if($count > 1) {
				$atYear++;
				$count = $spp['tahun'] - $tahun;
?>
			</table>
		</div>
<?php
		}
?>
<div class="rekap-container">
	<h3> Tahun ke-<?= $atYear ?> </h3>
	<table class="tabel_rekap">
    <tr>
      <td>No</td>
      <td>Bulan</td>
      <td><?= $type === 'belum_dibayar' ? 'Tenggat Bayar' : 'Tanggal Bayar' ?></td>
      <td>Aksi</td>
    </tr>
		
		<tr>
			<td><?= $count ?></td>
			<td><?= ucfirst($spp['bulan']) ?></td>
			<td><?= $type === 'belum_dibayar' ? $invoiceMessage : $spp['tanggal_bayar'] ?></td>
			<td>
				<?= $type === 'belum_dibayar' ? "<button class='payment-action' onclick='paySPP($spp[id], $monthNumber, {$data['user']['id']})'>Bayar</button>" : "" ?>
			</td>
		</tr>
		<?php
		} else {
		?>
		<tr>
			<td><?= $count ?></td>
			<td><?= ucfirst($spp['bulan']) ?></td>
			<td><?= $type === 'belum_dibayar' ? $invoiceMessage : $spp['tanggal_bayar'] ?></td>
			<td>
				<?= $type === 'belum_dibayar' ? "<button class='payment-action' onclick='paySPP($spp[id], $monthNumber, {$data['user']['id']})'>Bayar</button>" : "" ?>
			</td>
		</tr>
		<?php
		}
		?>
<?php
	$tahun = $spp['tahun'];
	}
?>
