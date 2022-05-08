function addSkill() {
    Element.prototype.insertChildAtIndex = function(child, index) {
        if (!index) index = 0
        if (index >= this.children.length) {
            this.appendChild(child)
        } else {
            this.insertBefore(child, this.children[index])
        }
    }

    let skillTag = document.getElementById('skills');

    let sectionId = skillTag.children.length + 1;
    let rangeId = sectionId;

    $.ajax({
        url: "get_skills.php",
        type: "POST",
        data: {},
        dataType: "json",
        success: function (response) {
            let skills = response.skills;

            let section = document.createElement('div');
            section.id = `section${sectionId}`;

            let formRow = document.createElement('div');
            formRow.className = "form-row";

            let select = document.createElement("select");
            select.className = "custom-select col-3 mr-3";
            select.selectedIndex = 1;

            skills.forEach(skill =>{
                let option = document.createElement("option");
                option.textContent = skill;
                option.value = skill;
                select.appendChild(option);
            });

            let button = document.createElement("button");
            button.type = "button";
            button.className = "btn btn-danger";
            button.textContent = "Delete";

            button.addEventListener("click", function (e) {
                let sure = confirm("Are you sure you want to delete this skill?");
                if(sure){
                    $(`#section${sectionId}`).slideUp(500, function () {
                        section.remove();
                    });
                }
            });

            formRow.appendChild(select);
            formRow.appendChild(button);

            let slider = document.createElement("input");
            slider.value = "50";
            slider.type = "range";
            slider.className = "custom-range";
            slider.id = `range${rangeId}`;
            slider.min = "0";
            slider.max = "100";

            let label = document.createElement("label");
            label.className = `range${rangeId}`;
            label.setAttribute('for',`range${rangeId}`);
            label.textContent = "50";
            label.style.display = "block";
            label.style.textAlign = "center";
            label.style.color = "purple";
            label.style.fontSize = "20px";
            // for storing the user_skill row id
            let hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.value = "-1";
            hiddenInput.id = "user_skill_id";

            let hr = document.createElement("hr");

            section.appendChild(formRow);
            section.appendChild(slider);
            section.appendChild(label);
            section.appendChild(hiddenInput);
            section.append(hr);

            document.getElementById("skills").insertChildAtIndex(section,0);

        },
        error: function (request, status, error) {
            console.log(request.responseText);
        }
    });
    /*

    <div id="<?= 'section' . $sectionId ?>">
                                    <div class="form-row">
                                        <select class="custom-select col-3 mr-3">
                                            <option selected><?= $userSkill['skill_name'] ?> </option>
                                            <?php
                                            $counter = 1;

                                            foreach ($skills as $skill) {
                                                ?>
                                                <option value="<?= $userSkill['skill_name'] ?>"> <?= $skill ?></option>
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

                                    <input value="<?= $userSkill['skill_percent'] ?>" type="range" class="custom-range"
                                           min="0" max="100" id="<?= 'range' . $rangeId ?>">
                                    <label class="<?= 'range' . $rangeId ?>"
                                           for="<?= 'range' . $rangeId ?>"><?= $userSkill['skill_percent'] ?></label>


                                    <hr>
                                </div>
     */
}