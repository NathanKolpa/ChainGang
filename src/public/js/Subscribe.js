
function kaas()
{
    /*var mail = document.getElementById("InputSubcribeEmail");
    $.ajax
    ({
        url: '__REST__', //This is the current doc
        type: "POST",
        dataType:'json', // add json datatype to get json
        data:
            ({
                // deze request_type: "vote", wordt als case gebruikt in restcontroller
                request_type: "kaas",
                email: mail.value
                //is_up: isUp
            }),
        success: function(data)
        {
            console.log(data);
            console.log("succes");
        },
        fail: function(xhr, textStatus, errorThrown){
            console.log("Fail: " + errorThrown)
        }
    });*/

    $('form.ajax').on('submit', function () {
        var that = $(this),
            url = '__REST__',
            type = that.attr('method'),
            data = {
                request_type: "sub"
            };

        that.find('[name]').each(function(index, value) {
            var that = $(this),
                name = that.attr('name'),
                value = that.val();

            data[name] = value;
        });

        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function (response) {
                alert("sucsess!");
            }
        });

        return false;
    });
    console.log("methode ziet die");
}


