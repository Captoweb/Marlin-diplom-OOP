function validate() {
    let removeHidden = document.querySelector('.hidden');
    let emailInput = document.querySelector('#email');
    let passwordInput = document.querySelector('#password');
    let message1 = document.querySelector('.mess');
    let message2 = document.querySelector('.mess2');

    if(!emailInput.value) {
        emailInput.style.border = "3px solid #f7adb3";
        message1.innerHTML  = "Email is required";
        removeHidden.classList.remove('hidden');
        return false;
    }

    if(!passwordInput.value) {
        passwordInput.style.border = "3px solid #f7adb3";
        message2.innerHTML = "Password is required";
        removeHidden.classList.remove('hidden');
        return false;
    }
    return true;
}


// onsubmit = "return validate();
