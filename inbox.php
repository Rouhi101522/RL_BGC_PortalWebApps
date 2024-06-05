<?php 
DEFINE("TITLE", "MESSAGES");
include_once("website/templates/header.php");
?>

<div class="inbox" style="padding: 150px;">
    <div class="container p-0">
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right">
                    <div class="px-4 d-none d-md-block">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control my-3" placeholder="Search...">
                            </div>
                        </div>
                    </div>

                    <?php
                    require 'website\config.php';

                    $stmt = $conn->query('SELECT * FROM acc_inf');
                    $users = $stmt->fetchAll();
                    
                    foreach ($users as $person_inf) {
                        echo '<a href="#" class="list-group-item list-group-item-action border-0">';
                        echo '    <div class="d-flex align-items-start">';
                        echo '        <img src="' . $user['profileImg'] . '" class="rounded-circle mr-1" alt="" width="40" height="40">';
                        echo '        <div class="flex-grow-1 ml-3">';
                        echo '            ' . $user['fname'] . '';
                        echo '            <div class="small"><span class="fas fa-circle chat-' . $user['status'] . '"></span> ' . ucfirst($user['status']) . '</div>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</a>';
                    }
                    ?>
                    
                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                <div class="col-12 col-lg-7 col-xl-9">
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-center py-1">
                            <div class="position-relative">
                                <img src="" class="rounded-circle mr-1" alt="" width="40" height="40">
                            </div>
                            <div class="flex-grow-1 pl-3">
                                <strong>ADMIN</strong>
                                <div class="text-muted small"><em>TEXT PLACEHOLDER</em></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="position-relative">
                        <div class="chat-messages p-4">
                            <?php include 'fetch_messages.php'; ?>
                        </div>
                    </div>
                    
                    <div class="flex-grow-0 py-3 px-4 border-top">
                        <form method="post" action="send_message.php">
                            <div class="input-group">
                                <input type="text" class="form-control" name="message" placeholder="Type your message">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include_once("website/templates/footer.php");

require 'website\config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = 1; // Replace with dynamic user id
    $message = $_POST['message'];

    $stmt = $pdo->prepare('INSERT INTO messages (user_id, message) VALUES (?, ?)');
    $stmt->execute([$user_id, $message]);

    header('Location: index.php');
}
?>
