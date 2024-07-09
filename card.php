<?php
include "functions.php";
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\Frame;

// Initialize Dompdf
$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);

$requestId = $_GET['request'];
$card = fetchCardRequest($con, $requestId);
if ($card && mysqli_num_rows($card) > 0) {
    $card = mysqli_fetch_assoc($card);
    $imagePath = realpath('attachments/images/users/' . $card['profile_pic']);
    $html = "<div class='card'>
                <div class='card-header'>
                    <h5>Card Details</h5>
                </div>
                <div class='card-body'>
                    <p><strong>First Name:</strong> {$card['fname']}</p>
                    <p><strong>Middle Name:</strong> {$card['mname']}</p>
                    <p><strong>Last Name:</strong> {$card['lname']}</p>
                    <p><strong>Date of Birth:</strong> {$card['dob']}</p>
                    <p><strong>Place of Birth:</strong> {$card['pob']}</p>
                    <p><strong>Village:</strong> {$card['village']}</p>
                    <p><strong>Agency Name:</strong> {$card['name']}</p>
                    <p><strong>Date Issued:</strong> {$card['date_issued']}</p>
                    <img src='attachments/images/users/{$imagePath}' alt='Profile Picture' class='img-fluid'>
                </div>
            </div>";
    $dompdf->loadHtml($html);
}
else {
    echo "Card Not Found";
}

// (Optional) Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to browser
$dompdf->stream("{$card['fname']} card.pdf", ["Attachment" => false]);