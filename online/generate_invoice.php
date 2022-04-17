<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
include 'admin/config.php';
require('invoice.php');
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$oid = $_REQUEST['oid'];
$fetch_order_details = "select concat(ifnull(ud.first_name, ''),' ',ifnull(ud.last_name, '')) as fullname, o.address as shipping_address , o.date as date, ud.address as user_address, o.id as order_id, p.product_name as product_name, p.product_price as price from orders o 
left join products p on o.product_id = p.id
left join user_details ud on ud.id = o.user_id
where o.id = '$oid'";
$result = $conn->query($fetch_order_details);
while($row = $result->fetch_assoc()){
    // print_r($row);
    // exit;
    $pdf->addSociete("Shipping Address",$row['shipping_address']);
    // $pdf->fact_dev( "Devis ", "TEMPO" );
    $order_date_timestamp = strtotime($row['date']);
    $order_date = date('Y-m-d', $order_date_timestamp);
    $pdf->temporaire( "The Buddies" );
    $pdf->addDate($order_date);
    // $pdf->addClient("CL01");
    $pdf->addPageNumber("1");
    $pdf->addClientAdresse($row['fullname']."\n".$row['user_address']);
    // $pdf->addReglement("Chèque à réception de facture");
    // $pdf->addEcheance("03/12/2003");
    // $pdf->addNumTVA("FR888777666");
    // $pdf->addReference("Devis ... du ....");
    $cols=array( "Order No"    => 23,
                "Date"      => 26,
                "Product Name"  => 78,
                "Price"     => 22);
    $pdf->addCols( $cols);
    $cols=array( "Order No"    => "C",
                "Date"  => "C",
                "Product Name"     => "C",
                "Price"      => "C");
    $pdf->addLineFormat( $cols);
    $pdf->addLineFormat($cols);

    $y    = 75;
    $line = array( "Order No"    => $row['order_id'],
                "Date"  => $row['date'],
                "Product Name"     => $row['product_name'],
                "Price"      => $row['price']);
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;

    // $line = array( "Order No"    => "REF2",
    //             "Date"  => "Câble RS232",
    //             "Product Name"     => "1",
    //             "Price"      => "10.00");
    // $size = $pdf->addLine( $y, $line );
    // $y   += $size + 2;

    // $pdf->addCadreTVAs();
            
    // invoice = array( "px_unit" => value,
    //                  "qte"     => qte,
    //                  "tva"     => code_tva );
    // tab_tva = array( "1"       => 19.6,
    //                  "2"       => 5.5, ... );
    // params  = array( "RemiseGlobale" => [0|1],
    //                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
    //                      "remise"         => value,     // {montant de la remise}
    //                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
    //                  "FraisPort"     => [0|1],
    //                      "portTTC"        => value,     // montant des frais de ports TTC
    //                                                     // par defaut la TVA = 19.6 %
    //                      "portHT"         => value,     // montant des frais de ports HT
    //                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
    //                  "AccompteExige" => [0|1],
    //                      "accompte"         => value    // montant de l'acompte (TTC)
    //                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
    //                  "Remarque" => "texte"              // texte
   /* $tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
                        array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
    $tab_tva = array( "1"       => 19.6,
                    "2"       => 5.5);
    $params  = array( "RemiseGlobale" => 1,
                        "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                        "remise"         => 0,       // {montant de la remise}
                        "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                    "FraisPort"     => 1,
                        "portTTC"        => 10,      // montant des frais de ports TTC
                                                    // par defaut la TVA = 19.6 %
                        "portHT"         => 0,       // montant des frais de ports HT
                        "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                    "AccompteExige" => 1,
                        "accompte"         => 0,     // montant de l'acompte (TTC)
                        "accompte_percent" => 15    // pourcentage d'acompte (TTC)
                     );*/
                     // $pdf->addTVAs( $params, $tab_tva, $tot_prods);
                        $pdf->addCadreEurosFrancs($row['price']);

                    }
$pdf->Output();
?>