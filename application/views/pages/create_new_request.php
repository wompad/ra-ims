<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h3>
             My DRRM Tools
           </h3>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard" data-bs-original-title="" title=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
            <li class="breadcrumb-item">My DRRM Tools</li>
            <li class="breadcrumb-item"> Augmentation</li>
            <li class="breadcrumb-item active"> Create a Request</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5 class="text-primary">Create Request</h5>
            <span>Create new request for augmentation. Please note that fields with <code class="text-danger">*</code> are required. Once the assigned social worker acknowledged you request you will receive a notification/text message that your request is duly received and acknowledged for processing. </span> 
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group" ng-hide="hideitemError || cart.invalidInputs().length == 0">
                <label class="text-danger">
                  Kindly review your entries and fill-out the required fields
                </label>
                <ul class="text-danger">
                  <li ng-repeat="error in cart.invalidInputs()"><code class="text-danger">*</code> {{error}}</li>
                </ul>
              </div>
            </div>
            <br ng-hide="hideitemError || cart.invalidInputs().length == 0">
            <div class="row g-3">
              <div class="col-md-12">
                <label class="form-label">Request Subject <code class="text-danger">*</code></label>
                <input class="form-control" type="text" required="" data-bs-original-title="" ng-model="cart.subject">
              </div>
              <div class="col-md-4">
                <label class="form-label">Incident Name <code class="text-danger">*</code></label>
                <input class="form-control"type="text" required="" data-bs-original-title="" ng-model="cart.incident_name">
              </div>
              <div class="col-md-4">
                <label class="form-label">Incident Date <code class="text-danger">*</code></label>
                <input class="form-control" type="date" required="" data-bs-original-title="" ng-model="cart.incident_date">
              </div>
              <div class="col-md-4">
                <label class="form-label">Estimated Number of Families to Serve <code class="text-danger">*</code></label>
                <input class="form-control"type="number" required="" data-bs-original-title="" ng-model="cart.estimated_family">
              </div>
              <div class="col-md-4 pull-right">
                <button class="btn btn-info" ng-click="addnewItem();"><i class="fa fa-plus-circle"></i> Add Items</button>
                <button class="btn btn-danger" ng-click="deletemarkItems();"><i class="fa fa-trash"></i> Delete Selected Items</button>
              </div>
              <div class="col-md-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 5%; text-align: center; vertical-align: middle">
                        <input type="checkbox" class="form-check-input" ng-model="selectAllItems" ng-click="checkAllItems();" data-bs-original-title title>
                      </th>
                      <th style="width: 45%"> Items to be Requested </th>
                      <th style="width: 45%; text-align: center"> Quantity Requested </th>
                      <th style="width: 5%; text-align: center"> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="item in cart.items_list">
                      <td style="width: 5%; text-align: center; vertical-align: middle">
                        <input type="checkbox" class="form-check-input" ng-model="item.check" data-bs-original-title title>
                      </td>
                      <td style="width: 45%"> <input type="text" class="form-control" ng-model="item.item_requested" placeholder="Family Food Packs, Kitchen Kit, Hygiene Kit, Sleeping Kit, Family Kit and etc.."> </td>
                      <td style="width: 45%; text-align: center"> 
                        <input type="number" style="text-align: center" class="form-control" ng-model="item.quantity_requested">
                      </td>
                      <td style="width: 5%"> <button type="button" class="btn btn-danger btn-sm" ng-click="removeItem($index);"><i class="fa fa-times-circle"></i></button> </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6">
                <label class="form-label">DROMIC Report File <code class="text-danger">*</code> </label>
                <input class="form-control" type="file" required="" data-bs-original-title="" id="dromic_file" ng-file="cart.dromic_file" accept=".jpg,.jpeg,.png,.pdf">
              </div>
              <div class="col-md-6">
                <label class="form-label">Request Letter File <code class="text-danger">*</code></label>
                <input class="form-control" type="file" required="" data-bs-original-title="" id="request_file"  ng-file="cart.request_file" accept=".jpg,.jpeg,.png,.pdf">
              </div>
            </div>
            <br/>
            <button class="btn btn-primary" data-bs-original-title="" ng-click="checkRequested();"><i class="fa fa-paper-plane-o"></i>  Submit Request</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
        