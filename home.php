<?PHP
session_start();
DEFINE("TITLE", "WELCOME ASPIRING SCHOLAR");
include_once("website/templates/header.php");


$applicant_id = $_SESSION['applicant_id'];

// fetch file status
// file is set
//     file name
//     when file is uploaded or isset set document status to 'for verification'


// select documents(document status);

$stmt = $conn->prepare("INSERT INTO `app_docu` (`docs_ID`, `applicant_ID`, `document_id`) VALUES (NULL, '', '')");



if(isset($_POST['submit'])){
    //FOR DOCUMENT 
    $requirement1 = "BIRTH CERTIFICATE";
    $requirement2 = "REPORT CARD";
    $requirement3 = "PROJECTED TUITION FEE";
    $requirement4 = "COURSE PROSPECTUS";
    $requirement5 = "TEACHER'S REFERENCE FORM";
    $requirement6 = "COMMUNITY LEADER REFERENCE FORM";
    $requirement7 = "PROOF OF FINANCIAL STATUS";
    $requirement8 = "ADMISSION SLIP";
    
    $requirementDocu1 = $requirement1;
    $requirementDocu2 = $requirement2;
    $requirementDocu3 = $requirement3;
    $requirementDocu4 = $requirement4;
    $requirementDocu5 = $requirement5;
    $requirementDocu6 = $requirement6;
    $requirementDocu7 = $requirement7;
    $requirementDocu8 = $requirement8;


    $stmt = $conn->prepare("INSERT INTO `app_docu` (`docs_ID`, `applicant_ID`, `document_id`) VALUES (NULL, '', '')");
    $stmt->execute(['user_id', $password]);


    $_SESSION['status'] = "Files uploaded successfully!";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>
<div class="profileDets">
    <!-- Profile Details. Image of applicant and name -->
</div>
<div class="reqTab">
    <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col">   
                    <p>STATUS</p>
                </div>
                <div class="col">
                    <p>LIST OF REQUIREMENTS NEEDED</p>
                </div>
                <div class="col">
                    <p>FILE UPLOAD</p>
                </div>
            </div>
            <hr>
            <!-- List of Requirements -->
            <div class="row requirement-row">
                <div class="col status-col">
                    <?PHP ?>
                    <!-- STATUS -->
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
                    <!-- STATUS -->
                    </div>
                <div class="col requirement-col">
                    <p>REPORT CARD</p>
                </div>
                <div class="col upload-col">
                    <div class="file-drop-area">
                        Drag & Drop or click to upload
                    </div>
                    <input type="file" class="file-input"  name="report_card" multiple style="display: none;">
                    <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                    <!-- STATUS -->
                    </div>
                <div class="col requirement-col">
                    <p>PROJECTED TUITION FEE</p>
                </div>
                <div class="col upload-col">
                    <div class="file-drop-area">
                        Drag & Drop or click to upload
                    </div>
                    <input type="file" class="file-input"  name="projected_tuition_fee" multiple style="display: none;">
                    <div class="file-list mt-3"></div>
                </div>
            </div>
            <div class="row requirement-row">
                <div class="col status-col">
                    <!-- STATUS -->
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
                    <!-- STATUS -->
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
                    <!-- STATUS -->
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
                    <!-- STATUS -->
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
                    <!-- STATUS -->
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

