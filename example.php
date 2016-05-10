<?php
require 'openid.php';
try {
    ### Must provide the identiy and endpoint resources.
    $openid = new LightOpenID(['permitted.identy' => 'http://steamcommunity.com/', 'permitted.endpoint' => 'https://steamcommunity.com/']);
        
    if(!$openid->mode) {
        if(isset($_POST['openid_identifier'])) {
            $openid->identity = $_POST['openid_identifier'];
            header('Location: ' . $openid->authUrl());
        }
?>
<form action="" method="post">
    OpenID: <input type="text" name="openid_identifier" /> <button>Submit</button>
</form>
<?php
    } elseif($openid->mode == 'cancel') {
        echo 'User has canceled authentication!';
    } else {
        echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}
