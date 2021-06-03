<?php

if(isset($_POST['sbmReq'])){

    $ch = curl_init("http://sosmeeed.herokuapp.com:80/api/instagram/profile");
    $data = array(
        "username" => $_POST['inputReq'],
    );
    $string = http_build_query($data);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if($result['success']==1 && empty($result['message'])){
        ?>
        <p>
            Data Profile User Instagram
        </p>
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><?=$result['data']['username']?></td>
            </tr>
            <tr>
                <td>Fullname</td>
                <td>:</td>
                <td><?=$result['data']['fullname']?></td>
            </tr>
            <tr>
                <td>Followers</td>
                <td>:</td>
                <td><?=$result['data']['followers']?></td>
            </tr>
            <tr>
                <td>Following</td>
                <td>:</td>
                <td><?=$result['data']['followings']?></td>
            </tr>
        </table>


        <?php
    } else {
        ?>
        <p>
            <?= $result['message']?>
        </p>
        <?php
    }

} else {
    echo "Server script request page";
}



?>