<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <title>CodeIgniter4 DataTables</title>
</head>
<body>
<table id="myTable" class="display">
    <thead>
    <tr>
        <th>Acciones</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Identificacion</th>
        <th>DV</th>
        <th>Mail</th>
    </tr>
    </thead>
</table>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script type="text/javascript">

    $(document).ready( function () {
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'http://ts5pro.local/access/companies/jsonCompanies'
        });
    } );


</script>
</body>
</html>


<div class="card shadow-none border radius-15 ">
    <div class="card-body ">
        <table id="myTable" class="display">
            <thead>
            <tr>
                <th>Acciones</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Identificacion</th>
                <th>DV</th>
                <th>Mail</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">

    $(document).ready( function () {
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'http://ts5pro.local/access/companies/jsonCompanies'
        });
    } );


</script>