<?php 
// Check if the delete parameter is set in the URL
if (isset($_GET['un_com_per_post'])) {
    $unique_com_post = $_GET['unique_com_post'];
    try {
        // Sanitize the input to precent SQL injections
        $un_com_per_post =  filter_var($_GET['un_com_per_post'], FILTER_SANITIZE_NUMBER_INT);

        // Prepare the DELETE statemnet using a preared statement
        $stmt = $cms_pdo->prepare("UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = ?");

        // Bind the parameter to the prepared statement
        $stmt->bindParam(1, $un_com_per_post, PDO::PARAM_INT);

        // Execute the prepared statement
        $stmt->execute();

        // Retrieve the post information
        $stmt = $cms_pdo->prepare("SELECT * FROM posts WHERE post_id = ?");
        $stmt->bindParam(1, $unique_com_post, PDO::PARAM_INT);
        $stmt->execute();
        $post_unapp = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set a success message in a session variable
        $_SESSION['success_mess_unapp'] = "The comment from post '{$post_unapp['post_head']}' has been successfully unapproved";

        // Creating a refresh statement to redirect to the same page again with the success message as a query parameter
        header("Location: ./admin_com_per_post.php?unique_com_post=" . $unique_com_post);

        // Execute the prepared statement
        $stmt->execute();

        // Exit the script after redirecting
        exit();

    } catch (PDOException $e) {
        echo "Error can not unapprove this comment: ".$e->getMessage();
    } 
}
// If there is a success message in the session, display it and remove it from the session
if (isset($_SESSION['success_mess_unapp'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success_mess_unapp']}</div>";
    unset($_SESSION['success_mess_unapp']);
} 
?>