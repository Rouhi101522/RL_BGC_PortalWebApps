<?php
session_start();
DEFINE("TITLE", "WELCOME ASPIRING SCHOLAR");
include_once("website/templates/header.php");

$applicant_ID = $_SESSION['auth_user'];

if ($_SESSION['authorized'] == false) {
    header("location: index.php");
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
    $stmt = $conn->prepare("SELECT document_status FROM documents WHERE applicant_ID = ? AND document_ID = ?");
    $stmt->execute([$applicant_ID, $document_ID]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data ? $data['document_status'] : '';
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


// select documents(document status);

$stmt = $conn->prepare("INSERT INTO `app_docu` (`docs_ID`, `applicant_ID`, `document_id`) VALUES (NULL, '', '')");

if (isset($_POST['submit'])) {
    //FOR DOCUMENT 
    $requirements = [
        ['file' => $_FILES['birth_cert'], 'docu_type' => '1'],
        ['file' => $_FILES['sec_pre_rep_card'], 'docu_type' => '2'],
        ['file' => $_FILES['fir_pre_rep_card'], 'docu_type' => '3'],
        ['file' => $_FILES['cur_rep_card'], 'docu_type' => '4'],
        ['file' => $_FILES['proof_finance'], 'docu_type' => '5'],
        ['file' => $_FILES['course_prospectus'], 'docu_type' => '6'],
        ['file' => $_FILES['teach_ref_form'], 'docu_type' => '7'],
        ['file' => $_FILES['com_lead_ref_form'], 'docu_type' => '8'],
        ['file' => $_FILES['admission_slip'], 'docu_type' => '9']
    ];

    foreach ($requirements as $requirement) {
        if ($requirement['file']['error'] == UPLOAD_ERR_OK && is_uploaded_file($requirement['file']['tmp_name'])) {
            $document_file = file_get_contents($requirement['file']['tmp_name']);

            $stmt = $conn->prepare("SELECT * FROM documents WHERE applicant_id = ? AND document_type_id = ?");
            $stmt->execute([$applicant_ID, $requirement['docu_type']]);
            $existingDoc = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingDoc) {
                $stmt = $conn->prepare("UPDATE documents SET document_file = ?, document_status = ?, is_inserted = ? WHERE applicant_id = ? AND document_type_id = ?");
                $stmt->execute([$document_file, 'For Verification', '1', $applicant_ID, $requirement['docu_type']]);
            } else {
                $stmt = $conn->prepare("INSERT INTO documents (applicant_id, document_type_id, document_file, document_status, is_inserted) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$applicant_ID, $requirement['docu_type'], $document_file, 'For Verification', '1']);
            }
        }
    }

    $_SESSION['status'] = "Files uploaded successfully!";
    header("Location: " . $_SERVER['PHP_SELF']);
}
?>

<div class="profileDets">
<!-- applicant_profile and name on per_inf table -->
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
            <div class="row requirement-row">
                <div class="col status-col">
                    <?php
                        $document_ID = 1;
                        $document_status = getDocumentStatusById($conn, $applicant_ID, $document_ID);
                        echo getStatusIcon($document_status);
                    ?>
                    </div>
                <div class="col requirement-col">
                    <p>BIRTH CERTIFICATE</p>
                </div>
                <div class="col upload-col">
                    <div class="file-drop-area">
                        Drag & Drop or click to upload
                    </div>
                    <input type="file" class="file-input" name="birth_cert" multiple style="display: none;">
                    <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                     <?php
                        $document_ID = 2;
                        $document_status = getDocumentStatusById($conn, $applicant_ID, $document_ID);
                        echo getStatusIcon($document_status);
                    ?>
                    </div>
                <div class="col requirement-col">
                    <p>SECOND PREVIOUS REPORT CARD</p>
                </div>
                <div class="col upload-col">
                    <div class="file-drop-area">
                        Drag & Drop or click to upload
                    </div>
                    <input type="file" class="file-input"  name="sec_pre_rep_card" multiple style="display: none;">
                    <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                     <?php
                        $document_ID = 3;
                        $document_status = getDocumentStatusById($conn, $applicant_ID, $document_ID);
                        echo getStatusIcon($document_status);
                    ?>
                    </div>
                <div class="col requirement-col">
                    <p>FIRST PREVIOUS REPORT CARD</p>
                </div>
                <div class="col upload-col">
                    <div class="file-drop-area">
                        Drag & Drop or click to upload
                    </div>
                    <input type="file" class="file-input"  name="fir_pre_rep_card" multiple style="display: none;">
                    <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                     <?php
                        $document_ID = 4;
                        $document_status = getDocumentStatusById($conn, $applicant_ID, $document_ID);
                        echo getStatusIcon($document_status);
                    ?>
                    </div>
                <div class="col requirement-col">
                    <p>CURRENT REPORT CARD</p>
                </div>
                <div class="col upload-col">
                    <div class="file-drop-area">
                        Drag & Drop or click to upload
                    </div>
                    <input type="file" class="file-input"  name="cur_rep_card" multiple style="display: none;">
                    <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                     <?php
                        $document_ID = 5;
                        $document_status = getDocumentStatusById($conn, $applicant_ID, $document_ID);
                        echo getStatusIcon($document_status);
                    ?>
                    </div>
                <div class="col requirement-col">
                    <p>PROOF OF FINANCIAL STATUS</p>
                </div>
                <div class="col upload-col">
                    <div class="file-drop-area">
                        Drag & Drop or click to upload
                    </div>
                    <input type="file" class="file-input" name="proof_finance" multiple style="display: none;">
                    <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                     <?php
                        $document_ID = 6;
                        $document_status = getDocumentStatusById($conn, $applicant_ID, $document_ID);
                        echo getStatusIcon($document_status);
                    ?>
                    </div>
                <div class="col requirement-col">
                    <p>COURSE PROSPECTUS</p>
                </div>
                <div class="col upload-col">
                        <div class="file-drop-area">
                            Drag & Drop or click to upload
                        </div>
                        <input type="file" class="file-input" name="course_prospectus" multiple style="display: none;">
                        <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                     <?php
                        $document_ID = 7;
                        $document_status = getDocumentStatusById($conn, $applicant_ID, $document_ID);
                        echo getStatusIcon($document_status);
                    ?>
                    </div>
                <div class="col requirement-col">
                    <p>TEACHER'S REFERENCE FORM</p>
                </div>
                <div class="col upload-col">
                    <div class="file-drop-area">
                        Drag & Drop or click to upload
                    </div>
                    <input type="file" class="file-input" name="teach_ref_form" multiple style="display: none;">
                    <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                     <?php
                        $document_ID = 8;
                        $document_status = getDocumentStatusById($conn, $applicant_ID, $document_ID);
                        echo getStatusIcon($document_status);
                    ?>
                    </div>
                <div class="col requirement-col">
                    <p>COMMUNITY LEADER REFERENCE FORM</p>
                </div>
                <div class="col upload-col">
                    <div class="file-drop-area">
                        Drag & Drop or click to upload
                    </div>
                    <input type="file" class="file-input" name="com_lead_ref_form" multiple style="display: none;">
                    <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                     <?php
                        $document_ID = 9;
                        $document_status = getDocumentStatusById($conn, $applicant_ID, $document_ID);
                        echo getStatusIcon($document_status);
                    ?>
                    </div>
                <div class="col requirement-col">
                    <p>ADMISSION SLIP</p>
                </div>
                <div class="col upload-col">
                        <div class="file-drop-area">
                            Drag & Drop or click to upload
                        </div>
                        <input type="file" class="file-input" name="admission_slip" multiple style="display: none;">
                        <div class="file-list mt-3"></div>
                    </div>
            </div>
        <button type="submit">Submit Files</button>
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
            fileInput.files = e.dataTransfer.files; // Assign files to the input
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
});
</script>


