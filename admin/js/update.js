$(document).ready(function () {
    $("#updateButton").on("click", function (e) {
        e.preventDefault();

        let formData = new FormData();


        let data = {
            name: $("#inputName").val(),
            surname: $("#inputSurname").val(),
            email: $("#inputEmail").val(),
            address: $("#inputAddress").val(),
            phone: $("#inputPhone").val(),
            about: $("#inputAbout").val()
        };

        let skillsElement = document.getElementById("skills");
        let sections = skillsElement.children;

        let skills = [];


        for (let i = 0; i < sections.length; i++) {
            let obj = {};
            let currSection = sections[i];
            obj['selectedSkill'] = currSection.getElementsByTagName("select")[0].value;
            let inputs = currSection.getElementsByTagName("input");
            obj['percent'] = inputs[0].value;
            obj['user_skill_id'] = inputs[1].value;
            skills.push(obj);
            // console.log(obj);
        }

        let avatar = $("#newAvatar")[0].files[0];
        // let avatar = document.getElementById("newAvatar").files[0];
        console.log(avatar);
        formData.append("file", avatar);

        data['skills'] = skills;

        // upload image first
        console.log(skills);

        $.ajax({
            url: "upload_image.php",
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });

        $.ajax({
            url: "update_data.php",
            type: "POST",
            data: {data: data},
            dataType: "json",
            success: function (response) {
                console.log(response);
                if(response.message === 'success'){
                    window.location = "./dashboard.php";
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });

    });
});