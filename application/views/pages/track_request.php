<div class="page-body" id="lgu_track_request">
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
	            <li class="breadcrumb-item active"> Track Request</li>
	          </ol>
	        </div>
	      </div>
	    </div>
	</div>
	<div class="container-fluid">
        <div class="card" style="padding: 20px">
    	  <div class="row">
    	      <div class="col-12 table-responsive">
    	      	<table class="table table-bordered table-condensed">
            		<thead>
            			<tr>
            				<th colspan="2" style="text-align: center">Request Information</th>
            				<th colspan="2" style="text-align: center">Date</th>
            				<th rowspan="2" style="text-align: center; vertical-align: middle">Status</th>
            				<th rowspan="2" style="text-align: center; vertical-align: middle">Response Letter</th>
            				<th rowspan="2" style="text-align: center; vertical-align: middle"></th>
            			</tr>
            			<tr>
            				<th>Request Subject</th>
            				<th>Incident Type/Name</th>
            				<th style="text-align: center">Incident Date</th>
            				<th style="text-align: center">Date Requested</th>
            			</tr>
            		</thead>
        			<tbody>
        				<tr ng-repeat="request in all_request" style="vertical-align:  middle;">
            				<td>{{request.request_subject}}</td>
            				<td>{{request.request_incident_name}}</td>
            				<td style="text-align: center">{{parseDate(request.request_incident_date)}}</td>
            				<td style="text-align: center">{{parseDate(request.date_requested)}}</td>
            				<td style="text-align: center">
                      <span ng-class="(request.request_status == 'Approved' ? 'text-success' : request.request_status == 'Pending' ? 'text-warning' : 'text-danger')">
                        {{
                          (request.request_status == 'Approved' ? 'Approved for Assessment' : request.request_status == 'Pending' ? 'Pending/With Lacking Documents' : request.request_status == 'Disapproved' ? 'Disapproved' : request.request_status == 'Cancelled' ? 'Cancelled' : '-')
                        }}
                      </span>
                    </td>
            				<td style="text-align: center"><span ng-class="(showButton(request.response_letter_file) == 1 ? 'btn btn-xs btn-primary' : 'fa fa-times text-danger')" ng-click="(showButton(request.response_letter_file) == 1 ? viewFile(request.response_letter_file) : null )">{{(showButton(request.response_letter_file) == 1 ? 'View File' : null)}}</span></td>
            				<td style="text-align: center">
                      <div class="btn-group" role="group">
                          <button class="btn btn-primary dropdown-toggle btn-sm" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-original-title="" title="" ng-disabled="request.request_status === 'Cancelled'">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" data-bs-original-title="" title="" ng-click="viewLGURequestDetail(request)">
                              <span class="text-primary">View Details</span>
                            </a>
                            <a class="dropdown-item" href="#" data-bs-original-title="" title="" ng-click="showEditAttachmentModal();">
                              <span class="text-primary">Edit Attachments</span>
                            </a>
                            <a class="dropdown-item" href="#" data-bs-original-title="" title="" ng-hide="request.request_status == 'Approved' || request.request_status == 'Cancelled'" ng-click="cancelRequest(request);">
                              <span class="text-danger">Cancel Request</span>
                            </a>
                          </div>
                      </div>
            				</td>
            			</tr>
        			</tbody>
            	</table>     
    	      </div>
    	  </div>
        </div>
	</div>
</div>

<div class="modal fade" id="requestDetailsModal" tabindex="-1" role="dialog" aria-labelledby="requestDetailsModal" aria-hidden="true" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <ul class="nav nav-tabs" id="icon-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="icon-home-tab" data-bs-toggle="tab" href="#icon_request_details" role="tab" aria-controls="icon-home" aria-selected="true" data-bs-original-title="" title=""><i class="icofont icofont-ui-home"></i>Request Details</a></li>
            <li class="nav-item"><a class="nav-link" id="profile-icon-tab" data-bs-toggle="tab" href="#icon_approved_items" role="tab" aria-controls="profile-icon" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-files"></i>Approved Items</a></li>
          </ul>
          <div class="tab-content" id="icon-tabContent">
            <div class="tab-pane fade active show" id="icon_request_details" role="tabpanel">
              <table class="table table-condensed table-bordered" style="margin-top: 10px">
                  <thead>
                    <tr><th colspan="2">Request Details</th></tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Request Subject</td><td>{{reqdetails.request_subject}}</td>
                    </tr>
                    <tr>
                      <td>Incident Name</td><td>{{reqdetails.request_incident_name}}</td>
                    </tr>
                    <tr>
                      <td>Incident Date</td><td>{{parseDate(reqdetails.request_incident_date)}}</td>
                    </tr>
                    <tr>
                      <td>Estimated # of Families</td><td>{{reqdetails.request_estimated_family}}</td>
                    </tr>
                    <tr>
                      <td>Date Requested</td><td>{{parseDate(reqdetails.date_requested)}}</td>
                    </tr>
                    <tr>
                      <th colspan="2">Requested Items</th>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <table class="table table-condensed table-bordered">
                          <thead>
                            <tr>
                              <th>Item Requested</th>
                              <th style="text-align: center">Item Quantity</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr ng-repeat="item in requested_items">
                              <td>{{item.item_requested}}</td>
                              <td style="text-align: center">{{item.item_quantity}}</td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="icon_approved_items" role="tabpanel">
              <table class="table table-condensed table-bordered" style="margin-top: 10px">
                    <thead>
                      <tr>
                        <th colspan="4" style="text-align: center">Approved Items</th>
                      </tr>
                      <tr>
                        <th style="width: 25%">Item</th>
                        <th style="text-align: center; width: 25%">Quantity</th>
                        <th style="text-align: center; width: 25%">Delivered</th>
                        <th style="text-align: center; width: 25%">Balance</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="item in approved_items">
                        <td>{{item.approved_item}}</td>
                        <td style="text-align: center">{{item.approved_quantity}}</td>
                        <td style="text-align: center">{{item.delivered || 0}}</td>
                        <td style="text-align: center">{{Number(item.approved_quantity) - Number(item.delivered)}}</td>
                      </tr>
                      <tr>
                        <th>Response Letter: </th>
                        <td colspan="3" style="text-align: center"><span ng-class="(showButton(reqdetails.response_letter_file) == 1 ? 'btn btn-sm btn-primary' : null)" ng-click="(showButton(reqdetails.response_letter_file) == 1 ? viewFile(reqdetails.response_letter_file) : null )">
                          {{(showButton(reqdetails.response_letter_file) == 1 ? reqdetails.response_letter_file : 'No response letter already sent.')}}
                        </span></td>
                      </tr>
                    </tbody>  
                  </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editAttachmentsModal" tabindex="-1" role="dialog" aria-labelledby="editAttachmentsModal" aria-hidden="true" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Attachments</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="col-md-12 mb-3">
            <label class="form-label">DROMIC Report File <code class="text-danger">*</code> </label>
            <input class="form-control" type="file" required="" data-bs-original-title="" id="dromic_file" ng-file="cart.dromic_file" accept=".jpg,.jpeg,.png,.pdf">
          </div>
          <div class="col-md-12 mb-3">
            <label class="form-label">Request Letter File <code class="text-danger">*</code></label>
            <input class="form-control" type="file" required="" data-bs-original-title="" id="request_file"  ng-file="cart.request_file" accept=".jpg,.jpeg,.png,.pdf">
          </div>
          <div class="col-md-12">
            <button class="btn btn-secondary pull-right" 
            data-bs-original-title="" 
            ng-click="checkRequested();">
              <i class="fa fa-paper-plane-o"></i>  
              Submit Request
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>