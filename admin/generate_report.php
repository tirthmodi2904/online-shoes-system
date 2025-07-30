<?php
include("../connection/connect.php");
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php'; // Include TCPDF library or change path accordingly
// Check if form is submitted and if start_date and end_date are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start_datetime']) && isset($_POST['end_datetime'])) {
    // Retrieve start and end dates from form
    $start_date = $_POST['start_datetime'];
    $end_date = $_POST['end_datetime'];
    // Query database to get orders within selected date range
    $sql = "SELECT users.*, users_orders.* 
        FROM users 
        INNER JOIN users_orders ON users.u_id = users_orders.u_id 
        WHERE users_orders.date BETWEEN '$start_date' AND '$end_date'";
    $query = mysqli_query($db, $sql);
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('UrbanKicks');
    $pdf->SetTitle('Orders Report');
    $pdf->SetSubject('Orders Report');
    $pdf->SetKeywords('TCPDF, PDF, Orders, Report');
    // Add a page
    $pdf->AddPage();
    // Add content to PDF
    $content = '<h1 style="text-align: center; font-family: Arial, sans-serif;">UrbanKicks Orders Summary Report</h1>';
    $content .= '<p><strong>Date Of Order Summary</strong></p>';
    $content .= '<p>Start Date: ' . $start_date . '';
    $content .= '  End Date: ' . $end_date . '</p>';
    $content .= '<table style="width: 100%; border-collapse: collapse; font-family: dejavusans, sans-serif;">';
    $content .= '<tr>
                <th style="border: 1px solid #ddd; padding: 8px;">User</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Title</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Quantity</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Shoe Size</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Total Amount</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Address</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Date-Time</th>
            </tr>';
    while ($row = mysqli_fetch_assoc($query)) {
        // Handle missing data gracefully
        $username = isset($row['username']) ? $row['username'] : 'N/A';
        $address = isset($row['address']) ? $row['address'] : 'N/A';
        $content .= '<tr>';
        $content .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $username . '</td>';
        $content .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $row['title'] . '</td>';
        $content .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $row['quantity'] . '</td>';
        $content .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $row['shoe_size'] . '</td>';
        $content .= '<td style="border: 1px solid #ddd; padding: 8px;">₹' . $row['price'] . '</td>';
        $content .= '<td style="border: 1px solid #ddd; padding: 8px;">₹' . $row['price'] * $row['quantity'] . '</td>';
        $content .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $address . '</td>';
        $content .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $row['date'] . '</td>';
        $content .= '</tr>';
    }
    $content .= '</table>';
    // Output content to PDF
    $pdf->writeHTML($content, true, false, true, false, '');
    // Output PDF as a download
    $pdf->Output('orders_report.pdf', 'D');
} else {
    // Redirect to the page where the form is displayed or display an error message
    header("Location: all_orders.php");
    exit();
}
