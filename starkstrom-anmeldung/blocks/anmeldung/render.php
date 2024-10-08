<?php
$oAnmeldung = new Mod_Application();
?>

<form id="register-form" class="registration-form">

    <div class="registration-form-input">
        <label class="label" for="firstName">Vorname</label>
        <input type="text" name="firstName" id="firstName" placeholder="Max" class="rf-input" required/>
    </div>
    <div class="registration-form-input">
        <label class="label" for="lastName">Nachname</label>
        <input type="text" name="lastName" id="lastName" placeholder="Mustermann" class="rf-input" required/>
    </div>

    <div class="registration-form-input">
        <label class="label" for="email">E-Mail</label>
        <input type="email" name="email" id="email" placeholder="max.mustermann@email.com" class="rf-input" required/>
    </div>

    <div class="registration-form-input">
        <label class="label" for="phone">Telefonnummer</label>
        <input type="text" name="phone" id="phone" placeholder="+49 566 5268 26" class="rf-input" required/>
    </div>

    <div class="registration-form-input custom-select">
        <label class="label" for="course">Studiengang</label>
        <select name="course" id="course">
            <option value="0" class="disabled" disabled selected>Studiengang</option>
            <?php $oAnmeldung->getOptionCourseOfStudy() ?>
        </select>
    </div>

    <div class="registration-form-input">
        <label class="label" for="semester">Semester</label>
        <input type="number" name="semester" id="semester" min="1" max="16" placeholder="Semester" class="rf-input"/>
    </div>

    <div class="registration-form-input">
        <label class="label" for="degree">Degree</label>
        <input type="text" name="degree" id="degree" placeholder="Degree" class="rf-input" required/>
    </div>

    <div class="registration-form-input">
        <label class="label" for="fields">Interessen</label>
        <select id="fields" multiple placeholder="Interessen">
            <?php $oAnmeldung->getOptionFieldAreas() ?>
        </select>
    </div>

    <div class="registration-form-input registration-form-textarea">
        <label class="label" for="experience">Erfahrungen</label>
        <textarea name="experience" id="experience" placeholder="Erfahrungen" required></textarea>
    </div>

    <div class="registration-form-input registration-form-textarea">
        <label class="label" for="information">Weitere Informationen</label>
        <textarea name="information" id="information" placeholder="Weitere Informationen"></textarea>
    </div>

    <button class="registration-form-submit" type="submit">Absenden</button>
</form>

<script src="<?php echo PLUGIN_URL . 'assets/js/multiselect-dropdown.js' ?>"></script>
<script src="<?php echo PLUGIN_URL . 'assets/js/custom_select.js' ?>"></script>
<script>var baseURL = "<?php echo get_site_url() ?>";</script>

