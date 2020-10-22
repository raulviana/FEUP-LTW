
<?php
    
    echo '<form id="edit-form" action="edit_action.php" method="get">';
    echo '<label> Title: <input type="text" name="title">';
    echo '</label>';
    echo '<label> Introduction: <input type="textarea" name="introduction">';
    echo '</label>';
    echo '<label> FullText: <input type="textarea" name="fulltext">';
    echo '</label>';
    echo '<label>';
    echo '<input type="submit" id="edit_btn" value=' . $_GET['id'] . '>'; 

    echo "</form>";

?>