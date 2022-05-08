<?php

    if(isset($_POST)){
        include  "../database.php";

        $id = $_POST['id'];
        $res = array();
        $res['id'] = $id;

        $sql = "delete from user_skills where id='$id';";

        $con->query($sql);
        echo json_encode($res);
    }


?>