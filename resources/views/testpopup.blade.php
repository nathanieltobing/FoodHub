<html>
  <head>
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <link
     href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'
      rel="stylesheet"
    />
    <link href="./style.css" rel="stylesheet" />
    <title>popup2</title>
  </head>
  <body>
    <a href="#" class="submit-button" id="error_trigger">Add to Cart</a>
    <div class="popups" id="error">
      <div class="popup-content">
        <div class="imgbox">
          <img src="{{ asset('assets/images/cancel.png') }}" alt="" class="img">
        </div>
        <p class="para">YOU CAN'T ADD PRODUCTS FROM TWO DIFFERENT VENDORS</p>
        <form action="">
          <a href="#" class="buttons" id="e_button">EXIT</a>
        </form>
      </div>
    </div>
    <script src="{{ asset('assets/popup.js') }}"></script>
  </body>

</html>
