<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>User panel</title>

</head>
<body>

<?php require "app/include/header.php" ?>
<?php require "app/user.php" ?>




<?php
    include 'app/db/db_connect.php';

    $dataobj = new User();
    $dbconn = dbconnect();
    if ($_POST["type"] == "add") {
        $dataobj->userAdd($dbconn);
    }

    if ($_POST["type"] == "edit") {
        $dataobj->userEdit($dbconn);
    }

    if (isset($_GET["del"])) {

        $dataobj->userDelete($dbconn);
    }

    if ($_GET["add"]) {
        include 'app/newuserform.php';
    } elseif ($_GET["edit"]) {
        include 'app/changeuserform.php';

    } else {
        $datad = $dataobj->userList($dbconn);
        $data = $datad["data"];

        $page_count = $datad["page_count"];
        $page = $datad["page"];
        $elem_count = $datad["elem_count"]



?>


<table id="tableu" class="table table-striped table-sm">
    <tbody>
        <tr>
            <td>id</td>
            <td>Name</td>
            <td>Last name</td>
            <td>Email</td>
            <td>Company</td>
            <td>Position</td>
            <td>Phone №1</td>
            <td>Phone №2</td>
            <td>Phone №3</td>
        </tr>

    <? for($num = $page*$elem_count; $num < ($page + 1)*$elem_count;$num++):
        if($data[$num]["id"]) {
            ?>

        <tr>
            <td><?= $data[$num]["id"]?></td>
            <td><?= $data[$num]["first_name"] ?></td>
            <td><?= $data[$num]["last_name"] ?></td>
            <td><?= $data[$num]["email"] ?></td>
            <td><?= $data[$num]["company_name"] ?></td>
            <td><?= $data[$num]["position"] ?></td>
            <td><?= $data[$num]["phone1"] ?></td>
            <td><?= $data[$num]["phone2"] ?></td>
            <td><?= $data[$num]["phone3"] ?></td>
            <td><a href="\?edit=<?=$data[$num]["id"]?>">Edit</a></td>
            <td><a href="\?del=<?=$data[$num]["id"]?>">Delete</a></td>
        </tr>

    <? } endfor; ?>

    </tbody>
</table>
<? } ?>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <? for($pg = 0; $pg < $page_count;$pg++): ?>
            <li class="page-link"><a href="/?page=<?=$pg?>"><?echo $pg + 1?></a> </li>
        <?endfor;?>
    </ul>

</nav>
</body>
</html>

