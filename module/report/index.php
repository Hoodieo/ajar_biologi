<div class="page-heading">
    <h3>Laporan</h3>
</div>
<div class="alert-container"></div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div id="content-data" class="card-body">

                    <form action="actions?action=view_report" method="POST">
                        <div class="row">
                            <div class="form-group col-md-6" id="select-laporan">
                                <label for="laporan">Laporan</label>
                                <select name="laporan" id="laporan" class="form-select">
                                    <option value="siswa">Siswa</option>
                                    <option value="nilai">Nilai Siswa</option>
                                    <option value="soal">Soal</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" id="select-kelas">
                                <label for="kelas">Kelas</label>
                                <select name="id_kelas" id="kelas" class="form-select">
                                    <?= getKelasOptions() ?>
                                    <option value="semua">Semua kelas</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" id="select-tema" style="display: none;">
                                <label for="tema">Tema</label>
                                <select name="id_tema" id="tema" class="form-select">
                                    <?= getTemaOptions() ?>
                                    <option value="semua">Semua Tema</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

				</div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const laporanWrapper = document.getElementById('select-laporan');
    const kelasWrapper = document.getElementById('select-kelas');
    const temaWrapper = document.getElementById('select-tema');

    const laporan = document.getElementById('laporan');
    const kelas = document.getElementById('kelas');
    const tema = document.getElementById('tema');

    laporan.addEventListener('click', function(e){
        var jenisLaporan = e.target.value;

        if (jenisLaporan == 'soal') {
            kelasWrapper.style.display = 'none';
            temaWrapper.style.display = 'block';
        } else {
            kelasWrapper.style.display = 'block';
            temaWrapper.style.display = 'none';
        }
    })

});
</script>