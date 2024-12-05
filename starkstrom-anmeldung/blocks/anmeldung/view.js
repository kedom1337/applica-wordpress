const anmeldeBlocks = document.querySelectorAll('#register-form');

anmeldeBlocks.forEach(block => {
    block.addEventListener('submit', function (event) {
        event.preventDefault();
        let selectedOptions = Array.from(block.querySelector('#fields').selectedOptions)
            .map(option => option.value);
        selectedOptions = selectedOptions.join(',');
        const formData = new FormData(this);
        formData.append('fields', selectedOptions);
        formData.append('action', 'handle_anmeldung_form_submission');
        submitAnmeldungForm(block, formData);
    });

    const fields = block.querySelectorAll('.rf-input');

    fields.forEach((field) => {
        const parentElement = field.parentElement;
        field.addEventListener('input', function () {
            if (field.classList.contains('invalid')) {
                field.classList.remove('invalid');
                const errorMassageNode = parentElement.querySelector('.registration-form-error-massage');
                if (errorMassageNode) {
                    parentElement.removeChild(errorMassageNode);
                }
            }
        });
    });
});

function setInputInvalidity(id, error) {
    const selectedField = document.getElementById(id);
    removeInputValidity(selectedField);

    selectedField.classList.add('invalid');

    if (error !== '') {
        const errorMessage = document.createElement("small");
        errorMessage.classList.add('registration-form-error-massage');
        errorMessage.innerText = error;

        selectedField.parentElement.appendChild(errorMessage);
    }
}

function removeInputValidity(el) {
    const parentElement = el.parentElement;
    const removeNode = parentElement.querySelector('.registration-form-error-massage');
    if (removeNode) {
        parentElement.removeChild(removeNode);
    }
}

function submitAnmeldungForm(block, formData) {
    fetch(baseURL + '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log('Response:', data);
            if (data.success) {
                block.outerHTML = '<h2>Vielen Dank für deine Anmeldung!</h2>';
            } else {
                const issues = data.data.error.issues;
                issues.forEach(issue => {
                    const fieldId = issue.path[0];
                    const errorMessage = issue.message;
                    setInputInvalidity(fieldId, errorMessage);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}