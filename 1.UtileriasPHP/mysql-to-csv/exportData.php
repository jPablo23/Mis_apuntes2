<?php
//include database configuration file
include './dbConfig.php';

//get records from database
$query = $db->query("SELECT * FROM inventario ORDER BY rowid DESC");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "inventario_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('rowid', 'codigo', 'nombre', 'precio_compra', 'precio_venta', 'utilidad','stock', 'familia', 'idLinea', 'idMarca', 'idCategoria', 'suspendido');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $status = ($row['suspendido'] == '1')?'Active':'Inactive';
        $lineData = array($row['rowid'], $row['codigo'], $row['nombre'], $row['precio_compra'], $row['precio_venta'],$row['utilidad'], $row['stock'], $row['familia'], $row['idLinea'],$row['idMarca'], $row['idCategoria'], $status);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>