<h2 id="judulHalaman">Detail Order</h2>
<p id="infoOrder"></p>

<h3>Daftar Buku dalam Order</h3>
<table border="1" id="tabelDetail" cellpadding="10">
    <thead>
    <tr>
        <th>Judul</th>
        <th>Pesan</th>
        <th>Diterima</th>
        <th>Sisa</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<h3>Tambah Buku ke Order</h3>
<select id="buku_id"></select>
<input type="number" id="quantity" placeholder="Jumlah" min="1">
<button type="button" id="btnTambahDetail">Tambah</button>

<br><br>
<a href="<?= base_url('penerimaan/tambah/'.$order_id) ?>">
    <button type="button">+ Input Penerimaan Buku untuk Order Ini</button>
</a>

<br><br>
<a href="<?= base_url('order') ?>">Kembali ke Daftar Order</a>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(document).ready(function() {
    var order_id = <?= $order_id ?>;

    function loadInfo() {
        $.ajax({
            url: "<?= base_url('order/get_order_info') ?>",
            type: "POST",
            dataType: "json",
            data: { order_id: order_id },
            success: function(response) {
                var o = response.order;
                $('#judulHalaman').text('Detail Order #' + o.id + ' - ' + o.supplier);
                $('#infoOrder').text('Tanggal: ' + o.tanggal_order + ' | Status: ' + o.status);

                var options = '<option value="">-- Pilih Buku --</option>';
                for (var i = 0; i < response.buku.length; i++) {
                    options += '<option value="' + response.buku[i].id + '">' + response.buku[i].judul + '</option>';
                }
                $('#buku_id').html(options);
            }
        });
    }

    function loaddataDetail() {
        $.ajax({
            url: "<?= base_url('order/loaddata_detail') ?>",
            type: "POST",
            dataType: "json",
            data: { order_id: order_id },
            success: function(response) {
                var rows = '';
                for (var i = 0; i < response.length; i++) {
                    var d = response[i];
                    rows += '<tr>';
                    rows += '<td>' + d.judul + '</td>';
                    rows += '<td>' + d.quantity + '</td>';
                    rows += '<td>' + d.total_diterima + '</td>';
                    rows += '<td>' + d.sisa + '</td>';
                    rows += '<td><button class="btnHapusDetail" data-id="' + d.id + '">Hapus</button></td>';
                    rows += '</tr>';
                }
                $('#tabelDetail tbody').html(rows);
            }
        });
    }

    loadInfo();
    loaddataDetail();

    $('#btnTambahDetail').on('click', function() {
        var buku_id = $('#buku_id').val();
        var quantity = $('#quantity').val();

        if (!buku_id || !quantity) {
            Swal.fire('Gagal', 'Pilih buku dan isi jumlah dulu', 'error');
            return;
        }

        $.ajax({
            url: "<?= base_url('order/simpan_detail_ajax') ?>",
            type: "POST",
            dataType: "json",
            data: {
                order_id: order_id,
                buku_id: buku_id,
                quantity: quantity
            },
            success: function(response) {
                Swal.fire('Berhasil', response.message, 'success');
                $('#quantity').val('');
                loaddataDetail();
            }
        });
    });

    $('#tabelDetail').on('click', '.btnHapusDetail', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Hapus item ini dari order?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('order/hapus_detail_ajax') ?>",
                    type: "POST",
                    dataType: "json",
                    data: { id: id },
                    success: function(response) {
                        Swal.fire('Terhapus', response.message, 'success');
                        loaddataDetail();
                    }
                });
            }
        });
    });
});
</script>
