<h2>Data Buku</h2>

<button type="button" id="btnTambah">+ Tambah Buku</button>

<br><br>
<table border="1" id="tabelBuku" cellpadding="10">
    <thead>
    <tr>
        <th>Judul</th>
        <th>Lokasi Rak</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
  
    </tbody>
</table>

<div id="formModal" style="display:none; border:1px solid #333; padding:15px; margin-top:15px; max-width:300px;">
    <h3 id="formTitle">Tambah Buku</h3>
    <input type="hidden" id="buku_id" value="">
    <label>Judul</label><br>
    <input type="text" id="judul" style="width:100%;"><br><br>
    <label>Lokasi Rak</label><br>
    <input type="text" id="lokasi_rak" style="width:100%;"><br><br>
    <button type="button" id="btnSimpan">Simpan</button>
    <button type="button" id="btnBatal">Batal</button>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(document).ready(function() {

    var mode = 'tambah'; 

    function loaddata() {
        $.ajax({
            url: "<?= base_url('buku/loaddata') ?>",
            type: "POST",
            dataType: "json",
            success: function(response) {
                var rows = '';
                for (var i = 0; i < response.length; i++) {
                    var b = response[i];
                    rows += '<tr>';
                    rows += '<td>' + b.judul + '</td>';
                    rows += '<td>' + b.lokasi_rak + '</td>';
                    rows += '<td>' + b.stok + '</td>';
                    rows += '<td>';
                    rows += '<button class="btnEdit" data-id="' + b.id + '">Edit</button> ';
                    rows += '<button class="btnHapus" data-id="' + b.id + '">Hapus</button>';
                    rows += '</td>';
                    rows += '</tr>';
                }
                $('#tabelBuku tbody').html(rows);
            }
        });
    }
    loaddata();

    $('#btnTambah').on('click', function() {
        mode = 'tambah';
        $('#formTitle').text('Tambah Buku');
        $('#buku_id').val('');
        $('#judul').val('');
        $('#lokasi_rak').val('');
        $('#formModal').show();
    });

    $('#btnBatal').on('click', function() {
        $('#formModal').hide();
    });

    $('#tabelBuku').on('click', '.btnEdit', function() {
        var id = $(this).data('id');
        mode = 'edit';

        $.ajax({
            url: "<?= base_url('buku/get_buku') ?>",
            type: "POST",
            dataType: "json",
            data: { id: id },
            success: function(response) {
                $('#formTitle').text('Edit Buku');
                $('#buku_id').val(response.id);
                $('#judul').val(response.judul);
                $('#lokasi_rak').val(response.lokasi_rak);
                $('#formModal').show();
            }
        });
    });

    $('#tabelBuku').on('click', '.btnHapus', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Yakin hapus buku ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('buku/hapus_ajax') ?>",
                    type: "POST",
                    dataType: "json",
                    data: { id: id },
                    success: function(response) {
                        Swal.fire('Terhapus!', response.message, 'success');
                        loaddata();
                    }
                });
            }
        });
    });

    $('#btnSimpan').on('click', function() {
        var url = (mode === 'tambah')
            ? "<?= base_url('buku/simpan_ajax') ?>"
            : "<?= base_url('buku/update_ajax') ?>";

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: {
                id: $('#buku_id').val(),
                judul: $('#judul').val(),
                lokasi_rak: $('#lokasi_rak').val()
            },
            success: function(response) {
                if (response.error === false) {
                    Swal.fire('Berhasil', response.message, 'success');
                    $('#formModal').hide();
                    loaddata();
                } else {
                    Swal.fire('Gagal', response.message, 'error');
                }
            }
        });
    });

});
</script>
