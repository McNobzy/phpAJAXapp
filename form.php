<div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Adding or Updating Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <form id="addform" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label for="">Username:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-dark">
                        <i class="fa fa-user-alt text-light" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="Enter your username..." autocomplete="off" id="username" required="required">
                </div>
            </div>

            <div class="form-group">
                <label for="">Email:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-dark">
                        <i class="fa fa-envelope-open text-light" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input type="email" class="form-control" placeholder="Enter your email" autocomplete="off" id="email" name="email" required="required">
                </div>
            </div>

            <div class="form-group">
                <label for="">Mobile:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-dark">
                        <i class="fa fa-phone text-light" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" maxLength="11" minLength="11" placeholder="Enter your phone number" autocomplete="off" id="mobile" name="mobile" required="required">
                </div>
            </div>

            <div class="form-group">
                <label>Photo:</label>
                <div class="input-group">
                    <label for="userphoto" class="custom-file-label">Choose file</label>                    
                    <input type="file" class="custom-file-input" name="photo"  id="userphoto">
                </div>
            </div>

        </div>
        <div class="modal-footer">

        <input type="hidden" name="action" value="adduser">
            <input type="hidden" name="userId" id="userId" value=""> 
            
            <button type="submit" class="btn btn-dark">Add user</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
            <!-- 2 inputs fields first for adding and next for updating, deleting, deleting or viewing profile  -->

           
      </div>
      </form>

     
      
    </div>
  </div>
</div>