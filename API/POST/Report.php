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
                    if($Table["PlaceID"] != null and $Table["PlaceName"] != null and $Table["Type"] != null and $Table["Reason"] != null and $Table["Comment"] != null) {
                        $PlaceID = $Table["PlaceID"];
                        $PlaceName = $Table["PlaceName"];
                        $Type = $Table["Type"];
                        $Reason = $Table["Reason"];
                        $Comment = $Table["Comment"];

                        $Connection->query("INSERT INTO Reports (PlaceID,PlaceName,Type,Reason,Comment) VALUES ('$PlaceID','$PlaceName','$Type','$Reason','$Comment')");

                        echo('{"Status":"SUCCESS"}');

                        $ToData -> content = "Report://\nPlaceID: " . $PlaceID . "\nPlaceName: " . $PlaceName . "\nType: ". $Type . "\nReason: ". $Reason ."\nComment: " . $Comment;
                            
                        $Curl = curl_init("https://discordapp.com/api/webhooks/536635028441137152/eluX1_huC9cAY-xmzwnfjYn8agvsqDSaBhc-KYS9ZsGKt_0BcjirHAUMPcM7Yfkvmb4T");
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

            $ToData -> content = "Report://\nType: API Key Incorrect!\nReport.php";
                            
            $Curl = curl_init("https://discordapp.com/api/webhooks/516830585424052245/HWm5_Jn8NUg8EQX4LkUvoJejESJq6YUU33cdmEPYQEfC8cuequeSD8xPQrOsn_9eB-Gm");
            curl_setopt($Curl, CURLOPT_POST, true);
            curl_setopt($Curl, CURLOPT_POSTFIELDS, json_encode($ToData));
            curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);

            curl_exec($Curl);
        };
    }else {
        echo('{"Status":"PARSE"}');
    };
?>