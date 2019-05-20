<?php

function voegToe()
{
    // maakt de foto transparante zo dat je kunt zien dat het in de winkelwagen ligt
    echo "<style> #foto{ opacity: 0.5%; fill-rule: alpha(opacity=50) } </style>";

}
    if(isset($_POST['veranderFoto'])){
        voegToe();
    }

?>