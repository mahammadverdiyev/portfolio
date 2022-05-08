function deleteUserSkill(id, sectionId) {

    let areYouSure = confirm("Are you sure you want to delete this skill?");

    if (areYouSure) {


        $.ajax({
            url: "delete_user_skill.php",
            type: "POST",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                let section = document.getElementById(`section${sectionId}`);

                $(`#section${sectionId}`).slideUp(500, function () {
                    section.remove();
                });
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    }

}
