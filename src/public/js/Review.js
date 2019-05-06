
function voteButton(button)
{
    var commentID = button.id.split("_")[1];
    var type =  button.id.split("_")[0];


    if(button.classList.contains("VoteSelected"))
    {
        button.classList.remove("VoteSelected");
        //remove vote
    }
    else
    {
        button.classList.add("VoteSelected");
        //check if already voted
        var oposingButton;
        if(type == "up")
        {
            oposingButton = document.getElementById("down_" + commentID);
        }
        else
        {
            oposingButton = document.getElementById("up_" + commentID);
        }

        if(oposingButton.classList.contains("VoteSelected"))
        {
            oposingButton.classList.remove("VoteSelected");
        }
        //add/change vote
    }

}