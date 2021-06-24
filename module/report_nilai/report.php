<?php
    ob_start();
    require_once '../../inc/functions.php';
    require_once '../../vendor/autoload.php';

    $where = '';
    if ($_GET['id_kelas'] != 'semua') {
        $where = 'WHERE id_kelas='.$_GET['id_kelas'];
    }

    $siswa = $db->get_results("SELECT siswa.*, kelas.kelas, IFNULL(nilai.nilai, 0) AS nilai FROM siswa
	LEFT JOIN kelas ON kelas.id=siswa.id_kelas
	LEFT JOIN pengguna ON pengguna.username=siswa.nis
	LEFT JOIN nilai ON nilai.id_siswa=pengguna.id
    $where ORDER BY siswa.id_kelas, siswa.nis");

    $report_title = ($_GET['id_kelas'] == 'semua') ? 'Laporan Nilai Siswa' : 'Laporan Nilai Siswa Kelas '.$siswa[0]->kelas;

    $html = '<h2 style="text-align:center;">'.$report_title.'</h2>';

    $html .= '<p style="text-align:center;">Tanggal cetak: '.date('d M Y H:i:s').'</p><table class="table" border="1" cellpadding="6" cellspacing="0" style="margin: 0 auto;"><thead>
        <tr>
            <th class="border-top-0">No</th>
            <th class="border-top-0">NIS</th>
            <th class="border-top-0">Nama Siswa</th>
            <th class="border-top-0">Tempat, Tanggal Lahir</th>
            <th class="border-top-0">Jenis Kelamin</th>
            <th class="border-top-0">Kelas</th>
            <th class="border-top-0">Nilai</th>
        </tr>
    </thead><tbody>';

    $html .= $query;
    if (count($siswa) < 1) {
        $html .= '<tr><td colspan="8" style="text-align:center;">Tidak ada data</td></tr>';
    }else{
        foreach ($siswa as $sw) {
            $birth  = $sw->tempat_lahir.', '. date("d M Y", strtotime($sw->tgl_lahir));
            $html .= '<tr>
                        <td>'.++$i.'</td>
                        <td>'.$sw->nis.'</td>
                        <td>'.$sw->nama_siswa.'</td>
                        <td>'.$birth.'</td>
                        <td>'.$sw->jenis_kelamin.'</td>
                        <td>'.$sw->kelas.'</td>
                        <td>'.$sw->nilai.'</td>
                    </tr>';
        }
    }

    $html .= '</tbody>
    </table>';


    // Create Raport PDF File
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
    $mpdf->WriteHTML($html);
    $filename = $report_title.'.pdf';
    $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
    ob_end_flush();
    ob_clean();
 ?>