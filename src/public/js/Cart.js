function getCookie( name )
{
    var dc,
        prefix,
        begin,
        end;

    dc = document.cookie;
    prefix = name + "=";
    begin = dc.indexOf("; " + prefix);
    end = dc.length; // default to end of the string

    // found, and not in first position
    if (begin !== -1) {
        // exclude the "; "
        begin += 2;
    } else {
        //see if cookie is in first position
        begin = dc.indexOf(prefix);
        // not found at all or found as a portion of another cookie name
        if (begin === -1 || begin !== 0 ) return null;
    } 

    // if we find a ";" somewhere after the prefix position then "end" is that position,
    // otherwise it defaults to the end of the string
    if (dc.indexOf(";", begin) !== -1) {
        end = dc.indexOf(";", begin);
    }

    return decodeURI(dc.substring(begin + prefix.length, end) ).replace(/\"/g, ''); 
}

function addToCart(prodId)
{
    if(document.cookie.indexOf('products=') == -1)
    {
        var newArray = [prodId];

        document.cookie = "products=" + JSON.stringify(newArray);
    }
    else
    {
        var arr = eval(getCookie("products"));

        arr.push(prodId);

        document.cookie = "products=" + JSON.stringify(arr);
    }



    console.log(document.cookie);
}

function showCart()
{
    var cartE = document.getElementById("cart");

    $.ajax
    ({
        url: '__REST__', //This is the current doc
        type: "POST",
        dataType:'json', // add json datatype to get json
        data: 
        ({
            request_type: "cartGet",
        }),
        success: function(data)
        {
            cartE.innerHTML = data;
        },
        fail: function(xhr, textStatus, errorThrown){
            console.log("Fail: " + errorThrown)
         }
   }); 
}

function removeFromCart(index)
{
    var arr = eval(getCookie("products"));

    arr.splice(index, 1);

    document.cookie = "products=" + JSON.stringify(arr);
}