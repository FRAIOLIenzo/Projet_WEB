const togglePasswordButton = document.querySelector('.btn_password');
const passwordInput = document.getElementById('password');

togglePasswordButton.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.textContent = type === 'password' ? 'afficher' : 'masquer';
});

const togglePasswordButton1 = document.querySelector('.btn_conf_password');
const passwordInput1 = document.getElementById('conf_password');

togglePasswordButton1.addEventListener('click', function() {
    const type = passwordInput1.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput1.setAttribute('type', type);
    this.textContent = type === 'password' ? 'afficher' : 'masquer';
});