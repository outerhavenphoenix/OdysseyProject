<?php
    $ServerKey = "hfsa8a9sfhASDQHSAOIHFHRHAWSRSNFFHSs81142424";
    $APIKey = $_GET["key"];
       
    if($APIKey == $ServerKey){
        $Connection = new mysqli("localhost","OdysseyAPI","3J2IqV+wLj?A", "Odyssey");

    if(mysqli_connect_errno())
    {
        echo('{"Status":"'. mysqli_connect_errno . '"}');
    }else {
        $UsersResult = $Connection->query("SELECT * FROM Users");
        $GroupsResult = $Connection->query("SELECT * FROM Groups");
        $BannedResult = $Connection->query("SELECT * FROM Banned");
        
        echo("{");
                    
        if($UsersResult->num_rows > 0)
        {
            $First = true;
            while($Row = $UsersResult->fetch_assoc()){
                if($Row != null){
                    if($First == true)
                    {
                        $First = false;
                    }else {
                        echo(',');
                    }
                    $User -> UserID = $Row["UserID"];
                    $User -> Username = $Row["Username"];
                    $User -> Status = $Row["Status"];
                    
                    if($Row["Suspended"] == "True")
                    {
                        $User -> Suspended = true;
                    }else {
                        $User -> Suspended = false;
                    };

                    $User -> Role = $Row["Role"];
                    $User -> Agent = $Row["Agent"];

                    if($Row["Bypass"] == "True")
                    {
                        $User -> Bypass = true;
                    }else {
                        $User -> Bypass = false;
                    };

                    echo('"' . $Row["UserID"]. '":' . json_encode($User));
                }
            };
        };

        if($GroupsResult->num_rows > 0)
        {  
            while($Row = $GroupsResult->fetch_assoc()){
                if($Row != null){
                    echo(',');

                    $Group -> GroupID = $Row["GroupID"];
                    $Group -> GroupName = $Row["GroupName"];
                    $Group -> Status = $Row["Status"];
                    $Group -> Agent = $Row["Agent"];
                    $Group -> Reason = $Row["Reason"];

                    echo('"' . $Row["GroupID"]. '":' . json_encode($Group));
                }
            };
        };

        if($BannedResult->num_rows > 0)
        {  
            while($Row = $BannedResult->fetch_assoc()){
                if($Row != null){
                    echo(',');
                    
                    $Ban -> UserID = $Row["UserID"];
                    $Ban -> Username = $Row["Username"];
                    
                    if($Row["Status"] == "True")
                    {
                        $Ban -> Status = true;
                    }else {
                        $Ban -> Status = false;
                    };

                    $Ban -> Agent = $Row["Agent"];
                    $Ban -> Reason = $Row["Reason"];
                    $Ban -> Comment = $Row["Comment"];

                    if($Row["Appeal"] == "True")
                    {
                        $Ban -> Appeal = true;
                    }else {
                        $Ban -> Appeal = false;
                    };

                    echo('"' . $Row["UserID"] . '":' . json_encode($Ban));
                }
            };
        };
        
        echo('}');

        };
    }else {
        echo('{"Status":"API KEY"}');
    };
?>