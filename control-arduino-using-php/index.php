<!DOCTYPE html>
<html lang="en">
<head>
  <title>LED Controller</title>

  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style>
    body {
      font-family: 'Ubuntu', sans-serif;
    }

    .btn-group.cmd-btn {
      display: flex;
    }

    .cmd-btn .btn {
      flex: 1
    }
  </style>
</head>
<body>
  <div class="content p-2">
    <div class="row">
      <div class="col-sm-12 mt-5 text-center">
        <h2>Arduino USB Host Serial Tutorial</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-4 col-sm-12 mt-4">
        <div class="card">
          <div class="card-header">
            <h3>Controller</h3>
          </div>
          <div class="card-body">
            <div class="btn-group cmd-btn mb-4">
              <button type="button" class="btn btn-danger btn-lg p-5" rel="1">RED ON</button>
              <button type="button" class="btn btn-secondary btn-lg p-5" rel="2">RED OFF</button>
            </div>
            <div class="btn-group cmd-btn mb-4">
              <button type="button" class="btn btn-success btn-lg p-5" rel="3">GREEN ON</button>
              <button type="button" class="btn btn-secondary btn-lg p-5" rel="4">GREEN OFF</button>
            </div>
            <div class="btn-group cmd-btn mb-4">
              <button type="button" class="btn btn-primary btn-lg p-5" rel="5">BLUE ON</button>
              <button type="button" class="btn btn-secondary btn-lg p-5" rel="6">BLUE OFF</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.btn').click(function(e) {
        e.preventDefault();

        var code = $(this).attr('rel');
        
        $.post('control.php', {command: code}, function(response) { });
      });
    });
  </script>
</body>
</html>