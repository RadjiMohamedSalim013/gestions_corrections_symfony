<?php
namespace App\Service;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

class ExportService
{
    # Exporter en CSV
    public function exportCsv(array $data, string $filename)
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        if (count($data) > 0) {
            // En-têtes : les clés du premier tableau
            fputcsv($output, array_keys(reset($data)));

            // Données
            foreach ($data as $row) {
                fputcsv($output, $row);
            }
        }

        fclose($output);
        exit;
    }

    // Exporter en Excel
    public function exportExcel(array $data, string $filename)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if (count($data) > 0) {
            // En-têtes
            $headers = array_keys(reset($data));
            $col = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($col.'1', $header);
                $col++;
            }

            // Données
            $rowNum = 2;
            foreach ($data as $row) {
                $col = 'A';
                foreach ($row as $cell) {
                    $sheet->setCellValue($col.$rowNum, $cell);
                    $col++;
                }
                $rowNum++;
            }
        }

        // Préparation pour téléchargement
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Exporter en PDF simple
     * @param array $data Tableau de tableaux associatifs
     * @param string $filename Nom du fichier (ex: data.pdf)
     */
    
}
