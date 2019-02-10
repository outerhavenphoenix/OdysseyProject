<?php
    $ServerKey = "afsdgsdfhgergdsfhserhdfhh4e5h44hhtdhh35hdf";
    $JSONInput = file_get_contents("php://input");
    $PostData = json_decode($JSONInput, true);
    
    if($PostData != null) {
        if($ServerKey == $PostData["Key"]){
            $Connection = new mysqli("localhost","OdysseyAPI","3J2IqV+wLj?A", "Odyssey");

            if(mysqli_connect_errno())
            {
                echo('{"Status":"'. mysqli_connect_errno . '"}');
            }else {
                if($PostData["Table"] != null) {
                    $Table = $PostData["Table"];
                    if($Table["UserID"] != null and $Table["Username"] != null and $Table["Agent"] != null and $Table["Reason"] != null and $Table["Comment"] != null and $Table["Appeal"] != null ) {
                        $UserID = $Table["UserID"];
                        $Username = $Table["Username"];
                        $Status = "True";
                        $Agent = $Table["Agent"];
                        $Reason = $Table["Reason"];
                        $Comment = $Table["Comment"];

                        if($Table["Appeal"] == "true")
                        {
                            $Appeal = "True";
                        }else {
                            $Appeal = "False";
                        };

                        $Connection->query("INSERT INTO Banned (UserID,Username,Status,Agent,Reason,Comment,Appeal) VALUES ('$UserID','$Username','$Status','$Agent','$Reason','$Comment','$Appeal')");

                        echo('{"Status":"SUCCESS"}');
                        $ToData -> content = "Ban://\nUserID: " . $UserID . "\nUsername: " . $Username . "\nAgent: " . $Agent . "\nReason: ". $Reason . "\nComment: " . $Comment;
                            
                        $Curl = curl_init("https://discordapp.com/api/webhooks/534880052282654720/dDer-mw_xzoxWsbjUB8Rug1dYqFMN70SjFJz1KgXMdvaMwjqLGSMky_oGOtsZQOWW5ab");
                        curl_setopt($Curl, CURLOPT_POST, true);
                        curl_setopt($Curl, CURLOPT_POSTFIELDS, json_encode($ToData));
                        curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);

                        curl_exec($Curl);

                    }else {
                        echo('{"Status":"PARAMETERS"}');
                    };
                }else {
                    echo('"Status":"NO TABLE"');
                };
            };
        }else {
            echo('{"Status":"API KEY"}');
        };
    }else {
        echo('{"Status":"PARSE"}');
    };
?>