document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const resultDiv = document.getElementById('result');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('test-upload-process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            resultDiv.style.display = 'block';

            if (data.success) {
                resultDiv.className = 'result success';
                resultDiv.innerHTML = `
                    <strong>Sukses!</strong> ${data.message}<br>
                    <strong>Path:</strong> ${data.path}<br>
                    <img src="${data.path}" style="max-width: 100%; margin-top: 10px;" alt="Uploaded image">
                `;
            } else {
                resultDiv.className = 'result error';
                resultDiv.innerHTML = `<strong>Error:</strong> ${data.message}`;
            }
        })
        .catch(error => {
            resultDiv.style.display = 'block';
            resultDiv.className = 'result error';
            resultDiv.innerHTML = `<strong>Error:</strong> ${error.message}`;
        });
    });
});