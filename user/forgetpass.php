<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register || News Portal</title>
    <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../css/form.css">
    <style type="text/css">
    body {
        width: 100%;
        background: url(down.jpg);
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
    </style>
</head>

<body>
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <center>
                            <h5 style="font-family: Noto Sans;">Register</h5>
                            <h4 style="font-family: Noto Sans;">News Portal!!</h4>
                                <span id="user-status1" style="font-size:12px;"></span>
                        </center><br>
                        <form method="post">
                            <div class="form-group">
                                <label>Enter Your Email Id:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                                <span id="user-status" style="font-size:12px;"></span>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Date Of Birth:</label>
                                <input type="date" id="date"  name="date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Enter New Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block" onclick="checkdata()" id="submit" name="submit">Register</button>
                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">Don't have an account?</span> <a
                                    href="login.php">Login Here</a> Here..
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
function checkdata(){
    cmail = $('#email').val(); 
    date = $('#date').val();
    pass = $('#password').val();
    jQuery.ajax({
        url: "validate.php",
        data: {cmail: cmail, date: date, pass: pass},
        type: "POST",
        success: function(data) {
            $("#user-status1").html(data);
        }
    });
}
</script>
</html>