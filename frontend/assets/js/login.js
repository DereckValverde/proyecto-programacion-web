console.log('login.js cargado');

const login = (event) => {
    event.preventDefault();

    const form = document.querySelector('#frmLogin');
    const data = new FormData(form);

    console.log('data', data);

    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    document.querySelectorAll('#msgError').textContent = '';

    fetch('../../../backend/backend-admin/login.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(result => {
            submitButton.disabled = false;

            if (result.success) {
                localStorage.setItem('user', result.user);
                window.location.href = './dashboard.php';
            } else {
                document.querySelector('#msgError').textContent = result.message || "Credenciales incorrectas";

            }

        })
        .catch(error => {
            submitButton.disabled = false;
            document.querySelector('#msgError').textContent = "Ocurrió un error al conectar con el servidor";
            console.error('Error:', error);
        });
}

const form = document.querySelector('#frmLogin');
if (form) {
    form.addEventListener('submit', login);
}
