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

<!-- This section needs editing to create the chat system using HTML -->
<button id="chatButton" class="open-button btn btn-success" onclick="openForm()">Chat</button>
<div class="chat-popup pull-right" id="myForm">
<form id="myform" class="form-container">
</form>
