const userName = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirm-password');
const country = document.getElementById('country');
const submitBtn = document.getElementById('submit-btn');

userName.addEventListener('input', function () {
    const usernameValue = userName.value;
    if ((usernameValue.length < 3) || (usernameValue.length > 20) || !/^[a-zA-Z0-9_]+$/.test(usernameValue)) {
        userName.setCustomValidity('Username must be between 3 and 20 characters and contain only letters, numbers, and underscores.');

    } else {
        userName.setCustomValidity('');
    }
});

email.addEventListener('input', function () {
    const emailValue = email.value;
    if (!(emailValue.includes('@') && emailValue.includes('.') && (emailValue.indexOf('@') < emailValue.lastIndexOf('.')))) {
        email.setCustomValidity('Please enter a valid email address.');
    } else {
        email.setCustomValidity('');
    }
});

password.addEventListener('input', function () {
    const passwordValue = password.value;
    if (passwordValue.length < 8 || !/\d/.test(passwordValue) || !/[A-Z]/.test(passwordValue) || !/[a-z]/.test(passwordValue) || !/[!@#$%^&*(),.?":{}|<>]/.test(passwordValue)) {
        password.setCustomValidity('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.');
    } else {
        password.setCustomValidity('');
    }
});

confirmPassword.addEventListener('input', function () {
    const confirmPasswordValue = confirmPassword.value;
    if (confirmPasswordValue !== password.value) {
        confirmPassword.setCustomValidity('Passwords do not match.');
    } else {
        confirmPassword.setCustomValidity('');
    }
});

async function verifierPays(nomPays) {
    try {
        const response = await fetch(`https://restcountries.com/v3.1/name/${nomPays}?fullText=true`);

        if (response.ok) {
            const data = await response.json();
            console.log("Le pays existe !", data[0].name.common);
            return true;
        } else {
            console.log("Le pays n'existe pas.");
            return false;
        }
    } catch (error) {
        console.error("Erreur lors de la requête :", error);
        return false;
    }
}

country.addEventListener('input', function () {
    const countryValue = country.value;
    verifierPays(countryValue).then(exists => {
        if (!exists) {
            country.setCustomValidity('Please enter a valid country name.');
        } else {
            country.setCustomValidity('');
        }
    });
});
//we are not sure if we will use this or we wil use sth with php code 
/*submitBtn.addEventListener('click', function(event) {
    event.preventDefault(); 
    if (userName.checkValidity() && email.checkValidity() && password.checkValidity() && confirmPassword.checkValidity() && country.checkValidity()) {
        globalThis.location.href ='compte.html';
    }
    
    
}
);*/