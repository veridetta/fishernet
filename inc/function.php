<?php

function rupiah($angka)
{

	$hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
	return $hasil_rupiah;
}

function bulan($bulan)
{
	if ($bulan == "01") {
		return 'Januari';
	} else if ($bulan == "02") {
		return 'Februari';
	} else if ($bulan == "03") {
		return 'Maret';
	} else if ($bulan == "04") {
		return 'April';
	} else if ($bulan == "05") {
		return 'Mei';
	} else if ($bulan == "06") {
		return 'Juni';
	} else if ($bulan == "07") {
		return 'Juli';
	} else if ($bulan == "08") {
		return 'Agustus';
	} else if ($bulan == "09") {
		return 'September';
	} else if ($bulan == "10") {
		return 'Oktober';
	} else if ($bulan == "11") {
		return 'November';
	} else if ($bulan == "12") {
		return 'Desember';
	}
}

function tambah($type, $name) // type advanced = text_area, upload
{
	$judul = ucwords(str_replace("_", " ", $name));
?>
	<tr>
		<td style="vertical-align: top; width: 25%">
			<h4><?= $judul ?></h4>
		</td>
		<td style="vertical-align: top;">:</td>
		<td>
			<?php if ($type == 'text_area') {
			?>
				<textarea name='<?= $name ?>' class='text-input' rows='4' placeholder='<?= $judul ?>' style="height:100%;"></textarea>
			<?php
			} else {
			?>
				<input type="<?= $type ?>" placeholder="<?= $judul ?>" class="text-input" name="<?= $name ?>">
			<?php
			}
			?>
		</td>
	</tr>
<?php
}

function edit($type, $name, $value, $colspan) // type advanced = text_area, upload
{
	$judul = ucwords(str_replace("_", " ", $name));
?>
	<tr>
		<td style="vertical-align: top;" width="20%">
			<h4><?= $judul ?></h4>
		</td>
		<td style="vertical-align: top;">:</td>

		<?php if ($type == 'text_area') {
		?>
			<td colspan="<?= $colspan ?>">
				<textarea name='<?= $name ?>' class='text-input' rows='4' style="height:100%;"><?= $value ?></textarea>
			</td>
		<?php

		} elseif ($type == 'file') {
		?>
			<td colspan="<?= $colspan ?>" width="20%" style="vertical-align: top;">
				<input type="<?= $type ?>" class="text-input" name="<?= $name ?>">
			</td>
			<td colspan="<?= $colspan ?>" width="17%" style="vertical-align: top; padding-left:10px;">
				Foto yang dipilih sebelumnya :
			</td>
			<td style="text-align: left;">
				<a href="../file-upload/<?= $value ?>"> <img src="../file-upload/<?= $value ?>" alt="Foto" width="100px"></a>
			</td>
		<?php
		} else {
		?>
			<td colspan="<?= $colspan ?>" style="vertical-align: top;">
				<input type="<?= $type ?>" value="<?= $value ?>" class="text-input" name="<?= $name ?>">
			</td>
		<?php
		}
		?>

	</tr>
<?php
}

function rst()
{
	$_SESSION['cari'] = "";
	$_SESSION['bulan'] = "";
	$_SESSION['tahun'] = "";
}
?>