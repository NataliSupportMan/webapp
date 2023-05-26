<?php
// Check if the draft parameter is set in the URL
if (isset($_GET['search_change_draft'])) {
    try {
        // Sanitize the input to prevent SQL injections
        $search_change_draft = filter_var($_GET['search_change_draft'], FILTER_SANITIZE_NUMBER_INT);

        // Prepare the UPDATE statement using a prepared statement
        $stmt = $cms_pdo->prepare("UPDATE posts SET post_status = 'draft' WHERE post_id = ?");

        // Bind the parameter to the prepared statement
        $stmt->bindParam(1, $search_change_draft, PDO::PARAM_INT);

        // Execute the prepared statement
        $stmt->execute();

        // Fetch and display the updated post
        $sql = "SELECT * FROM posts WHERE post_id = :post_id";
        $stmt = $cms_pdo->prepare($sql);
        $stmt->bindParam(':post_id', $search_change_draft, PDO::PARAM_INT);
        $stmt->execute();
        $post_draft = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<tr>";
        echo "<td>{$post_draft['post_id']}</td>";
        echo "<td>{$post_draft['post_head']}</td>";
        echo "<td>{$post_draft['post_author']}</td>";
        echo "<td><a href='../post.php?get_posts_id={$post_draft['post_id']}'>{$post_draft['post_title']}</a></td>";
        $categories = get_post_with_category_title($cms_pdo);
        foreach ($categories as $category) {
            if ($category['cat_id'] == $post_draft['post_category_id']) {
                $cat_title = $category['cat_title'];
                break;
            }
        }
        echo "<td>{$cat_title}</td>";
        echo "<td>{$post_draft['post_status']}</td>";
        echo "<td><img src='./admin_upload_images/{$post_draft['post_image']}' width='50px' height='30px' alt='image'></td>";
        echo "<td>{$post_draft['post_tags']}</td>";
        echo "<td><a href='./admin_comments.php?get_posts_id={$post_draft['post_comment_count']}' class='btn btn-outline-info bg-info'>{$post_draft['post_comment_count']}</a></td>";
        echo "<td>{$post_draft['post_date']}</td>";
        echo "<td>{$post_draft['post_content']}</td>";
        echo "<td>{$post_draft['post_views_count']}</td>";
        echo "<td><a href='../post.php?get_posts_id={$post_draft['post_id']}' class='btn btn-outline-info bg-info'>View Post</a></td>";
        echo "<td><a href='./admin_search_posts.php?search_change_published={$post_draft['post_id']}' class='btn btn-outline-success bg-success' onclick=\"return confirm('Are you sure you want to publish the \'{$post_draft['post_head']}\' post ?')\">Published</a></td>";
        echo "<td><a href='./admin_search_posts.php?search_change_draft={$post_draft['post_id']}' class='btn btn-outline-primary bg-primary' onclick=\"return confirm('Are you sure you want to draft the \'{$post_draft['post_head']}\' post ?')\">Draft</a></td>";
        echo "<td><a href='./admin_search_posts.php?search_delete={$post_draft['post_id']}' class='btn btn-outline-danger bg-danger' onclick=\"return confirm('Are you sure you want to delete the \'{$post_draft['post_head']}\' post ?')\">Delete</a></td>";
        echo "<td><a href='./admin_posts.php?source=edit_posts&id_posts={$post_draft['post_id']}' class='btn btn-outline-warning bg-warning'>Edit</a></td>";
        echo "<tr>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
}
?>
