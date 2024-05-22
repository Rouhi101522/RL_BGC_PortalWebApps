<?php 
DEFINE("TITLE", "APPLICATION");
include_once("website/templates/header.php");
?>

<body>
    <div class="reqTab">
        <form method="POST" enctype="multipart/form-data"></form>
        <div class="container">
            <div class="row">
                <div class="col">
                    <p>Application Status</p>
                </div>
                <div class="col">
                    <p><?PHP  ?></p>
                    <!-- Get status of application -->
                </div>
                <div class="col">
                    <p><?PHP echo("KIMI NO NAWA")  ?></p>
                    <!-- Get status of application -->
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                <p>FILE UPLOAD</p>
                        
                </div>
                <div class="col">
                    <p>LIST OF REQUIREMENTS NEEDED</p>
                </div>
                <div class="col">
                    <p>STATUS</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="Upload">
                </div>
                <div class="col">
                    <p>BIRTH CERTIFICATE</p>
                </div>
                <div class="col">
                    <p><?PHP   ?></p>
                    <!-- REQ STAT -->
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="Upload">
                </div>
                <div class="col">
                    <p>REPORT CARD</p>
                </div>
                <div class="col">
                    <p><?PHP   ?></p>
                    <!-- REQ STAT -->
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="Upload">
                </div>
                <div class="col">
                    <p>PROJECTED TUITION FEE</p>
                </div>
                <div class="col">
                    <p><?PHP   ?></p>
                    <!-- REQ STAT -->
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="Upload">
                </div>
                <div class="col">
                    <p>COURSE PROSPECTUS</p>
                </div>
                <div class="col">
                    <p><?PHP   ?></p>
                    <!-- REQ STAT -->
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="Upload">
                </div>
                <div class="col">
                    <p>2*2 ID PHOTO</p></div>
                <div class="col">
                    <p><?PHP   ?></p>
                    <!-- REQ STAT -->
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="Upload">
                </div>
                <div class="col">
                    <p>TEACHER'S REFERENCE FORM</p>
                </div>
                <div class="col">
                    <p><?PHP   ?></p>
                    <!-- REQ STAT -->
                </div>
            </div>
            <div class="row">
            <div class="col">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="Upload">
                </div>
                <div class="col">
                    <p>COMMUNITY LEADER REFERENCE FORM</p>
                </div>
                <div class="col">
                    <p><?PHP   ?></p>
                    <!-- REQ STAT -->
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="Upload">
                </div>
                <div class="col">
                    <p>PROOF OF FINANCIAL STATUS</p>
                </div>
                <div class="col">
                    <p><?PHP   ?></p>
                    <!-- REQ STAT -->
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="Upload">
                </div>
                <div class="col">
                    <p>ADMISSION SLIP</p>
                </div>
                <div class="col">
                    <p><?PHP   ?></p>
                    <!-- REQ STAT -->
                </div>
            </div>
            </div>
        </div>
    </div>
</body>

<?php 
include_once("website/templates/footer.php");
?>