function vote(commentID, isUp)
{

}

function removeVote(commentID)
{

}

function changeVoteText(commentID, delta)
{
    var element = document.getElementById("count_" + commentID);
    var text = "";

    if(parseInt(element.innerText) + delta > 0)
    {
        //text += "+"; weet niet zeker of dit nodig is
    }

    text += parseInt(element.innerText) + delta;
    element.innerText = text;
}


function voteButton(button)
{

    var commentID = button.id.split("_")[1];
    var type =  button.id.split("_")[0];


    if(button.classList.contains("VoteSelected"))
    {
        button.classList.remove("VoteSelected");
        if(type == "up")
        {
            changeVoteText(commentID, -1);
        }
        else
        {
            changeVoteText(commentID, 1);
        }
        //remove vote
        removeVote(parseInt(commentID));
    }
    else
    {
        button.classList.add("VoteSelected");
        //check if already voted
        var oposingButton;
        if(type == "up")
        {
            oposingButton = document.getElementById("down_" + commentID);
            changeVoteText(commentID, 1);
        }
        else
        {
            oposingButton = document.getElementById("up_" + commentID);
            changeVoteText(commentID, -1);
        }

        if(oposingButton.classList.contains("VoteSelected"))
        {
            oposingButton.classList.remove("VoteSelected");

            if(type == "up")
            {
                changeVoteText(commentID, 1);
            }
            else
            {
                changeVoteText(commentID, -1);
            }
        }
        //add/change vote
        vote(parseInt(commentID), type == "up" ? true : false);
    }
}