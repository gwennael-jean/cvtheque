<?php

namespace App\PartageResponse;

use App\Entity\Cv;
use App\Service\PartageResponseInterface;
use Dompdf\Css\Stylesheet;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfPartageResponse implements PartageResponseInterface {

    private $templating;

    private $appPath;

    public function __construct(\Twig_Environment $templating, $app_path)
    {
        $this->templating = $templating;
        $this->appPath = $app_path;
    }

    public function render(Cv $cv)
    {
        $dompdf = new Dompdf($this->getOptions($cv));

        $html = $this->templating->render($cv->getTheme()->getTemplatePathVisualisation(), [
            'cv' => $cv
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setCss($this->getStylesheet($dompdf, $cv));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }

    private function getOptions(Cv $cv) {
        $pdfOptions = new Options();
        $pdfOptions
            ->setDefaultFont('Roboto')
            ->setIsHtml5ParserEnabled(true)
            ->setChroot($this->appPath . '/public')
            ->setFontDir($pdfOptions->getChroot() . '/' . $cv->getTheme()->getPublicPath() . '/css/fonts')
            ->setIsRemoteEnabled(true);
        return $pdfOptions;
    }

    private function getStylesheet(Dompdf $dompdf, Cv $cv) {
        $pdfStylesheet = new Stylesheet($dompdf);
        $pdfStylesheet->load_css_file($cv->getTheme()->getCssPathGlobal());
        $pdfStylesheet->load_css_file($cv->getTheme()->getCssPathVisualisation());
        return $pdfStylesheet;
    }
}