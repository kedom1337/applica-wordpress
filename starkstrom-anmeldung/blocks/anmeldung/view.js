const anmeldeBlocks = document.querySelectorAll('#register-form');

anmeldeBlocks.forEach(block => {
    block.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'handle_anmeldung_form_submission');


        fetch('https://wordpress.local/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    block.outerHTML = '<h2>Vielen Dank für deine Anmeldung!</h2>';
                } else {
                    // alert('Form submission failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    const fields = block.querySelectorAll('.rf-input');


    fields.forEach((field) => {
        const parentElement = field.parentElement;
        field.addEventListener('input', function (event) {
            if (field.classList.contains('invalid')) {
                field.classList.remove('invalid');
                const errorMassageNode = parentElement.querySelector('.registration-form-error-massage');
                if (errorMassageNode) {
                    parentElement.removeChild(errorMassageNode);
                }
            }
        });
    });


    // setInputInvalidity('email', 'Falsche E-Mail.');
    // setInputInvalidity('phone', '');

    function setInputInvalidity(id, error) {
        const selectedField = Array.from(fields).find((field) => field.id === id);

        selectedField.classList.add('invalid');

        if (error !== '') {
            const errorMessage = document.createElement("small");
            errorMessage.classList.add('registration-form-error-massage')
            errorMessage.innerText = error;

            selectedField.parentElement.appendChild(errorMessage);
        }
    }

    function removeInputValidity(el) {
        const parentElement = el.parentElement;
        const removeNode = parentElement.querySelector('.registration-form-error-massage');
        parentElement.removeChild(removeNode);
    }
})