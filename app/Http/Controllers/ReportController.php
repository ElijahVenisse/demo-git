<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use \Mpdf\Mpdf;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $users = User::all();

        // Generate HTML content for the PDF
        $html = view('report', compact('users'))->render();

        // Initialize mPDF
        $mpdf = new Mpdf();

        // Write HTML content to the PDF
        $mpdf->WriteHTML($html);

        // Output the PDF as a download
        return $mpdf->Output('users_report.pdf', 'D');
    }
}
