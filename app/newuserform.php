
<form method="post">
    <input type="text" name="type" value="add" hidden>
    <h1 title="Форма создания нового пользователя">Новый пользователь</h1>
    <div class="group">
        <label for="">Имя</label>
        <input type="text" name="first_name">

    </div>
    <div class="group">
        <label for="">Фамилия</label>
        <input type="text" name="last_name">

    </div>
    <div class="group">
        <label for="">Почта</label>
        <input type="text" name="email">

    </div>
    <div class="group">
        <label for="">Должность</label>
        <input type="text" name="position">

    </div>
    <div class="group">
        <label for="">Название компании</label>
        <input type="text" name="company_name">

    </div>
    <div class="group">
        <label for="">Телефон №1</label>
        <input type="text" name="phone1">

    </div>
    <div class="group">
        <label for="">Телефон №2</label>
        <input type="text" name="phone2">

    </div>
    <div class="group">
        <label for="">Телефон №3</label>
        <input type="text" name="phone3">

    </div>

    <input type="submit" name="userAddSubmit">
    <input type="submit" name="Back" value="Назад">
    <?if($_POST["Back"]) header("Location: index.php");?>

</form>





