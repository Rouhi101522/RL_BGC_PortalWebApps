<?php
session_start();
DEFINE("TITLE", "WELCOME ASPIRING SCHOLAR");
include_once("website/templates/header.php");
include_once("website/config.php");

$applicant_ID = $_SESSION['auth_user'];

if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] == false) {
    header("location: index.php");
    exit();
}

// For Person Details
$stmt = $conn->prepare("SELECT * FROM person_inf WHERE applicant_ID = ? ");
$stmt->execute([$applicant_ID]);

$data = $stmt->fetch(PDO::FETCH_ASSOC);

$applicant_profile = $data['applicant_profile'];
$last_name = $data['last_name'];
$first_name = $data['first_name'];
$middle_name = $data['middle_name'];

// For Document Status
function getDocumentStatusById($conn, $applicant_ID, $document_ID) {
    $stmt = $conn->prepare("SELECT document_status, document_file, document_file_name FROM documents WHERE applicant_ID = ? AND document_type_id = ?");
    $stmt->execute([$applicant_ID, $document_ID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// This is the default status if the file is not yet uploaded
function getStatusIcon($document_status) {
    if (empty($document_status)) {
        return '<img src="assets/rl/Logo/three-dots.svg" alt="Status">';
    } elseif ($document_status == 'For Verification') {
        return '<img src="assets/rl/Logo/hourglass-top.svg" alt="Status">';
    } elseif ($document_status == 'Passed') {
        return '<img src="assets/rl/Logo/check-circle-fill.svg" alt="Status">';
    } elseif ($document_status == 'For Reupload') {
        return '<img src="assets/rl/Logo/exclamation-circle-fill.svg" alt="Status">';
    }
}

if (isset($_POST['submit'])) {
    $requirements = [
        'birth_certificate' => '1',
        'second_previous_report_card' => '2',
        'first_previous_report_card' => '3',
        'current_report_card' => '4',
        'proof_of_financial_status' => '5',
        'course_prospectus' => '6',
        'teachers_reference_form' => '7',
        'community_leader_reference_form' => '8',
        'admission_slip' => '9'
    ];

    $updated = false; 

    foreach ($requirements as $input_name => $docu_type) {
        if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] == UPLOAD_ERR_OK) {
            if (is_uploaded_file($_FILES[$input_name]['tmp_name'])) {
                $document_file = file_get_contents($_FILES[$input_name]['tmp_name']);
                $file_name = $_FILES[$input_name]['name']; 
                
                $stmt = $conn->prepare("SELECT * FROM documents WHERE applicant_id = ? AND document_type_id = ?");
                $stmt->execute([$applicant_ID, $docu_type]);
                $existingDoc = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($existingDoc) {
                    $stmt = $conn->prepare("UPDATE documents SET document_file_name = ?, document_status = ?, is_inserted = ? WHERE applicant_id = ? AND document_type_id = ?");
                    $stmt->execute([$file_name, 'For Verification', '1', $applicant_ID, $docu_type]);
                    $updated = true; 
                } else {
                    $stmt = $conn->prepare("INSERT INTO documents (applicant_id, document_type_id, document_file, document_file_name, document_status, is_inserted) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$applicant_ID, $docu_type, $document_file, $file_name, 'For Verification', '1']);
                    $document_id = $conn->lastInsertId();

                    $stmt = $conn->prepare("INSERT INTO app_docu (applicant_ID, document_id) VALUES (?, ?)");
                    $stmt->execute([$applicant_ID, $document_id]);
                }

                $_SESSION['status'] = "Files Uploaded Successfully!";
            }
        } else {
            echo "File upload error for $input_name: " . $_FILES[$input_name]['error'] . "<br>";
        }
    }

    if ($updated) {
        $_SESSION['update_status'] = "Updated Successfully!";
        unset($_SESSION['status']); 
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


?>

<div class="profileDets">
</div>
<div class="reqTab">
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col">   
                <h5>STATUS</h5>
            </div>
            <div class="col">
                <h5>LIST OF REQUIREMENTS NEEDED</h5>
            </div>
            <div class="col">
                <h5>FILE UPLOAD</h5>
            </div>
        </div>
        <hr>

        <!-- List of Requirements -->
        <?php 
            if (isset($_SESSION['status'])) {
                $message = $_SESSION['status'];
                unset($_SESSION['status']);
            } elseif (isset($_SESSION['update_status'])) {
                $message = $_SESSION['update_status'];
                unset($_SESSION['update_status']);
            }

            if (isset($message)) {
                echo '<div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert" style="text-align:center;">
                        ' . $message . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        ?>

        <?php 
            $documents = [
                1 => 'Birth Certificate',
                2 => 'Second Previous Report Card',
                3 => 'First Previous Report Card',
                4 => 'Current Report Card',
                5 => 'Proof Of Financial Status',
                6 => 'Course Prospectus',
                7 => 'Teacher\'s Reference Form',
                8 => 'Community Leader Reference Form',
                9 => 'Admission Slip'
            ];

            foreach ($documents as $doc_id => $doc_name) {
                $document_data = getDocumentStatusById($conn, $applicant_ID, $doc_id);
                $document_status = isset($document_data['document_status']) ? $document_data['document_status'] : '';
                $document_file = isset($document_data['document_file_name']) ? htmlspecialchars($document_data['document_file_name']) : '';
                
                echo '<div class="row requirement-row">
                    <div class="col status-col">' . getStatusIcon($document_status) . '</div>
                    <div class="col requirement-col"><p>' . $doc_name . '</p></div>
                    <div class="col upload-col">
                        <div class="file-drop-area">Drag & Drop or click to upload</div>
                        <input type="file" class="file-input" name="' . strtolower(str_replace(' ', '_', $doc_name)) . '" multiple style="display: none;">
                        <div class="file-list mt-3">' . ($document_file ? '<div>' . $document_file . '</div>' : '') . '</div>
                    </div>
                </div>';
            }

            ?>

        <button type="submit" name="submit">Submit Files</button>
    </form>
</div>

<?php 
include_once("website/templates/footer.php");
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var fileDropAreas = document.querySelectorAll('.file-drop-area');
    var fileInputs = document.querySelectorAll('.file-input');
    var fileLists = document.querySelectorAll('.file-list');

    fileDropAreas.forEach(function(fileDropArea, index) {
        var fileInput = fileInputs[index];
        var fileList = fileLists[index];

        fileDropArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            fileDropArea.classList.add('dragover');
        });

        fileDropArea.addEventListener('dragleave', function() {
            fileDropArea.classList.remove('dragover');
        });

        fileDropArea.addEventListener('drop', function(e) {
            e.preventDefault();
            fileDropArea.classList.remove('dragover');
            handleFiles(e.dataTransfer.files, fileList);
            fileInput.files = e.dataTransfer.files; 
        });

        fileDropArea.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            handleFiles(fileInput.files, fileList);
        });
    });

    function handleFiles(files, fileList) {
        fileList.innerHTML = '';
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var listItem = document.createElement('div');
            listItem.textContent = file.name;
            fileList.appendChild(listItem);
        }
    }
    var submitButton = document.querySelector('button[name="submit"]');
    submitButton.addEventListener('click', function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'block';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000); 
        }
        var updateMessage = document.getElementById('update-message');
        if (updateMessage) {
            updateMessage.style.display = 'block';
            setTimeout(function() {
                updateMessage.style.display = 'none';
            }, 5000); 
        }
    });
});
</script>
