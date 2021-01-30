
<?php
   if(isset($_SESSION['print'])){
    if($_SESSION['print'] === 'error'){
        if( isset($_SESSION['error_messages'])){
        echo '<div class="message-frame frame-error">';
        echo '<center><p class="message error-message">'. end($_SESSION['error_messages']) . '</p></center>';
        }
        unset($_SESSION['print']);
    }
    if($_SESSION['print'] === 'success'){
        if(isset($_SESSION['success_messages'])){
        echo '<div class="message-frame frame-success">';
        echo '<center><p class="message success-message">'. end($_SESSION['success_messages']) . '</p></center>';
        }
        unset($_SESSION['print']);
    }
    echo '</div>';
   }


?>