<?php


if(isset($_POST['number'])){

    $numbers = $_POST['number'];
    $networks = $_POST['network'];
    $amounts = $_POST['amount'];
    $out = '';

    $url = 'https://sandbox.wallets.africa/bills/airtime/purchase';
    $secretKey = 'hfucj5jatq8h';
    $publicKey = 'uvjqzm5xl6bw';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $publicKey
    ));

    curl_setopt($ch, CURLOPT_URL, $url);


    foreach($numbers as $key => $number){

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'PhoneNumber' => $number,
            'Amount' => $amounts[$key],
            'Code' => $networks[$key],
            'SecretKey' => $secretKey
        ]));

        $output = curl_exec($ch);

        $out .= "<div class='container'>
        <div class='alert alert-success bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>".$number  ." - ". json_decode($output)->Message."</strong>
        </div>
      </div>";

    }

    curl_close($ch);


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HNG Top Up App</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
    <link rel='stylesheet' type='text/css' href='bootstrap/css/bootstrap-theme.min.css'>
    <link rel='stylesheet' type='text/css' href='bootstrap/css/bootstrap.min.css'>
</head>
<body style='background-color:cadetblue;'>
    <nav>
        <div class="container">
        <img src='images/hng-logo.png' style='height:100px;margin-top:20px;'>
        <span class='h3' style="font-family:'Georgia', 'Times New Roman', 'Times', 'serif'">HNG TECH</span>
        </div>
    </nav>
    <div class="container">
        <h2>Send airtime topup</h2>

        <?php if(isset($out)){
            echo $out;
        } ?>

        <form action="" id="cut" method="POST">


    <table class='table table-bordered'>
        <tbody>

            <tr>
                <th>Number</th>
                <th>Amount</th>
                <th>Network</th>
            </tr>

            <tr>
                <td><input type="text" name="number[]"></td>
                <td><input type="text" name="amount[]"></td>
                <td> <select class="mt-5 pl-3" name="network[]">
                        <option value="null">Select Network</option>
                        <option value="glo">GLO</option>
                        <option value="mtn">MTN</option>
                        <option value="airtel">AIRTEL</option>
                        <option value="9mobile">9MOBILE</option>
                    </select></td>
            </tr>

        </tbody>

    </table>
        </form>

        <a class="btn btn-primary" id="added">ADD INTERN</a>
        <br>
    <br>
    <button class='btn btn-success' onclick="document.getElementById('cut').submit()">SEND AIRTIME TO ALL SELECTED INTERNS</button><hr>

</div>
    
</body>
<script src="/bootstrap/js/jquery-3.4.1.min.js"></script>

<script>
    $(document).ready(function(){
       $('#added').click(function(e){
           let text = ` <tr>
                    <td><input type="text" name="number[]"></td>
                    <td><input type="text" name="amount[]"></td>
                    <td> <select class="mt-5 pl-3" name="network[]">
                            <option value="null">Select Network</option>
                            <option value="glo">GLO</option>
                            <option value="mtn">MTN</option>
                            <option value="airtel">AIRTEL</option>
                            <option value="9mobile">9MOBILE</option>
                        </select></td>
                </tr>`;

           e.preventDefault();
           $('tbody').append(text);
        }) ;
    });
</script>
</html>