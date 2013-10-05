<!DOCTYPE html>
<html>
<head>
  <title>Mini Information Retrieval</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet" media="screen">
  <link href="css/custom.css" rel="stylesheet" media="screen">

</head>
<body>
  <div class="container">
    <div class="text-center brandName"> 
      <h1><b>Mini</b>IR</h1>
      <div class="row">
        <div class="span12">
          <form method="get" action="results.php" class="form-inline" >
            <input name="salary" class="span5 mainIn" type="text"  placeholder="Search" >
            <button type="submit" class="btn btn-cstm mainIn" value="Go!"> <i class="icon-search icon-white"></i> Go!</button>
          </form>
        </div>
      </div>
    </div>

  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
  $( document ).ready(function() {
    var images = ['.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg'];
    $('body').css({'background-image': 'url(img/background' + images[Math.floor(Math.random() * images.length)] + ')'});
  });
  </script>
</body>
</html>