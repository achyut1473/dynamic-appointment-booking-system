function validateForm() {
    let name = document.forms["regForm"]["name"].value;
    let email = document.forms["regForm"]["email"].value;
    let password = document.forms["regForm"]["password"].value;

    if (name == "" || email == "" || password == "") {
        alert("All fields are required!");
        return false;
    }
}