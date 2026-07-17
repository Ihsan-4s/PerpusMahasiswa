<h2 id="judulHalaman">Penerimaan Buku</h2>
<p id="statusInfo"></p>

<table>
    <tr>
        <td>Pilih Buku</td>
        <td><select id="detail_order_id"></select></td>
    </tr>
    <tr>
        <td>Jumlah Diterima</td>
        <td><input type="number" id="jumlah_diterima" min="1"></td>
    </tr>
    <tr>
        <td>Tanggal Terima</td>
        <td><input type="date" id="tanggal_terima"></td>
    </tr>
</table>
<br>
<button type="button" id="btnSimpan">Simpan</button>
<a href="<?= base_url('order/detail/'.$order_id) ?>">Kembali</a>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(document).ready(function() {
    var order_id = <?= $order_id ?>;
    var orderSelesai = false;

    function loadForm() {
        $.ajax({
            url: "<?= base_url('penerimaan/get_form_info') ?>",
            type: "POST",
            dataType: "json",
            data: { order_id: order_id },
            success: function(response) {
                var o = response.order;
                $('#judulHalaman').text('Penerimaan Buku - Order #' + o.id + ' (' + o.supplier + ')');

                orderSelesai = (o.status === 'selesai');

                if (orderSelesai) {
                    $('#statusInfo').html('<b style="color:green">Order ini sudah selesai, semua buku telah diterima.</b>');
                    $('#btnSimpan').prop('disabled', true);
                } else {
                    $('#statusInfo').text('Status order saat ini: ' + o.status);
                }

                var options = '<option value="">-- Pilih Buku dalam Order --</option>';
                for (var i = 0; i < response.detail.length; i++) {
                    var d = response.detail[i];
                    var disabled = (d.sisa <= 0) ? 'disabled' : '';
                    options += '<option value="' + d.id + '" ' + disabled + '>' +
                        d.judul + ' (sisa: ' + d.sisa + ' dari ' + d.quantity + ')</option>';
                }
                $('#detail_order_id').html(options);
            }
        });
    }
    loadForm();

    $('#btnSimpan').on('click', function() {
        if (orderSelesai) return;

        $.ajax({
            url: "<?= base_url('penerimaan/simpan_ajax') ?>",
            type: "POST",
            dataType: "json",
            data: {
                detail_order_id: $('#detail_order_id').val(),
                jumlah_diterima: $('#jumlah_diterima').val(),
                tanggal_terima: $('#tanggal_terima').val()
            },
            success: function(response) {
                if (response.error === false) {
                    Swal.fire('Berhasil', response.message, 'success').then(() => {
                        loadForm(); 
                        $('#jumlah_diterima').val('');
                    });
                } else {
                    Swal.fire('Gagal', response.message, 'error');
                }
            }
        });
    });
});
</script>
