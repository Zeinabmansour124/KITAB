const email = document.getElementById('email');
const password = document.getElementById('password');
const username = document.getElementById('username');
let emailValid = false;
let passwordValid = false;
let usernameValid = false;

//verifier la validité de l'email
email.addEventListener('input', function () {
    const emailValue = email.value;
    if (!(emailValue.includes('@') && !emailValue.includes('.'))) {
        email.setCustomValidity('Please enter a valid email address.');
    } else {
        email.setCustomValidity('');
        emailValid = true;
    }

});


//verifier la validité du nom d'utilisateur
username.addEventListener('input', function () {
    const usernameValue = username.value;
}
);

//verifier la force du mot de passe
password.addEventListener('input', function () {
    const passwordValue = password.value;

});

if (emailValid && passwordValid && usernameValid) {
    globalThis.location.href = 'compte.html';
}
