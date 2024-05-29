<?php 
DEFINE("TITLE", "WELCOME ASPIRING SCHOLAR");
include_once("website/templates/header.php");
?>

<body>

<div class="reqTab">
    <form method="POST" enctype="multipart/form-data">
        <div class="container">
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
            <!-- List of Requirements -->
            <?php
            $requirements = [
                "BIRTH CERTIFICATE",
                "REPORT CARD",
                "PROJECTED TUITION FEE",
                "COURSE PROSPECTUS",
                "2*2 ID PHOTO",
                "TEACHER'S REFERENCE FORM",
                "COMMUNITY LEADER REFERENCE FORM",
                "PROOF OF FINANCIAL STATUS",
                "ADMISSION SLIP"
            ];

            foreach ($requirements as $requirement) {
                echo '
                <div class="row requirement-row">
                    <div class="col status-col">
                        <p><?php // REQ STAT ?></p>
                    </div>
                    <div class="col requirement-col">
                        <p>' . $requirement . '</p>
                    </div>
                    <div class="col upload-col">
                        <div class="file-drop-area">
                            Drag & Drop or click to upload
                        </div>
                        <input type="file" class="file-input" multiple style="display: none;">
                        <div class="file-list mt-3"></div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </form>
</div>
</body>

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

