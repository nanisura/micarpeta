<h1 class="page-header">Daftar Survey</h1>
<?php
$this_day = date("d");
$sql = "SELECT*FROM data_absen NATURAL LEFT JOIN tanggal WHERE nama_tgl='$this_day' AND id_user='$_SESSION[id]'";
$query_tday = $conn->query($sql);

echo "<div class='table-responsive'>
           <table class='table table-striped'>
            <thead>
               <tr>
                <th>No</th>
                <th>Status</th>
                <th>Action</th>
               </tr>
            </thead>
            <tbody>";


// ==========================================
    require_once 'jsonRPCClient.php';
 
    define( 'LS_BASEURL', 'https://survey.stsn-nci.ac.id/index.php/admin/remotecontrol');
    define( 'LS_USER', 'kelompok6' );
    define( 'LS_PASSWORD', 'kelompokenamemangkeren' );
 
 
    // Instantiate a new RPC client
    
    $myJSONRPCClient = new \org\jsonrpcphp\jsonRPCClient(LS_BASEURL);
 
    // Get a session key
    $sSessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );
 
    if(is_array($sSessionKey)) { // Invalid session
        echo $sSessionKey['status'];
    }
    else if($sSessionKey) { // Valid session
 
           $surveys=$myJSONRPCClient->list_surveys($sSessionKey,null);

    $namaSurvey = array_column($surveys, 'surveyls_title');
    $ids = array_column($surveys, 'sid');
    
    
                $i=0;
                $no=1;
foreach ($namaSurvey as $val)
{   
   echo "<tr>
            <td>$no</td>
            <td>$val</td>
            <td><button type='button' class='btn btn-success' onclick=\"window.location.href='detailSurvey&id_survey=$ids[$i]';\" >Lihat Survey</button></td>  
        </td></tr>";
    $i++;
    $no++;
}


    }


    // Release the session key
    $myJSONRPCClient->release_session_key( $sSessionKey );
                           ?>

<!-- ======================================= -->