<!DOCTYPE html>
<html lang="en">
<head>
  <title>LED Controller</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style>
    body {
      font-family: 'Ubuntu', sans-serif;
    }
    .alert {
      border: none;
    }
    .red {
      background: rgb(0,0,0);
      background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(255,0,0,1) 100%);
    }
    .green {
      background: rgb(0,0,0);
      background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,255,0,1) 100%);
    }
    .blue {
      background: rgb(0,0,0);
      background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,255,1) 100%);
    }
  </style>
</head>
<body>
  <div class="content p-2">
    <div class="row">
      <div class="col-sm-12 mt-5 text-center">
        <h2>Arduino HTTP Server Tutorial</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-4 col-sm-12 mt-4">
        <div class="card">
          <div class="card-header">
            <h3>Controller</h3>
          </div>
          <div class="card-body">
            <div class="form-group mb-5">
              <div class="alert red"></div>
              <input type="range" class="form-control-range cnt" rel="r" min="0" max="255" value="0">
            </div>
            <div class="form-group mb-5">
              <div class="alert green"></div>
              <input type="range" class="form-control-range cnt" rel="g" min="0" max="255" value="0">
            </div>
            <div class="form-group">
              <div class="alert blue"></div>
              <input type="range" class="form-control-range cnt" rel="b" min="0" max="255" value="0">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var red = blue = green = 255;

      $('.cnt').change(function(e) {
        e.preventDefault();

        var col = $(this).attr('rel');
        var val = $(this).val();

        switch (col) {
          case 'r':
          red = 255 - val;
          break;
          case 'g':
          green = 255 - val;
          break;
          case 'b':
          blue = 255 - val;
          break;
          default:
          break;
        }
        
        $.post('control.php', {red: red, green: green, blue: blue}, function(response) { });
      });
    });
  </script>
</body>
</html>