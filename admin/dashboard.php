<?php
include("../admin/header.php");
if (!isset($_SESSION['user']) or $_SESSION['permission'] !== 'admin') {
    header("Location: index.php");
}

include("../database.php");

$queryUserData = "select u.id, u.name, u.surname, u.avatar, con.email, con.address, con.phone,ab.content as about from users u left outer join contacts con ON
u.contact_id = con.id left outer join abouts ab on u.about_id = ab.id limit 1;";

$queryUserSkills = "select us.id, s.name as skill_name, us.percent as skill_percent from user_skills us inner join
skills s on us.skill_id = s.id where us.user_id = 1;";

$userDataResult = $con->query($queryUserData);
$userSkillsResult = $con->query($queryUserSkills);
$availableSkills = $con->query("select * from skills;");

$skills = array();
$userSkills = array();

$rangeId = 1;
$sectionId = 1;

while ($row = $userSkillsResult->fetch_assoc()) {
    $userSkills[] = $row;
}

while ($row = $availableSkills->fetch_assoc()) {
    $skills[] = $row['name'];
}

$user = $userDataResult->fetch_assoc();


?>

    <script src="js/skill_percent.js"></script>
    <script src="js/delete_skill.js"></script>
    <script src="js/add_skill.js"></script>
    <script src="js/update.js"></script>

    <div class="mt-3">
        <form id="data" action="" method="post">

            <div class="container mb-5 mt-4">


                <div class="card p-4" style="border-radius: 10px;">

                    <?php
                    $avatar = "";
                    if (strlen($user['avatar'] . trim(' ')) == 0) {
                        $avatar = "../uploads/default_avatar.png";
                    } else {
                        $avatar = "../uploads/" . $user['avatar'];
                    }
                    ?>

                    <img src="<?= $avatar ?>" class="myAvatar mb-4"
                         width="200px" style="cursor: pointer">

                    <input type="file" id="newAvatar" name="newAvatar" class="mb-3" style="display:none;"
                           accept="image/jpeg, image/png, image/jpg">

                    <form>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="inputName">First name</label>
                                <input name="name" type="text" class="form-control" id="inputName"
                                       value="<?= $user['name'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputSurname">Last name</label>
                                <input name="surname" type="text" class="form-control" id="inputSurname"
                                       value="<?= $user['surname'] ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="inputEmail">Email</label>
                                <input name="name" type="email" class="form-control" id="inputEmail"
                                       value="<?= $user['email'] ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="inputAddress">Address</label>
                                <input name="surname" type="text" class="form-control" id="inputAddress"
                                       value="<?= $user['address'] ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="inputPhone">Phone</label>
                                <input name="surname" type="tel" class="form-control" id="inputPhone"
                                       value="<?= $user['phone'] ?>">
                            </div>
                        </div>

                        <label for="inputAbout">About</label>
                        <textarea name="about" id="inputAbout" cols="30" rows="5"><?= $user['about'] ?></textarea>

                        <button type="button" class="btn btn-primary mt-3 mb-2" style="width: 150px;"
                                onclick="addSkill()"><i class="fa fa-plus mr-2"></i> Add skill
                        </button>

                        <div id="skills" class="mt-1">
                            <?php foreach ($userSkills as $userSkill): ?>


                                <div id="<?= 'section' . $sectionId ?>">
                                    <div class="form-row">
                                        <select class="custom-select col-3 mr-3">

                                            <option selected><?= $userSkill['skill_name'] ?> </option>
                                            <?php
                                            $counter = 1;

                                            foreach ($skills as $skill) {
                                                ?>
                                                <option value="<?= $skill ?>"> <?= $skill ?></option>
                                                <?php
                                                $counter++;
                                            }
                                            ?>
                                        </select>
                                        <button type="button" class="btn btn-danger"
                                                onclick="deleteUserSkill(<?= $userSkill['id'] ?>,<?= $sectionId ?>)">
                                            Delete
                                        </button>
                                    </div>

                                    <input value="<?= $userSkill['skill_percent'] ?>" type="range"
                                           class="custom-range mt-2"
                                           min="0" max="100" id="<?= 'range' . $rangeId ?>">
                                    <label class="<?= 'range' . $rangeId ?>"
                                           style="display: block; text-align: center; color: purple;font-size: 20px;"
                                           for="<?= 'range' . $rangeId ?>"><?= $userSkill['skill_percent'] ?></label>

                                    <input type="hidden" id="user_skill_id" value="<?= $userSkill['id'] ?>">

                                    <hr>
                                </div>
                                <?php
                                $rangeId++;
                                $sectionId++;
                                ?>
                            <?php endforeach; ?>
                        </div>


                        <button class="btn btn-success mt-4" type="submit" id="updateButton">Update</button>
                    </form>

                </div>


            </div>


    </div>
    </form>


    </div>

    <script>
        $(".myAvatar").click(function () {
            $("#newAvatar").trigger("click");
        });

        let imgInp = document.getElementById("newAvatar");

        imgInp.onchange = evt => {
            const [file] = imgInp.files;
            let allowedFileTypes = ['jpg', 'jpeg', 'png', 'pjp', 'pjpeg', 'jfif'];
            if (file && allowedFileTypes.some(type => file.name.endsWith(type))) {
                // console.log(file);
                let avatar = document.querySelector(".myAvatar");
                avatar.src = URL.createObjectURL(file)
            }
        }

    </script>


<?php
include("../bootstrap_js.php");
?>