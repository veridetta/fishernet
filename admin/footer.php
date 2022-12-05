</main>
</div>

<?php
// include '.../'

if (isset($_POST['pilih_grafik'])) {
    $tahun = $_POST["tahun"];

    $laba_januari  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 1 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_januari->fetch_assoc()) {
        $januari = $data['total_harga'];
    }

    $laba_feb  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 2 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_feb->fetch_assoc()) {
        $feb = $data['total_harga'];
    }

    $laba_maret  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 3 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_maret->fetch_assoc()) {
        $maret = $data['total_harga'];
    }

    $laba_april  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 4 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_april->fetch_assoc()) {
        $april = $data['total_harga'];
    }

    $laba_mei  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 5 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_mei->fetch_assoc()) {
        $mei = $data['total_harga'];
    }

    $laba_juni = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 6 AND YEAR(tanggal) = $tahun");
    while ($data2 = $laba_juni->fetch_assoc()) {
        $juni = $data2['total_harga'];
    }

    $laba_juli  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 7 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_juli->fetch_assoc()) {
        $juli = $data['total_harga'];
    }

    $laba_agustus  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 8 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_agustus->fetch_assoc()) {
        $agustus = $data['total_harga'];
    }

    $laba_september  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 9 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_september->fetch_assoc()) {
        $september = $data['total_harga'];
    }
    $laba_oktober  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 10 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_oktober->fetch_assoc()) {
        $oktober = $data['total_harga'];
    }
    $laba_november  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 11 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_november->fetch_assoc()) {
        $november = $data['total_harga'];
    }
    $laba_desember  = $koneksi->query("SELECT SUM(total_harga) as total_harga FROM penjualan WHERE MONTH(tanggal) = 12 AND YEAR(tanggal) = $tahun");
    while ($data = $laba_desember->fetch_assoc()) {
        $desember = $data['total_harga'];
    }

?>
    <script type="text/javascript">
        var ctx = document.getElementById("barchart").getContext("2d");
        var data = {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: "Penjualan",
                data: [<?php echo $januari ?>, <?php echo $feb ?>, <?php echo $maret ?>, <?php echo $april ?>, <?php echo $mei ?>, <?php echo $juni ?>, <?php echo $juli ?>, <?php echo $agustus ?>, <?php echo $september ?>, <?php echo $oktober ?>, <?php echo $november ?>, <?php echo $desember ?>],
                backgroundColor: [
                    '#FF3333',
                    '#3356FF',
                    '#33FFDD',
                    '#FF7B33',
                    '#BBFF33',
                    '#487EF9',
                    '#047C5A',
                    '#141DFDi',
                    '#2B7C04',
                    '#C0C426',
                    '#E23AFB',
                    '#6B48F9'
                ]
            }]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {

                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[0].data[tooltipItem.index];
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            value = value.join('.');
                            return "Rp." + value;
                        }
                    }
                },
                legend: {
                    display: false
                },
                barValueSpacing: 20,
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    yAxes: [{

                        ticks: {
                            min: 0,
                            callback: function(value, index, values) {
                                return addCommas(value); //! panggil function addComas tadi disini
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        }
                    }]
                }
            }
        });

        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            let rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return "Rp." + x1 + x2;
        }
    </script>
<?php

}

?>



</body>

</html>