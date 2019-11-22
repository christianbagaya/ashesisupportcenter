//the javascript code for email validation. Our system is limited to only ashesi emails
function ValidateEmail(inputText) {
    var mailformat = /\w+@ashesi\.edu\.gh/;

    if (inputText.value.match(mailformat)) {
        return true;
    }
    else {
        alert("You have entered an invalid email address, use your ashesi email!");

        return false;
    }
}

function callValidator() {

    inputText = document.querySelector('#exampleInputEmail1');

    return ValidateEmail(inputText);
}
