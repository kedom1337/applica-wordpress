<?php

?>
<script src="<?php echo PLUGIN_URL . 'assets/js/MultiSelect.js' ?>"></script>
<form id="register-form">
	<input type="text" name="firstName" placeholder="First Name" required />
	<input type="text" name="lastName" placeholder="Last Name" required />
	<input type="email" name="email" placeholder="Email" required />
	<input type="text" name="phone" placeholder="Phone" required />
	<input type="number" name="courseId" placeholder="Course ID" required />
	<input type="number" name="semester" placeholder="Semester" required />
	<input type="text" name="degree" placeholder="Degree" required />
	<textarea name="experience" placeholder="Experience" required></textarea>
	<textarea name="information" placeholder="Information" required></textarea>
	<input type="number" name="course" placeholder="Course" required />
	<input type="text" name="fields" placeholder="Fields (comma-separated)" required />
	<button type="submit">Absenden</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('register-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'handle_anmeldung_form_submission');

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.data.message);
                    } else {
                        alert('Form submission failed.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
        });
    });
</script>