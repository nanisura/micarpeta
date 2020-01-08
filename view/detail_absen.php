<?php
	if (isset($_SESSION['sw'])) {
		// $sql = "SELECT*FROM detail_user WHERE id_user='$_SESSION[id]'";
		// $query = $conn->query($sql);
		// $get_user=$query->fetch_assoc();
		// $name = $get_user['name_user'];


if(isset($_GET['id_survey']))
    {
    $iSurveyID = $_GET["id_survey"];
	echo "<h1 class='page-header'>Daftar Pengisi Survey $iSurveyID </h1>";
 
    // echo "<div class='table-responsive'>
    //            <table class='table table-striped'>
    //             <thead>
    //                <tr>
    //                 <th>Id</th>
    //                 <th>Token</th>
    //                 <th>Tanggal Pengisian</th>
    //                 <th>Bahasa</th>
    //                </tr>
    //             </thead>
    //             <tbody>";
// ========================================================================================================
    require_once 'jsonRPCClient.php';
    define( 'LS_BASEURL', 'https://survey.stsn-nci.ac.id/index.php/admin/remotecontrol');
    define( 'LS_USER', 'kelompok6' );
    define( 'LS_PASSWORD', 'kelompokenamemangkeren' );
 
    // $iSurveyID = 848579;
    // echo($iSurveyID);
    // Instantiate a new RPC client
    
    $myJSONRPCClient = new \org\jsonrpcphp\jsonRPCClient(LS_BASEURL);
 
    // Get a session key
    $sSessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );
 
    if(is_array($sSessionKey)) { // Invalid session
        echo $sSessionKey['status'];
    }
    else if($sSessionKey) { // Valid session
 
        $surveyResponses = $myJSONRPCClient->export_responses($sSessionKey, $iSurveyID, 'json', null, 'completed', 'code', 'short', null, null, ['id','token','submitdate','startlanguage']);
 		
        if(is_array($surveyResponses)) {
            // Oops, print any errors
            print_r($surveyResponses);
        }
        else {
            // Decode the retuned base-64 string and convert to an array
            $decodedString = base64_decode($surveyResponses);
            $aResponses = json_decode($decodedString, True);
 
            // Find the first response ID               
            $aFirstResponse = reset($aResponses['responses'][24]);
 
            echo '<table style="border-collapse: collapse; text-align: left;">';        
                echo '<tr>';                
                    // Insert column headers
                    foreach($aFirstResponse as $key => $value) {
                        echo '<th style="border: 1px solid #CCC; padding: 2px 7px;">'.$key .'</th>';
                    }
                echo '</tr>';
                foreach($aResponses['responses'] as $key => $row) {
                    echo '<tr>';
                        // Insert the data
                        foreach(reset($row) as $key => $item) {
                            echo '<td style="border: 1px solid #CCC; padding: 2px 7px;">'.$item .'</td>';
                        }
                    echo '</tr>';
                }
            echo '</table>';


            
             	// $ids = array_column($aResponses, null);
            	// $i =0;
             // 	$idnya = array_column($aResponses['responses'][1],'id');
             // 	$tokennya = array_column($aResponses['responses'][24], 'token');
             // 	$tanggalnya = array_column($aResponses['responses'], 'submitdate');
             // 	$bahasanya = array_column($aResponses['responses'][0], 'startlanguage');
            	// // print_r($bahasanya);
             //     // header("Content-type: application/json");

             //         // print_r ($tokennya);
    			  
             //    foreach ($aFirstResponse as $val)
             //    {                   
             //         echo "<tr>
             //                 <td>$val</td>
             //              </tr>";

             //    }



        }

    }
    
    // Release the session key
    $myJSONRPCClient->release_session_key( $sSessionKey );
 // =================================================================================================================	
    }
 else{
 	echo "<div class='alert alert-warning'><strong>Tidak ada Absensi untuk ditampilkan.</strong></div>";	
 }

			
	} else {
		echo "<h1 class='page-header'>Welcome Admin</h1>";

	}

?>


        