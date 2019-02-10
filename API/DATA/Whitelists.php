<?php
    $Connection = new mysqli("localhost","OdysseyAPI","3J2IqV+wLj?A", "Odyssey");

    if(mysqli_connect_errno())
    {
        echo('{"Status":"'. mysqli_connect_errno . '"}');
    }else {
        $WhitelistResult = $Connection->query("SELECT * FROM Whitelist");
        
        echo("{");
                    
        if($WhitelistResult->num_rows > 0)
        {
            $First = true;
            while($Row = $WhitelistResult->fetch_assoc()){
                if($Row != null){
                    if($First == true)
                    {
                        $First = false;
                    }else {
                        echo(',');
                    };

                    echo('"' . $Row["PlaceID"]. '":' . $Row["PlaceID"]);
                }
            };
        };

        echo("}");
    };
?>