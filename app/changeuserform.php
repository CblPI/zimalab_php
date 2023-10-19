<?php
/*
    Файл с формой для изменения данных о пользователе.
*/

/* @var User $dataobj  */

$data = $dataobj->getUserByID($dbconn, $_GET["edit"]);

?>


<form method="post">
    <input type="text" name="type" value="edit" hidden>
    <h1 class="title-info" title="Форма создания изменения пользователя">Изменить пользователя</h1>
    <div class="group">
        <label class="label-new" for="">Имя</label>
        <input class="input-type" required type="text" name="first_name" value="<?=$data["first_name"]?>">

    </div>
    <div class="group">
        <label class="label-new" for="">Фамилия</label>
        <input class="input-type" required type="text" name="last_name" value="<?=$data["last_name"]?>">

    </div>
    <div class="group">
        <label class="label-new" for="">Почта</label>
        <input  class="input-type"required type="text" name="email" value="<?=$data["email"]?>">

    </div>
    <div class="group">
        <label class="label-new" for="">Должность</label>
        <input class="input-type" type="text" name="position" value="<?=$data["position"]!="Пусто"?$data["position"]:''?>">

    </div>
    <div class="group">
        <label class="label-new" for="">Название компании</label>
        <input class="input-type" type="text" name="company_name" value="<?=$data["company_name"]!="Пусто"?$data["company_name"]:''?>">

    </div>
    <div class="group">
        <label class="label-new" for="">Телефон №1</label>
        <input class="input-type" type="text" name="phone1" value="<?=$data["phone1"]!="Пусто"?$data["phone1"]:''?>">

    </div>
    <div class="group">
        <label class="label-new" for="">Телефон №2</label>
        <input class="input-type" type="text" name="phone2" value="<?=$data["phone2"]!="Пусто"?$data["phone2"]:''?>">

    </div>
    <div class="group">
        <label class="label-new" for="">Телефон №3</label>
        <input class="input-type" type="text" name="phone3" value="<?=$data["phone3"]!="Пусто"?$data["phone3"]:''?>">

    </div>

    <input class="btn-add" type="submit"  name="userChangeSubmit">
    <input class="btn-back" submit" name="Back" value="Назад">
    <?if($_POST["Back"]) header("Location: index.php");?>



</form>

<?php
