<?php
    ob_start();
    require_once '../../inc/functions.php';
    require_once '../../vendor/autoload.php';

    $where = '';
    if ($_GET['id_tema'] != 'semua') {
        $where = 'WHERE id_tema='.$_GET['id_tema'];
    }

    $soal = $db->get_results("SELECT soal.*, tema.nama_tema FROM soal
    LEFT JOIN tema ON soal.id_tema=tema.id $where
    ORDER BY soal.id_tema, soal.id");

    $report_title = ($_GET['id_tema'] == 'semua') ? 'Laporan Soal' : 'Laporan Soal Tema '.$soal[0]->nama_tema;

    $html = '<h2 style="text-align:center;">'.$report_title.'</h2>';

    $html .= '<p style="text-align:center;">Tanggal cetak: '.date('d M Y H:i:s').'</p><table class="table" border="1" cellpadding="6" cellspacing="0" style="margin: 0 auto;"><thead>
        <tr>
            <th class="border-top-0">No</th>
            <th class="border-top-0">Tema</th>
            <th class="border-top-0">Pertanyaan</th>
            <th class="border-top-0">Opsi Jawaban</th>
            <th class="border-top-0">Jawaban Benar</th>
        </tr>
    </thead><tbody>';

    $html .= $query;
    if (count($soal) < 1) {
        $html .= '<tr><td colspan="8" style="text-align:center;">Tidak ada data</td></tr>';
    }else{
        foreach ($soal as $sl) {
            $html .= '<tr>
                        <td>'.++$i.'</td>
                        <td>'.$sl->nama_tema.'</td>
                        <td>'.$sl->pertanyaan.'</td>
                        <td>'.'a. '.$sl->opsi_a.'<br/> b. '.$sl->opsi_b.'<br/> c. '.$sl->opsi_c.'<br/> d. '.$sl->opsi_d.'<br/> e. '.$sl->opsi_e.'</td>
                        <td>'.explode('_',$sl->jawaban)[1].'. '.$sl->{$sl->jawaban}.'</td>
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