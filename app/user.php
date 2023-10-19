<?php

//класс пользователь
Class User {

    private $dbconnect;


//    function __construct($dbconnect)
//    {
//        $this->dbconnect = $dbconnect;
//    }


    public function getUserByID($database, $uid) {
        $data = $database->query('SELECT user.id, 
                                user.first_name, 
                                user.last_name,
                                user.email, 
                                user.company_name, 
                                user.position,
                                COALESCE(MAX(CASE WHEN phone.number = 1 THEN phone.phone END), "Пусто") as phone1,
                                COALESCE(MAX(CASE WHEN phone.number = 2 THEN phone.phone END), "Пусто") as phone2,
                                COALESCE(MAX(CASE WHEN phone.number = 3 THEN phone.phone END),"Пусто") as phone3
                                FROM user left join phone on phone.uid = user.id where user.ondel = 0 and user.id = '.$uid.'
                                GROUP BY user.id,user.first_name, 
                                         user.last_name,user.email, 
                                         user.company_name, user.position');
        $data = $data->fetch();
        return $data;
    }




    private function checkEmail($database,$email,$uid) {
        $check = 1;
        $checknew = $database->query("SELECT user.email as EMAIL FROM user WHERE user.email = '$email'");
        $checknew = $checknew->fetch();

        $checkmain = $database->query("SELECT user.email as EMAIL FROM user WHERE user.id ='$uid'");
        $checkmain = $checkmain->fetch();
        if(!$checkmain["EMAIL"])
            if($checknew["EMAIL"]) {
                echo "Введенная почта уже используется";
                $check = 0;
        }
        return $check;
    }

    //Метод для проверки обязательных полей first_name, last_name, email
    private function reqFieldCheck($arraytocheck) {
        foreach ($arraytocheck as $key => $value) {
            if(!$value) {
                echo "Поле $key является обязательным!";
                die();
            }
        }
    }

    //Метод для добавления нового пользователя.
    function userAdd($database) {
        if (isset($_POST['userAddSubmit'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $company_name = $_POST['company_name'];
            $position = $_POST['position'];

            $phone1 = $_POST['phone1'];
            $phone2 = $_POST['phone2'];
            $phone3 = $_POST['phone3'];

            $check = $this->checkEmail($database,$email,0);
            if(!$check) die();
            $uidar = $database->query("SELECT MAX(user.id) AS MAX_ID FROM user");
            $uidar = $uidar->fetchAll();
            $uid = $uidar[0]["MAX_ID"] + 1;

            $arraytocheck = array(
                'Имя' => $first_name,
                'Фамилия' => $last_name,
                'Почта' => $email
            );

            $contenphone = array(
                1 => $phone1,
                2 => $phone2,
                3 => $phone3,
            );

            $this->reqFieldCheck($arraytocheck);

            $database->exec("INSERT INTO user (first_name, last_name, email, company_name,position)
                VALUES ('$first_name', '$last_name', '$email', '$company_name', '$position')");

            foreach ($contenphone as $key => $value) {
                if ($value==NULL) $value = 'Пусто';
                $database->exec("INSERT INTO phone (uid, phone, number) VALUES ('$uid', '$value', '$key')");
            }

            header("Location: index.php");


        }
    }

    //Метод для изменения информации о пользователе.
    function userEdit($database) {
        if (isset($_POST['userChangeSubmit'])) {

            $uid = $_GET['edit'];

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $company_name = $_POST['company_name'];
            $position = $_POST['position'];
            $phone1= $_POST['phone1'];
            $phone2= $_POST['phone2'];
            $phone3= $_POST['phone3'];

            $check = $this->checkEmail($database,$email,$uid);
            if(!$check) die();
            $contente = array(
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'email' => $email,
                            'company_name' => $company_name,
                            'position' => $position

            );
            $contenphone = array(
                                1 => $phone1,
                                2 => $phone2,
                                3 => $phone3,
            );

            foreach ($contente as $key => $value) {
                if ($value!=NULL) {
                        $database->exec("UPDATE user SET $key='$value' WHERE user.id='$uid'");
                }
                unset($value,$key);
            }

            foreach ($contenphone as $key => $value) {
                if ($value!=NULL) {
                    $database->exec("UPDATE phone SET phone='$value' WHERE uid = '$uid' and number = '$key'");
                }
                unset($value,$key);
            }

            header("Location: index.php");
        }
    }

    //Метод для удаления пользователя.
    function userDelete($database) {

        $uid = $_GET['del'];

        $database->exec("UPDATE user SET ondel = '1' WHERE user.id='$uid'");
    }

    //Метод для получения списка пользователей.
    function userList($database) {
        $page = $_GET['page'];
        $elem_count = 10;

        $all = $database->query('SELECT COUNT(*) FROM user as COUNT WHERE ondel = 0 ');
        $all = $all->fetchAll();

        $page_count = ceil($all[0]["COUNT(*)"] / $elem_count);

        $data = $database->query('SELECT user.id, 
                                user.first_name, 
                                user.last_name,
                                user.email, 
                                user.company_name, 
                                user.position,
                                COALESCE(MAX(CASE WHEN phone.number = 1 THEN phone.phone END), "Пусто") as phone1,
                                COALESCE(MAX(CASE WHEN phone.number = 2 THEN phone.phone END), "Пусто") as phone2,
                                COALESCE(MAX(CASE WHEN phone.number = 3 THEN phone.phone END),"Пусто") as phone3
                                FROM user left join phone on phone.uid = user.id where user.ondel = 0
                                GROUP BY user.id,user.first_name, 
                                         user.last_name,user.email, 
                                         user.company_name, user.position');
        $data = $data->fetchAll();

        $dataclaster = array(
            'data' => $data,
            'page_count' => $page_count,
            'page' => $page,
            'elem_count' => $elem_count
        );
        return $dataclaster;
    }
}
