<!doctype html>
<html lang="en">
  <head>
    <title>Order Confirmation mail</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 m-auto">
                <h3> Order Confirmation Mail </h3>
                <p> Hey, {{$details['first_name']}} </p>
                <p> Your order is successfully recevied </p>
                <p> This is a basic demo for sending email in Laravel 8 using Gmail SMTP </p>
                <br/>
                <br/>
                <p> Best Regards</p>
                <p> Team, H-Shopping </p>
            </div>
        </div>
    </div>
  </body>
</html>