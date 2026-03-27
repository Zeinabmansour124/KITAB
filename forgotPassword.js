const email=document.getElementById('email');
const submitBtn=document.getElementById('submit-btn');

function envoyerEmailReset(emailValue) {
    // Logique pour envoyer l'email de réinitialisation
}


email.addEventListener('input', function() {    
    const emailValue = email.value;
    if (!(emailValue.includes('@') && !(emailValue.includes('.')) && !(/*valid email*/ )) { 
        email.setCustomValidity('Please enter a valid email address.');
    } else {
        email.setCustomValidity('');
        envoyerEmailReset(emailValue);
    }   
});