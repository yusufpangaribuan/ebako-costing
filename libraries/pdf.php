<?php

class CI_Pdf {

    function pdf_create($html, $filename, $stream = TRUE) {
        require_once("dompdf2/dompdf_config.inc.php");
        spl_autoload_register("DOMPDF_autoload");

        $dompdf = new DOMPDF();
        ini_set("memory_limit", "256M");
        $dompdf->load_html($html);
        $dompdf->set_paper("a4", "potrait");
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array('Attachment' => 0));
        } else {
            $CI = & get_instance();
            $CI->load->helper("file");
            write_file($filename, $dompdf->output());
        }
    }

}
