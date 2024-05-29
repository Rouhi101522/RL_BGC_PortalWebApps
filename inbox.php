<?php 
DEFINE("TITLE", "MESSAGES");
include_once("website/templates/header.php");
?>

<div class="inbox">

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

					<a href="#" class="list-group-item list-group-item-action border-0">
						<div class="badge bg-success float-right">5</div>
						<div class="d-flex align-items-start">
                            <img src="" class="rounded-circle mr-1" alt="" width="40" height="40">
							<div class="flex-grow-1 ml-3">
                                USER 1
                                <div class="small"><span class="fas fa-circle chat-online"></span>Online</div>
							</div>
						</div>
					</a>
					
					<a href="#" class="list-group-item list-group-item-action border-0">
                        <div class="d-flex align-items-start">
                            <img src="" class="rounded-circle mr-1" alt="" width="40" height="40">
							<div class="flex-grow-1 ml-3">
                                USER 2
								<div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
							</div>
						</div>
					</a>
                    
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
                            
                            <div class="chat-message-right mb-4">
                                <div>
                                    <img src="" class="rounded-circle mr-1" alt="" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2"></div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">You</div>
									Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
								</div>
							</div>
                            
							<div class="chat-message-left pb-4">
								<div>
									<img src="" class="rounded-circle mr-1" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:44 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">ADMIN</div>
									Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
								</div>
							</div>
						</div>
					</div>
                    
					<div class="flex-grow-0 py-3 px-4 border-top">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type your message">
							<button class="btn btn-primary">Send</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
include_once("website/templates/footer.php");
?>



