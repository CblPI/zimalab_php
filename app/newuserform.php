<?
/*
    Файл с формой для добавления нового пользователя.
*/
?>
<form method="post">
    <input type="text" name="type" value="add" hidden>
    <h1 class="title-info" title="Форма создания нового пользователя" ">Новый пользователь</h1>
    <div class="group">
        <label class="label-new" for="">Имя</label>
        <input class="input-type" type="text" name="first_name">

    </div>
    <div class="group">
        <label class="label-new" for="">Фамилия</label>
        <input class="input-type" type="text" name="last_name">

    </div>
    <div class="group">
        <label class="label-new" for="">Почта</label>
        <input class="input-type" type="text" name="email">

    </div>
    <div class="group">
        <label class="label-new" for="">Должность</label>
        <input class="input-type" type="text" name="position">

    </div>
    <div class="group">
        <label class="label-new" for="">Название компании</label>
        <input class="input-type" type="text" name="company_name">

    </div>
    <div class="group">
        <label class="label-new" for="">Телефон №1</label>
        <input class="input-type" type="text" name="phone1">

    </div>
    <div class="group">
        <label class="label-new" for="">Телефон №2</label>
        <input class="input-type" type="text" name="phone2">

    </div>
    <div class="group">
        <label class="label-new" for="">Телефон №3</label>
        <input class="input-type" type="text" name="phone3">

    </div>

    <input class="btn-add" type="submit" name="userAddSubmit" value="Добавить">
    <input class="btn-back" type="submit" name="Back" value="Назад">
    <?if($_POST["Back"]) header("Location: index.php");?>

</form>





