function validate()
{
    let password = document.getElementById('password').value;
    let cpassword = document.getElementById('cpassword').value;

    if (password == cpassword )
    {
        return true;
    }
    else
    {
        alert("Your password is not same.");
        return false;
    }
}
