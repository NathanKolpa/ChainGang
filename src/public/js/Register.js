function verified()
{
    var ww1 = document.getElementById("password");
    var ww2 = document.getElementById("passwordVerified");

    var email1 = document.getElementById("email");
    var email2 = document.getElementById("emailVerified");

    if(ww1.value == ww2.value && email1.value == email2.value)
    {
        return true;
    }
    else
    {
        alert("Wachtwoord of Email zijn niet hetzelfde")
        return false;
    }


}