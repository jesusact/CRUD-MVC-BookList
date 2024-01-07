<?php
require('./mysql_table.php');

class PDF extends PDF_MySQL_Table
{

    function Header()
    {
        $this->SetFont('Arial', '', 18);
        $this->Cell(0, 1, 'Book List', 0, 1, 'C');
        $this->Ln(20);
        parent::Header();
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

}


$link = new PDO('mysql:host=localhost;dbname=books_database;charset=utf8', 'root', '');

$pdf = new PDF();
$pdf->AddPage();

$limit = isset($_GET['limit']) && is_numeric($_GET['limit']) ? intval($_GET['limit']) : 10;

$query = utf8_decode("SELECT isbn, title, author, editorial FROM books_data ORDER BY isbn LIMIT $limit");

$pdf->Table($link, $query);
$pdf->Output();
?>