<?php

    if(isset($_POST)){
        $res = array('skills' => []);

        include  "../database.php";

        $queryRes = $con->query("select * from skills");

        while($row = $queryRes->fetch_assoc()){
            $res['skills'][] = $row['name'];
        }

        echo json_encode($res);
    }

?>