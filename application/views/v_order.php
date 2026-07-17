<h2>Daftar Order Pembelian</h2>

<button type="button" id="btnTambah">+ Tambah Order</button>

<br><br>
<table border="1" id="tabelOrder" cellpadding="10">
    <thead>
    <tr>
        <th>ID</th>
        <th>Supplier</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<div id="formModal" style="display:none; border:1px solid #333; padding:15px; margin-top:15px; max-width:300px;">
    <h3>Tambah Order</h3>
    <label>Supplier</label><br>
    <input type="text" id="supplier" style="width:100%;"><br><br>
    <label>Tanggal</label><br>
    <input type="date" id="tanggal" style="width:100%;"><br><br>
    <button type="button" id="btnSimpan">Simpan</button>
    <button type="button" id="btnBatal">Batal</button>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(document).ready(function() {

    function loaddata() {
        $.ajax({
            url: "<?= base_url('order/loaddata') ?>",
            type: "POST",
            dataType: "json",
            success: function(response) {
                var rows = '';
                for (var i = 0; i < response.length; i++) {
                    var o = response[i];
                    rows += '<tr>';
                    rows += '<td>' + o.id + '</td>';
                    rows += '<td>' + o.supplier + '</td>';
                    rows += '<td>' + o.tanggal_order + '</td>';
                    rows += '<td>' + o.status + '</td>';
                    rows += '<td><a href="<?= base_url('order/detail/') ?>' + o.id + '"><button type="button">Detail</button></a></td>';
                    rows += '</tr>';
                }
                $('#tabelOrder tbody').html(rows);
            }
        });
    }
    loaddata();

    $('#btnTambah').on('click', function() {
        $('#supplier').val('');
        $('#tanggal').val('');
        $('#formModal').show();
    });

    $('#btnBatal').on('click', function() {
        $('#formModal').hide();
    });

    $('#btnSimpan').on('click', function() {
		$.ajax({
			url: "<?= base_url('order/simpan_ajax') ?>",
			type: "POST",
			dataType: "json",
			data: {
				supplier: $('#supplier').val(),
				tanggal: $('#tanggal').val()
			},
			success: function(response) {
				$('#formModal').hide();
				Swal.fire('Berhasil', response.message, 'success').then(function() {
					window.location.href = "<?= base_url('order/detail/') ?>" + response.order_id;
				});
			}
		});
	});
});
</script>
