<div class="page-body" id="track_approved_request">
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
            <li class="breadcrumb-item active">Approved Requests</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid"  ng-hide="requestList">
    <div class="card" style="padding: 10px 0px 0px 10px">
      <div class="row">
          <div class="col-12">
              <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="icon-home-tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="icon-home" aria-selected="true" data-bs-original-title="" title="" ng-click="item = ''"><i class="icofont icofont-ui-home"></i>All Request</a></li>
                <li class="nav-item"><a class="nav-link" id="adn_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="profile-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="item = 'Agusan del Norte'"><i class="icofont icofont-list"></i>Agusan del Norte</a></li>
                <li class="nav-item"><a class="nav-link" id="ads_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="contact-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="item = 'Agusan del Sur'"><i class="icofont icofont-list"></i>Agusan del Sur</a></li>
                <li class="nav-item"><a class="nav-link" id="sdn_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="contact-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="item = 'Surigao del Norte'"><i class="icofont icofont-list"></i>Surigao del Norte</a></li>
                <li class="nav-item"><a class="nav-link" id="sds_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="contact-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="item = 'Surigao del Sur'"><i class="icofont icofont-list"></i>Surigao del Sur</a></li>
                <li class="nav-item"><a class="nav-link" id="pdi_tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="contact-icon" aria-selected="false" data-bs-original-title="" title="" ng-click="item = 'Dinagat Islands'"><i class="icofont icofont-list"></i>Dinagat Islands</a></li>
              </ul>
              <div class="tab-content" id="icon-tabContent">
                <div class="tab-pane fade active show" id="icon-home" role="tabpanel" aria-labelledby="icon-home-tab">
                  <table class="table">
                    <tbody>
                        <tr style="cursor: pointer" ng-repeat="request in augmentation_list | filter : item" class="notread" ng-click="requestDetails($event, request)">
                            <td style="width: 10vw">{{request.municipality_name}}, {{request.province_name}}</td>
                            <td style="width: 70vw">
                                Subject: {{request.request_subject}}<br/>
                                Incident Name/Type: {{request.request_incident_name}}<br/><br/>
                                <label class="btn btn-pill btn-xs btn-outline-dark" style="padding: 5px; cursor: pointer" title="DROMIC Report" ng-click="viewFile(request.dromic_report_file)">
                                    <span ng-class="getfileClass2(request.dromic_report_file)"><span style="font-weight: bolder">{{getfileClass(request.dromic_report_file)}}</span></span> {{sliceFile(request.dromic_report_file)}}
                                </label>
                                <label class="btn btn-pill btn-xs btn-outline-dark" style="padding: 5px; cursor: pointer" title="Request Letter" ng-click="viewFile(request.request_letter_file)">
                                  <span ng-class="getfileClass2(request.request_letter_file)"><span style="font-weight: bolder">{{getfileClass(request.request_letter_file)}}</span></span> {{sliceFile(request.request_letter_file)}}
                                </label>
                            </td>
                            <td style="width: 20vw">
                              {{parseDate(request.date_requested)}} <br/><br/>
                              <strong><label class="text-primary">{{request.request_status || ""}}</label></strong><br>
                              <label ng-class="showButton(request.response_letter_file) == 1 ? 'text-success' : 'text-danger'" style="font-size: 10px">
                                <strong>Response Letter: 
                                  <span ng-class="showButton(request.response_letter_file) == 1 ? 'fa fa-check' : 'fa fa-times'"></span>
                                </strong>
                              </label>
                              <label ng-class="showButton(request.assessment_report) == 1 ? 'text-success' : 'text-danger'" style="font-size: 10px">
                                <strong>Assessment Report: 
                                  <span ng-class="showButton(request.assessment_report) == 1 ? 'fa fa-check' : 'fa fa-times'"></span>
                                </strong>
                              </label>
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
  <div class="container-fluid" ng-hide="requestDetail">
      <div class="row">
          <div class="col-12">
            <div class="card" style="padding: 5px">
              <div class="col-md-2 offset-md-10" ng-click="backtorequestList(1);" style="padding: 15px">
                <label class="pull-right" style="cursor: pointer"><span data-feather="x" class="txt-secondary"></span></label>
              </div>
              <div class="card-body">
                <h5 class="modal-title">Request Details <span class="text-primary">({{reqDetails.municipality_name}}, {{reqDetails.province_name}})</span> </h5><br/>
                <table class="table table-bordered">
                  <tr class="table-primary">
                      <td style="vertical-align: middle">Attachments</td>
                      <td>
                        <label class="btn btn-sm" title="{{showButton(response_letter_file) == 1 ? response_letter_file : 'Attach Response Letter'}}" ng-class="showButton(response_letter_file) == 1 ? 'btn-primary' : 'btn-secondary'" ng-click="(showButton(response_letter_file) == 1 ? viewFile(response_letter_file) : attachReplyLetter())"> <span ng-class="(showButton(response_letter_file) == 1 ? 'fa fa-paperclip' : 'fa fa-database')"></span> {{(showButton(response_letter_file) == 1 ? 'Response Letter: '+sliceFile(response_letter_file) : 'Attach Response Letter')}}
                        </label>
                        <label class="btn btn-sm" title="{{showButton(assessment_report_file) == 1 ? assessment_report_file : 'Attach Response Letter'}}" ng-class="showButton(assessment_report_file) == 1 ? 'btn-primary' : 'btn-secondary'" ng-click="(showButton(assessment_report_file) == 1 ? viewFile(assessment_report_file) : attachAssessmentReport())"> <span ng-class="(showButton(assessment_report_file) == 1 ? 'fa fa-paperclip' : 'fa fa-database')"></span> {{(showButton(assessment_report_file) == 1 ? 'Assessment Report: '+sliceFile(assessment_report) : 'Attach Assessment Report')}}
                        </label>
                      </td>
                    </tr>
                  <tbody>
                    <tr><td style="width: 40%">Subject:</td><td style="width: 60%"><strong>{{reqDetails.request_subject}}</strong></td></tr>
                    <tr><td>Incident Name:</td><td><strong>{{reqDetails.request_incident_name}}</strong></td></tr>
                    <tr><td>Incident Date:</td><td><strong>{{parseDate(reqDetails.request_incident_date)}}</strong></td></tr>
                    <tr><td>Families to be Served:</td><td><strong>{{reqDetails.request_estimated_family | number}}</strong></td></tr>
                    <tr><td>Date Requested:</td><td><strong>{{parseDate(reqDetails.date_requested)}}</strong></td></tr>
                    <tr class="table-primary">
                      <th>Requested Items</th>
                      <th>Approved Items</th>
                    </tr>
                    <tr>
                      <td>
                        <table class="table table-bordered">
                          <thead>
                            <tr class="table-warning">
                              <th style="width: 50%">Item</th>
                              <th style="text-align: center">Quantity</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr ng-repeat="item in requested_items">
                              <td>{{item.item_requested}}</td>
                              <td style="text-align: center">{{item.item_quantity | number}}</td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      <td>
                        <table class="table table-bordered">
                          <thead>
                            <tr class="table-success">
                              <th style="width: 50%">Item</th>
                              <th style="text-align: center">Quantity</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr ng-repeat="item in approved_items">
                              <td>{{item.approved_item}}</td>
                              <td style="text-align: center">{{item.approved_quantity | number}}</td>
                            </tr>
                          </tbody>
                        </table>
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

<div class="modal fade" id="attachReplyLetterModal" tabindex="-1" role="dialog" aria-labelledby="requestDetailsModal" aria-hidden="true" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label class="txt-secondary">Please select a file to attach.</label>
        <input class="form-control " type="file" id="response_letter" ng-file="response_letter" accept=".pdf" required><br/>
        <label class="txt-secondary">Add other recipient (Separate each recipient with a comma (,) symbol)...</label>
        <input class="form-control " type="text" id="email_recipient" ng-model="email_recipient">
      </div>
      <div class="modal-footer">
        <span class="loader" ng-show="showloader"></span>
        <button class="btn btn-primary" type="button" ng-click="save_and_send_response_file();"><span class="fa fa-save"></span> Save File and Send to Requesting LGU</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="attachAssessmentReportModal" tabindex="-1" role="dialog" aria-labelledby="requestDetailsModal" aria-hidden="true" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label class="txt-secondary">Please select a file to attach.</label>
        <input class="form-control " type="file" id="assessment_report" ng-file="assessment_report" accept=".pdf" required>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="save_assessment_report();"><span class="fa fa-save"></span> Save Assessment Report</button>
      </div>
    </div>
  </div>
</div>