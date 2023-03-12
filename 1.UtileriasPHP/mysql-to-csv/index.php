<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Members list
            <a href="exportData.php" class="btn btn-success pull-right">Export Members</a>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Created</th>
                      <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    //include database configuration file
                    include './dbConfig.php';
                    
                    //get records from database
                    $query = $db->query("SELECT * FROM inventario ORDER BY rowid DESC");
                    if($query->num_rows > 0){ 
                        while($row = $query->fetch_assoc()){ ?>                
                    <tr>
                      <td><?php echo $row['rowid']; ?></td>
                      <td><?php echo $row['codigo']; ?></td>
                      <td><?php echo $row['nombre']; ?></td>
                      <td><?php echo $row['precio_compra']; ?></td>
                      <td><?php echo $row['precio_venta']; ?></td>
                      <td><?php echo $row['utilidad']; ?></td>
                      <td><?php echo $row['stock']; ?></td>
                      <td><?php echo $row['familia']; ?></td>
                      <td><?php echo $row['idLinea']; ?></td>
                      <td><?php echo $row['idMarca']; ?></td>
                      <td><?php echo $row['idCategoria']; ?></td>
                      <td><?php echo ($row['suspendido'] == '1')?'Active':'Inactive'; ?></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">No member(s) found.....</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>