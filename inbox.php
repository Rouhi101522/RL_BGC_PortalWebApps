    <?php
    ini_set('display_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE);

        session_start();
        include_once("website/templates/header.php");
        include_once("website/config.php");

        if (!isset($_SESSION['auth_user'])) {
            header("location: login.php");
            exit();
        }

        $applicant_ID = $_SESSION['auth_user'];

        
        // Fetch user details
        $stmt = $conn->prepare("SELECT * FROM person_inf WHERE applicant_ID = ?");
        $stmt->execute([$applicant_ID]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data) {
                $applicant_profile = htmlspecialchars($data['applicant_profile']);
                $last_name = htmlspecialchars($data['last_name']);
                $first_name = htmlspecialchars($data['first_name']);
                $middle_name = htmlspecialchars($data['middle_name']);
                $sender = $last_name . ", " . $first_name . " " . $middle_name;
            } else {
                // Handle case where no user data is found
                echo "No user data found.";
                exit();
            }

        try {
        // Fetch messages sent by the user and messages sent to the user
        $stmt = $conn->prepare("SELECT sender, receiver, message, `timestamp` FROM messages WHERE (sender = 'admin' AND receiver = ?) OR (sender = ? AND receiver = 'admin') ORDER BY `timestamp` DESC");
        $stmt->execute([$applicant_ID, $applicant_ID]);
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Inside the existing PHP code, before the closing PHP tag
        if (isset($_POST['send'])) {
            $name = htmlspecialchars($_POST['myname']);
            $receiver_name = htmlspecialchars($_POST['receiver_name']);
            $message = htmlspecialchars($_POST['message']);
            $applicant_ID = $_SESSION['auth_user'];
            

            $sql = $conn->prepare("INSERT INTO messages (user_id, sender, receiver, message) VALUES (?, ?, ?, ?)");
            if ($sql->execute([$applicant_ID, $name, $receiver_name, $message])) {
                echo "Message sent successfully.";
                // Refresh page to display new message
                header("Location: inbox.php");
                exit();
            } else {
                echo "Failed to send message.";
            }
        }

            
            }catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Inbox</title>
            <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
            <script>
                $(document).ready(function() {
                    var $container = $("#messages");
                    $container.load('fetch_message.php');
                    setInterval(function() {
                        $container.load('fetch_message.php');
                    }, 3000);
                });
            </script>
        </head>
        <body>
        <div class="container py-5" style="margin-top:100px">
            <div class="row">
                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                    <h5 class="font-weight-bold mb-3 text-center text-lg-start" style="font-weight: bold; font-size: 18px;">MESSAGE US</h5>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="p-2 border-bottom" style="background-color: #eee; font-size: 15px;">
                                    <a href="#!" class="d-flex justify-content-between">
                                        <div class="d-flex flex-row">
                                            <div class="pt-1">
                                                <p class="fw-bold mb-0">REAL LIFE ADMIN</p>
                                            </div>
                                        </div>
                                        <div class="pt-1"></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-8">
                    <ul class="list-unstyled">
                        <div class="scroll" id="messages" style="overflow-y: scroll; height: 400px;"></div>
                        <li class="bg-white mb-3">
                            <form id="message-form" method="post">
                                <div class="form-outline">
                                    <input id="myName1" name="myname" value="<?php echo $sender; ?> disabled">
                                    <div class="input-group">
                                        <input type="hidden" id="receiver" name="receiver_name" value="admin">
                                        <textarea class="form-control" id="textAreaExample2" rows="2" style="font-size: 15px; text-transform: none;" placeholder="Type your message..." name="message"></textarea>
                                        <button type="submit" name="send" class="btn btn-info btn-rounded float-end">Send</button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <?php include_once("website/templates/footer.php"); ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="jquery.timeago.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                $("time.timeago").timeago();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#message-form').submit(function(event) {
                    event.preventDefault();
                    var user = $('#myName1').val();
                    var receive = $('#receiver').val();
                    var message = $('#textAreaExample2').val();
                    $.ajax({
                        url: 'send_message-client.php',
                        method: 'POST',
                        data: {sender: user, receiver: receive, msg: message},
                        success: function(response) {
                            $('#textAreaExample2').val('');
                        }
                    });
                });
            });
        </script>
        <script>
            AOS.init({
                duration: 800,
                offset: 150,
            });
        </script>
        </body>
        </html>
