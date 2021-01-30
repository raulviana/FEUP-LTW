<?php

include_once('includes/session.php');
include_once('database/connection.php');
include_once('database/proposal.php');

$proposal_id = $_POST['proposalID'];

try{
    acceptProposal($proposal_id);
    $_SESSION['success_messages'][] = "Proposal accepted!";
    $_SESSION['print'] = 'success';
}
catch(PDOException $e){
    $e->getMessage();
    $_SESSION['error_messages'][] = "Failed to accept proposal!";
    $_SESSION['print'] = 'error';
    $return_array[] = array('error' => $e);

    echo json_encode($return_array);
}

$return_array[] = array('proposal_id' => $proposal_id);

echo json_encode($return_array);

?>