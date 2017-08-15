<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function pdf_create($html, $filename, $stream = TRUE)
{

    require_once(APPPATH . 'helpers/mpdf/mpdf.php');

    $mpdf = new mPDF();
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    
    //$pdf = $this->pdf->load();
    //for chinese word soulution
    $mpdf->useAdobeCJK = true;
    $mpdf->SetAutoFont(AUTOFONT_ALL);

    $mpdf->SetAutoFont();

    $mpdf->WriteHTML($html);

    if ($stream)
    {
        $mpdf->Output($filename . '.pdf', 'D');
    }
    else
    {
        $mpdf->Output('./pdfinvoices/temp/' . $filename . '.pdf', 'F');
        
        return './pdfinvoices/temp/' . $filename . '.pdf';
    }
}

?>