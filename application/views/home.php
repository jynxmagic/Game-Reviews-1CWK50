<html>
<head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Link CSS -->


<title><?php echo $title?></title>
    <!-- These classes onlywork if you attach Bootstrap. -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <!-- Add your code here to create a nav bar -->
      <!-- You can use code from your previous assignment -->
  </nav>
</head>

<?php
// Manipulate the body CSS colour here.
?>

<div class="container">
    <div class="row">
        <?php
        foreach ($result as $row)
        {
            // These classes onlywork if you attach Bootstrap.
            echo '<div class="card cardBodyWidth '.$cssBodyClass.'">';
            // This is presuming you have a column in your database table called ReviewImage.
            $thisImage = $row->ReviewImage;
            // Look into the image properties library in CodeIgniter for more help on images: 
            
        }
        ?>
    </div>
</div>
</body>

<!-- This section needs editing to create the chat system using HTML -->
<button id="chatButton" class="open-button btn btn-success" onclick="openForm()">Chat</button>
<div class="chat-popup pull-right" id="myForm">
<form id="myform" class="form-container">
</form>
</div>

<!-- Load in the required scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Don't forget to load in Vue abd socket.io -->





<!-- Load in your custom scripts -->

</html>