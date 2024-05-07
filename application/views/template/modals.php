<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add More Photo</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12" style="text-align: center">
            <img class="img img-thumbnail" style="width: 300px; height: 300px; cursor: pointer" id="preview_ec_photo" src="assets_0/assets/images/avtar/add_photo.jpg" ng-click="selectECPhoto();">
            <br/>
            <br/>
            <input type="file" class="form-control" accept="image/*" style="display: none" id="ec_photo" ng-file="ec_photo" custom-on-change="uploadECPhoto" >
            <input type="text" class="form-control" placeholder="Enter Caption...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Upload Photo</button>
      </div>
    </div>
  </div>
</div>