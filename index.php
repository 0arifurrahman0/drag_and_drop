<?php

include 'db.php';

?>

<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .box {
            width: 100px; height: 100px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Drag & Drop</h2>
    <button class="btn btn-primary mb-3" onclick="addRow()">Add Row</button>
    <button class="btn btn-success mb-3" onclick="addColumn()">Add Column</button>
<table class="table-bordered">
    <tbody>
<?php
    $sl = 1;
    for ($i=0; $i<$row; $i++) {
?>
    <tr>
        <?php for($j=0; $j<$column; $j++) { ?>
            <th class="box" id="box-<?= $sl ?>" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php
                    if(in_array($sl, $objects)) { ?>
                        <img id="<?= $sl ?>" src="drag.jpg" alt="image" style="cursor: pointer;"
                     draggable="true" ondragstart="drag(event)" width="100" />
                <?php } ?>
            </th>
        <?php $sl++; } ?>
    </tr>
<?php } ?>
        </tbody>
    </table>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData('text', ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();

        if((ev.target.id).search('box') == -1) {
            alert('Sorry! Already an object in the box.');
            return false;
        }

        var drag_id = ev.dataTransfer.getData('text');
        var drop_id = (ev.target.id).split('-')[1];
        ajaxSave(drag_id, drop_id);
        ev.target.appendChild(document.getElementById(drag_id));
    }

    function ajaxSave(drag_id, drop_id) {
        $.ajax({
            method: 'POST',
            url: 'update.php',
            data: {drag_id: drag_id, drop_id: drop_id}
        }).done(function (res) {
            console.log(res);
        });
    }
    
    function addRow() {
        $.ajax({
            method: 'POST',
            url: 'update.php',
            data: {add_row: 1}
        }).done(function (res) {
            location.reload();
        });
    }

    function addColumn() {
        $.ajax({
            method: 'POST',
            url: 'update.php',
            data: {add_column: 1}
        }).done(function (res) {
            location.reload();
        });
    }

</script>
</body>
</html>