<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupmodalLabel">SignUp For AR'S</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forum/signup_handle.php" method="post">
                <div class="modal-body">
        
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Name</label>
                        <input type="name" class="form-control" id="signup_email" name = "signup_email" aria-describedby="emailHelp">
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signup_pass" name = "signup_pass">
                    </div>
                    <div class="mb-3">  
                        <label for="exampleInputPassword1" class="form-label">ConfirmPassword</label>
                        <input type="password" class="form-control" id="signup_cpass" name= "signup_cpass">
                    </div>
                  
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
               
            </form>
        </div>
    </div>
</div>