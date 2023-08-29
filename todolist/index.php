<?php 

    include_once "includes/auto_load.inc.php";
    $dbh = new Dbh();
    $sqlQuery = "SELECT * FROM tasks";

    $stmt = $dbh->connect()->prepare($sqlQuery);
    $stmt->execute();
    $rows = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

    <h2 style="text-align: center">To Do List</h2>

    <form action="includes/insert_task.inc.php" method="POST">
        <div class="form-group">
            <div class="input-group mb-3">
                <span>
                <input type="text" class="form-control" name="title" placeholder="Title"
                    aria-describedby="button-addon2" data-ms-editor="true">
                </span>&nbsp;<input type="text" class="form-control" name="task" placeholder="Create Task"
                    aria-describedby="button-addon2" data-ms-editor="true">
                <input class="btn btn-primary" type="submit" name="submit" id="button-addon2" value="Submit">
            </div>
        </div>
    </form>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Task</th>
                <th scope="col">Created</th>
                <th scope="col" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $row){?>
            <tr class="table-info">
                <th scope="row"><?php echo $row->id?></th>
                <td><?php echo $row->title?></td>
                <td><?php echo $row->task?></td>
                <td><?php echo $row->created_at?></td>
                <td colspan="2"><span><form action="includes/del_task.inc.php" method="post">
                                            <input type="hidden" name="row_id" value="<?php echo $row->id ?>">
                                            <input class="btn btn-danger" name="del" type="submit" id="button-addon2" value="Delete">
                                        </form>
                                </span>
                </td>
            </tr>
            <?php }?>

        </tbody>
    </table>
    </div>





</body>

</html>