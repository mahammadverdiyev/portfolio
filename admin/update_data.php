<?php

function updateData($con, $table, $column, $value,$match,$to)
{
    $con->query("update $table set $column = '$value' where $match = $to;");
}

function updateUserSkill($con, $skill, $percent, $id)
{
    $query = "update user_skills set skill_id = (select id from skills where name = '$skill'), percent = $percent
                where id = $id;";

    $con->query($query);
}

function insertUserSkill($con, $skill, $percent)
{
    $query = "insert into user_skills(skill_id, percent, user_id) values((select id from skills where name='$skill'),$percent,1);";
    $con->query($query);
}

if (isset($_POST)) {
    include "../database.php";
    $data = $_POST['data'];

    $name = $con->real_escape_string($data['name']);
    $surname = $con->real_escape_string($data['surname']);
    $email = $con->real_escape_string($data['email']);
    $address = $con->real_escape_string($data['address']);
    $about = $con->real_escape_string($data['about']);
    $phone = $con->real_escape_string($data['phone']);

    $skills = $data['skills'];

    updateData($con,'users','name',$name,'id',1);
    updateData($con,'users','surname',$surname,'id',1);
    updateData($con,'contacts','email',$email,'user_id',1);
    updateData($con,'contacts','address',$address,'user_id',1);
    updateData($con,'contacts','phone',$phone,'user_id',1);
    updateData($con,'abouts','content',$about,'user_id',1);

    foreach ($skills as $obj) {
        if ($obj['user_skill_id'] == '-1') {
            insertUserSkill($con, $obj['selectedSkill'], $obj['percent']);
        } else {
            updateUserSkill($con, $obj['selectedSkill'], $obj['percent'], $obj['user_skill_id']);
        }
    }

    echo json_encode(array("message" => 'success'));

}

?>