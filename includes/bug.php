<button type="button" class="btn btn-light bug"  data-toggle="modal" data-target="#myModal">Report Bug</button>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">REPORT PORTEL OF LearnLogic</h4>
        </div>
        <div class="modal-body">
 <form action="" method="POST">
   
      <label>Name*</label>
      <input type="text" class="form-control" name="name" required=""><br>
      
      <label>Emali*</label>
      <input type="email" class="form-control" name="email" required=""><br>
      
      <label>Bug page url*</label>
      <input type="text" class="form-control" name="url" required=""><br>

      <label>Enter Issue</label>
  <textarea class="form-control" name="message" placeholder="How can we help you?" style="height:150px;"></textarea><br>
  
      <label>Upload image</label>
   <input type="file"  class="form-control" name="img" placeholder="bug image" ><br>
	
 <button type="submit" class="btn btn-primary active" name="send">Submit</button>
	</form>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>