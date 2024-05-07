<div class="page-body" id="manage_request">
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
            <li class="breadcrumb-item">Augmentation</li>
            <li class="breadcrumb-item active">Received Requests</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid" ng-hide="requestList">
    <div class="card" style="padding: 10px 0px 0px 10px">
      <div class="row">
          <div class="col-12">
            <div class="col-md-6" ng-show="augmentation_list.length < 1">
              <label class="pull-right txt-secondary"><strong>No request received.</strong></label>
            </div>
            <div class="col-md-12" ng-show="augmentation_list.length > 0">
              <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                  <li class="nav-item"><a class="nav-link active" id="icon-home-tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="icon-home" aria-selected="true" data-bs-original-title="" title="" ng-click="province = ''"><i class="icofont icofont-ui-home"></i>All Request</a></li>
                  <li class="nav-item"><a class="nav-link" id="adn_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="profile-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="province = 'Agusan del Norte'"><i class="icofont icofont-list"></i>Agusan del Norte</a></li>
                  <li class="nav-item"><a class="nav-link" id="ads_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="contact-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="province = 'Agusan del Sur'"><i class="icofont icofont-list"></i>Agusan del Sur</a></li>
                  <li class="nav-item"><a class="nav-link" id="sdn_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="contact-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="province = 'Surigao del Norte'"><i class="icofont icofont-list"></i>Surigao del Norte</a></li>
                  <li class="nav-item"><a class="nav-link" id="sds_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="contact-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="province = 'Surigao del Sur'"><i class="icofont icofont-list"></i>Surigao del Sur</a></li>
                  <li class="nav-item"><a class="nav-link" id="pdi_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="contact-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="province = 'Dinagat Islands'"><i class="icofont icofont-list"></i>Dinagat Islands</a></li>
              </ul>
              <div class="tab-content" id="icon-tabContent">
                <div class="tab-pane fade active show" id="icon-home" role="tabpanel" aria-labelledby="icon-home-tab">
                  <table class="table">
                      <tbody>
                          <tr style="cursor: pointer" 
                          ng-repeat="request in augmentation_list | filter : province" 
                          class="notread" 
                          ng-click="requestDetails($event, request)">
                              <td style="width: 20vw">{{request.municipality_name}}, {{request.province_name}}</td>
                              <td style="width: 70vw">
                                  Subject: {{request.request_subject}}<br/>
                                  Incident Name/Type: {{request.request_incident_name}}<br/><br/>
                                  <label class="btn btn-pill btn-sm btn-light" style="padding: 10px; cursor: pointer" title="DROMIC Report" ng-click="viewFile(request.dromic_report_file)">
                                      <span ng-class="getfileClass2(request.dromic_report_file)"><span style="font-weight: bolder">{{getfileClass(request.dromic_report_file)}}</span></span> {{sliceFile(request.dromic_report_file)}}
                                  </label>
                                  <label class="btn btn-pill btn-sm btn-light" style="padding: 10px; cursor: pointer" title="Request Letter" ng-click="viewFile(request.request_letter_file)">
                                    <span ng-class="getfileClass2(request.request_letter_file)"><span style="font-weight: bolder">{{getfileClass(request.request_letter_file)}}</span></span> {{sliceFile(request.request_letter_file)}}
                                  </label>
                              </td>
                              <td style="width: 10vw">
                                {{parseDate(request.date_requested)}} <br/><br/>
                                <strong><label ng-class="(request.request_status === 'Pending' ? 'text-warning' : request.request_status === 'Disapproved' ? 'text-danger' : request.request_status === 'Cancelled' ? 'text-danger' : 'text-primary')">{{request.request_status || ""}}</label></strong>
                              </td>
                          </tr>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div> 
    </div> 
  </div>
  <div class="container-fluid" ng-hide="requestDetail">
      <div class="row">
          <div class="col-12">
            <div class="card" style="padding: 5px">
              <div class="col-md-2 offset-md-10" style="padding: 15px">
                <label class="pull-right" ng-click="backtorequestList(1);" style="cursor: pointer"><span data-feather="x" class="txt-secondary"></span></label>
              </div>
              <div class="card-body">
                <h5 class="modal-title">Relief Augmentation Request Details</h5><br/>
                <table class="table table-bordered">
                  <tbody>
                      <tr><td>Subject:</td><td colspan="2">{{reqDetails.request_subject}}</td></tr>
                      <tr>
                        <td>Incident Name:</td><td colspan="2">{{reqDetails.request_incident_name}}</td>
                      </tr>
                      <tr>
                        <td>Incident Date:</td><td colspan="2">{{parseDate(reqDetails.request_incident_date)}}</td>
                      </tr>
                      <tr>
                        <td>Families to be Served:</td><td colspan="2">{{reqDetails.request_estimated_family}}</td>
                      </tr>
                      <tr>
                        <td>Date Requested:</td><td colspan="2">{{parseDate(reqDetails.date_requested)}}</td>
                      </tr>
                      <tr>
                        <td colspan="3">Requested Items</td>
                      </tr>
                      <tr>
                        <td colspan="3">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th style="width: 50%">Item</th>
                                <th style="text-align: center">Quantity</th>
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
                      <tr>
                        <td>Set Request Status: </td>
                        <td>
                          <select class="form-control" ng-options="x as x.description for x in statuses track by x.value" ng-model="request_status">
                          </select>
                        </td>
                        <td><button type="button" class="btn btn-primary form-control" ng-click="saveRequestStatus()">Continue</button></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>   
  </div>
  <div class="container-fluid" ng-hide="requestApproveDetails">
      <div class="row">
          <div class="col-12">
            <div class="card" style="padding: 5px">
              <div class="col-md-2 offset-md-10" style="padding: 15px">
                <label class="pull-right" ng-click="backtorequestList(1);" style="cursor: pointer"><span data-feather="x" class="txt-secondary"></span></label>
              </div>
              <div class="card-body">
                <h5 class="modal-title">Specify Items to be provided</h5><br/>
                <div class="col-md-12" style="margin-bottom: 10px">
                  <button class="btn btn-primary" ng-click="addApprovedItems();"><span class="fa fa-plus-circle"></span> Add Item</button>
                  <button class="btn btn-danger" ng-click="deletemarkItems();"><span class="fa fa-trash"></span> Delete Item(s)</button>
                </div>
                <table class="table table-bordered table-condensed">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Item Name</th>
                      <th style="text-align: center">Quantity</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="item in approvedItems">
                      <td style="text-align: center"><input type="checkbox" ng-model="item.check" class="form-check-input" data-bs-original-title title></td>
                      <td><input type="text" class="form-control" ng-model="item.approvedItem"></td>
                      <td><input type="text" style="text-align: center" class="form-control" ng-model="item.approvedQuantity"></td>
                      <td style="text-align: center"><button class="btn btn-danger btn-xs" ng-click="removeItem($index)"><span class="fa fa-trash"></span></button></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4"><label for="">Remarks: </label><input type="text" class="form-control" placeholder="Input remarks"></td>
                    </tr>
                  </tfoot>
                </table>
                <div class="col-md-12" style="margin-top: 10px">
                  <button class="btn btn-primary" ng-click="saveApprovedRequest();"><span class="fa fa-plus-circle"></span> Save and Continue</button>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>

<div id="modalFileViewer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"  style="height: 90vh" id="modalFileViewerDims">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <iframe src="{{requestfile || ''}}" frameborder="0" style="width: 100%; height: 100%"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="requestDetailsModal" tabindex="-1" role="dialog" aria-labelledby="requestDetailsModal" aria-hidden="true" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label>You have set this request as <span ng-class="(request_status.value === 'Disapproved' || request_status.value === 'Cancelled' ? 'text-danger' : 'text-warning')">
          <strong>{{request_status.value}}</strong></span>. 
          {{request_status.value === 'Pending' ? 'Please provide some remarks for the requester.' : 'Please provide some remarks for the requester for the cancellation/disapproval of the request.'}}
        </label>
        <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Remarks/Reasons" ng-model="request_remarks"></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="savePendingRequest()">Save and Continue</button>
      </div>
    </div>
  </div>
</div>