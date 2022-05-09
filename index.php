<?php

include("database.php");

$queryUserData = "select u.id, u.name, u.surname, u.avatar, con.email, con.address, con.phone,ab.content as about from users u left outer join contacts con ON
u.contact_id = con.id left outer join abouts ab on u.about_id = ab.id limit 1;";

$queryUserSkills = "select us.id, s.name as skill_name, us.percent as skill_percent from user_skills us inner join
skills s on us.skill_id = s.id where us.user_id = 1 order by skill_percent desc;";

$userDataResult = $con->query($queryUserData);
$userSkillsResult = $con->query($queryUserSkills);

$userSkills = array();

while ($row = $userSkillsResult->fetch_assoc()) {
    $userSkills[] = $row;
}
$user = $userDataResult->fetch_assoc();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Portfolio Website</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="slider_design.css">
</head>
<body>
<script src="set_sliders.js"></script>

<div class="scroll-up-btn">
    <i class="fas fa-angle-up"></i>
</div>
<nav class="navbar">
    <div class="max-width">
        <div class="logo"><a href="index.php">Mahammad <span>V</span></a></div>
        <ul class="menu">
            <li><a href="#home" class="menu-btn">Home</a></li>
            <li><a href="#about" class="menu-btn">About</a></li>
            <li><a href="#skills" class="menu-btn">Skills</a></li>
            <li><a href="#contact" class="menu-btn">Contact</a></li>
        </ul>
        <div class="menu-btn">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>

<!-- home section start -->
<section class="home" id="home">
    <div class="max-width">
        <div class="home-content">
            <div class="text-1">Hello, I am</div>
            <div class="text-2"><?= $user['name'] . ' ' . $user['surname'] ?></div>
            <div class="text-3">And I'm a <span class="typing"></span></div>
            <!--            <a href="#">Hire me</a>-->
        </div>
    </div>
</section>

<!-- about section start -->
<section class="about" id="about">
    <div class="max-width">
        <h2 class="title">About me</h2>
        <div class="about-content">
            <div class="column left" style="border-radius: 50px;">
                <img src="uploads/<?= $user['avatar'] ?>" alt="">
            </div>
            <div class="column right">
                <div class="text">I'm <?= $user['name'] ?> and I'm a <span class="typing-2"></span></div>
                <p><?= $user['about'] ?></p>
                <a href="#">Download CV</a>
            </div>
        </div>
    </div>
</section>


<!-- skills section start -->
<section class="skills" id="skills">
    <div class="max-width">
        <h2 class="title">My skills</h2>
        <div class="skills-content">
            <div class="column left">
                <div class="text">My skills & experiences.</div>
                <p><?= $user['about'] ?></p>
                <a href="#">Read more</a>
            </div>


            <div class="column right">
                <div class="container">
                    <div class="skills">

                        <?php

                        foreach ($userSkills as $skill) {
                            ?>
                            <div class="skill">
                                <!-- title -->
                                <div class="skill-title">
                                    <?= $skill['skill_name'] ?>
                                </div>
                                <!-- bar -->
                                <div class="skill-bar" data-bar="<?= $skill['skill_percent'] ?>"><span></span></div>
                            </div>

                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- contact section start -->
<section class="contact" id="contact">
    <div class="max-width">
        <h2 class="title">Contact me</h2>
        <div class="contact-content">
            <div class="column left">
                <div class="text">Get in Touch</div>
                <p>If you have any question or in any case if you want to contact to me, Please fill forms below and send your message. I'll touch you in a short time when available. Thank you!
                </p>
                <div class="icons">
                    <div class="row">
                        <i class="fas fa-user"></i>
                        <div class="info">
                            <div class="head">Name</div>
                            <div class="sub-title"><?=$user['name'] ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="info">
                            <div class="head">Address</div>
                            <div class="sub-title"><?=$user['address'] ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <i class="fas fa-envelope"></i>
                        <div class="info">
                            <div class="head">Email</div>
                            <div class="sub-title"><?=$user['email'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column right">
                <div class="text">Message me</div>
                <form action="#">
                    <div class="fields">
                        <div class="field name">
                            <input type="text" placeholder="Name" required>
                        </div>
                        <div class="field email">
                            <input type="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Subject" required>
                    </div>
                    <div class="field textarea">
                        <textarea cols="30" rows="10" placeholder="Message.." required></textarea>
                    </div>
                    <div class="button-area">
                        <button type="submit">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- footer section start -->
<footer>
    <span>Created By <a target="_blank" href="https://github.com/mahammadverdiyev">Mahammad</a> | <span
                class="far fa-copyright"></span> <?= date("Y") ?> All rights reserved.</span>
</footer>

<script src="script.js"></script>
</body>
</html>
