<h2>Riwayat Penerimaan Buku</h2>

<table border="1" id="tabelPenerimaan" cellpadding="10">
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Order</th>
        <th>Buku</th>
        <th>Jumlah Diterima</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $.ajax({
        url: "<?= base_url('penerimaan/loaddata') ?>",
        type: "POST",
        dataType: "json",
        success: function(response) {
            var rows = '';
            for (var i = 0; i < response.length; i++) {
                var p = response[i];
                rows += '<tr>';
                rows += '<td>' + p.tanggal_terima + '</td>';
                rows += '<td>' + p.supplier + ' (#' + p.order_id + ')</td>';
                rows += '<td>' + p.judul + '</td>';
                rows += '<td>' + p.jumlah_diterima + '</td>';
                rows += '</tr>';
            }
            $('#tabelPenerimaan tbody').html(rows);
        }
    });
});
</script>
