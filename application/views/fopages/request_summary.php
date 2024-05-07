<div class="page-body" id="page_request_summary">
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
            <li class="breadcrumb-item active"> Request Summary</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
	<div class="container-fluid">
		<div class="card" style="padding: 20px">
		    <div class="row">
	            <div class="col-12">
	            	<table class="table table-bordered table-condensed">
	            		<thead>
	            			<tr>
	            				<th colspan="2" style="text-align: center">Area</th>
	            				<th colspan="2" style="text-align: center">Request Information</th>
	            				<th colspan="2" style="text-align: center">Date</th>
	            				<th colspan="2" style="text-align: center">Attachments</th>
	            				<th rowspan="2" style="text-align: center; vertical-align: middle">Days Elapsed</th>
	            				<th rowspan="2" style="text-align: center; vertical-align: middle">Action</th>
	            			</tr>
	            			<tr>
	            				<th>Province</th>
	            				<th>City/Municipality</th>
	            				<th>Request Subject</th>
	            				<th>Incident Type/Name</th>
	            				<th>Request Received</th>
	            				<th>Acted/Approved</th>
	            				<th><center>Response Letter</center></th>
	            				<th><center>Asmt. Report</center></th>
	            			</tr>
	            		</thead>
            			<tbody>
            				<tr ng-repeat="request in augmentation_list">
            					<td>{{request.province_name}}</td>
	            				<td>{{request.municipality_name}}</td>
	            				<td>{{request.request_subject}}</td>
	            				<td><center>{{request.request_incident_name}}</center></td>
	            				<td><center>{{parseDate(request.date_requested)}}</center></td>
	            				<td><center>{{parseDate(request.approved_date)}}</center></td>
	            				<td>
	            					<center>
	            						<span ng-class="showButton(request.response_letter_file) === 1 ? 'fa fa-check text-primary' : 'fa fa-times text-danger'"></span>
	            					</center>
	            				</td>
	            				<td>
	            					<center>
	            						<span ng-class="showButton(request.assessment_report) === 1 ? 'fa fa-check text-primary' : 'fa fa-times text-danger'"></span>
	            					</center>
	            				</td>
	            				<td><center>{{calculateDiff(request.date_requested, request.approved_date) > 0 ? calculateDiff(request.date_requested, request.approved_date)+' days' : calculateDiff(request.date_requested, request.approved_date)+' day'}}</center></td>
	            				<td><button class="btn btn-sm btn-info" ng-click="UpdateDeliveries(request)">Update Delivery</button></td>
            				</tr>
            			</tbody>
            			<tfoot>
            				<tr>
            					<td colspan="8" style="text-align: right">Average Elapse Day</td>
            					<td style="text-align: center">{{calculateAverage(augmentation_list) | number}}</td>
            					<td></td>
            				</tr>
            			</tfoot>
	            	</table>
	            </div>
		    </div>
		</div>
	</div>
</div>

<div class="modal fade" id="UpdateDeliveriesModal" tabindex="-1" role="dialog" aria-labelledby="UpdateDeliveriesModal" aria-hidden="true" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title txt-secondary">Update Approved Item Deliveries</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<table class="table table-condensed table-bordered">
      		<thead>
      			<tr>
      				<th style="vertical-align: middle">Requested Item and Quantity</th>
      				<th style="vertical-align: middle; text-align: center">Balance</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr ng-repeat="item in items_to_be_delivered">
      				<td style="vertical-align: middle"><strong><span class="text-primary">{{item.approved_item}} : {{item.approved_quantity}}</span></strong>
      					<div class="mb-3 row">
		                    <label class="col-form-label col-sm-3">Quantity Delivered</label>
		                    <div class="col-sm-9">
		                    	<input class="form-control" type="number" ng-model="item.delivered_quantity" ng-disabled="fully_delivered == true || item.already_delivered_quantity >= item.approved_quantity">
		                    </div>
		                </div>
						<div class="mb-3 row">
		                    <label class="col-form-label col-sm-3">Date Delivered</label>
		                    <div class="col-sm-9">
		                    	<input class="form-control" type="date" ng-model="item.delivery_date" ng-disabled="fully_delivered == true || item.already_delivered_quantity >= item.approved_quantity" max="<?php echo date('Y-m-d');?>">
		                    </div>
		                </div>
      				</td>
      				<td style="vertical-align: middle; text-align: center" ng-class="(item.already_delivered_quantity < item.approved_quantity ? 'text-danger' : 'text-primary')">
      					<strong>
      					{{(item.already_delivered_quantity < item.approved_quantity ? (item.approved_quantity - item.already_delivered_quantity) : 'Fully Delivered')}}
      					</strong>
      				</td>
      			</tr>
      			<tr>
      				<td colspan="2">
      					<div class="form-check checkbox checkbox-solid-danger">
                            <input class="form-check-input" id="solid3" type="checkbox" ng-model="fully_delivered">
                            <label class="form-check-label" for="solid3"><strong>Check if fully Delivered?</strong></label>
                        </div>
                        <div class="mb-3 row">
		                    <label class="col-form-label col-sm-3">Date Fully Delivered<span class="text-danger"><strong>*</strong></span></label>
		                    <div class="col-sm-9"><input class="form-control" type="date" ng-model="delivery_full_date" id="" 
		                    	max="<?php echo date('Y-m-d');?>"></div>
		                </div>
      				</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
      <div class="modal-footer">
        <span class="loader" ng-show="showloader"></span>
        <button class="btn btn-primary" type="button" ng-click="SaveDeliveries();" id=""><span class="fa fa-save"></span> Save Deliveries</button>
      </div>
    </div>
  </div>
</div>