<div class="page-body"  id="ec_list">
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
            <li class="breadcrumb-item"> Evacuation Centers</li>
            <li class="breadcrumb-item active">EC List and Reports</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-xl-12 xl-100">
        <div class="card height-equal" ng-hide="hideList">
          <div class="card-header">
            <h5>Profiled Evacuation Centers</h5>
            <span>This evacuation centers list is based on the profiled evacuation centers using the <a href="https://kc.humanitarianresponse.info" target="_blank">KOBO Collect App</a>. Kindly continue on using the application when profiling our evacuation centers so that we can update this list base on your submissions. </span> 
          </div>
          <div class="card-body">
            <ul class="nav nav-dark" id="pills-darktab" role="tablist">
              <li class="nav-item"><a class="nav-link active" id="pills-eclist-tab" data-bs-toggle="pill" href="#pills-eclist" role="tab" aria-controls="pills-eclist" aria-selected="true"><i class="icofont icofont-ui-home"></i>Evacuation Centers List</a></li>
              <li class="nav-item"><a class="nav-link" id="pills-summary_report-tab" data-bs-toggle="pill" href="#pills-summary_report" role="tab" aria-controls="pills-summary_report" aria-selected="false"><i class="icofont icofont-chart-bar-graph"></i>Summary and Reports</a></li>
            </ul>
            <div class="tab-content" id="pills-darktabContent">
              <div class="tab-pane fade show active" id="pills-eclist" role="tabpanel" aria-labelledby="pills-eclist-tab">
                <br/>
                <table class="table table-bordered table-hover table-responsive">
                  <thead>
                    <tr >
                      <td colspan="11"><input type="text" ng-model="searchEC" class="form-control" placeholder="Search list..."></td>
                      <td colspan="1">
                        <select class="form-control" ng-change="get_ECs(offset_pagenumber.num);" ng-model="offset_pagenumber" ng-options="x as x.num for x in pagenumber" style="text-align: center">
                        </select>
                      </td>
                    </tr>
                    <tr> 
                      <th></th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Province</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Mun.</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Evacuation Center Name</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Brgy. Located</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Type of Building</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Availability Status</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Floor Area (sqm.)</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Capacity (Families)</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Capacity (Individual)</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">No. of Rooms</th>
                      <th style="text-align: center" class="d-none d-sm-table-cell">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="ec in ec_lists | filter:searchEC" style="cursor: pointer">
                      <td style="vertical-align: middle">{{((100*offset_pagenumber.num)-100)+$index+1 | number}}</td>
                      <td style="vertical-align: middle">{{ec.province}}</td>
                      <td style="vertical-align: middle">{{ec.city_municipality}}</td>
                      <td style="vertical-align: middle">{{ec.name_of_evacuation_center}}</td>
                      <td style="vertical-align: middle" class="d-none d-sm-table-cell">{{ec.barangay}}</td>
                      <td style="vertical-align: middle" class="d-none d-sm-table-cell">{{ec.type_of_building}}</td>
                      <td style="text-align: center; vertical-align: middle" class="d-none d-sm-table-cell">{{ec.availability_status}}</td>
                      <td style="text-align: center; vertical-align: middle" class="d-none d-sm-table-cell">{{ec.floor_area | number}}</td>
                      <td style="text-align: center; vertical-align: middle" class="d-none d-sm-table-cell">{{ec.capacity_family  | number}}</td>
                      <td style="text-align: center; vertical-align: middle" class="d-none d-sm-table-cell">{{ec.capacity_individuals  | number}}</td>
                      <td style="text-align: center; vertical-align: middle" class="d-none d-sm-table-cell">{{ec.no_of_rooms}}</td>
                      <td style="text-align: center">
                        <button class="btn btn-primary btn-xs" ng-click="viewECDetails(ec);"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-info btn-xs" ng-click="editECDetails(ec);"><i class="fa fa-pencil"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="pills-summary_report" role="tabpanel" aria-labelledby="pills-summary_report-tab">
                <br>
                <div class="card">
                  <div class="card-body">
                    <h5 class="txt-secondary">Number of Profiled ECs per City/Municipality</h5>
                    <div class="col-sm-12">
                      <div id="container_brgy"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th style="text-align: center">City/Municipality</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_muni">
                          <td>{{item.name}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_muni) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">Type of Buildings</h5>
                    <div class="col-sm-12">
                      <div id="container_type_of_buildings"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th style="text-align: center">Type of Building</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_type_of_building">
                          <td>{{item.name || 'Others'}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_type_of_building) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">Building Status</h5>
                    <div class="col-sm-12">
                      <div id="container_building_status"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th style="text-align: center">Building Status</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_building_status">
                          <td>{{item.name || 'Others'}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_building_status) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">Availability Status</h5>
                    <div class="col-sm-12">
                      <div id="container_availability_status"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th style="text-align: center">Availability Status</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_availability_status">
                          <td>{{item.name || 'Others'}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_availability_status) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">FFP Storage Availability</h5>
                    <div class="col-sm-12">
                      <div id="container_ffp_storage_availability"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th style="text-align: center">FFP Storage Availability</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_ffps_storage_availability">
                          <td>{{item.name || 'Others'}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_ffps_storage_availability) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">Compost Pit Latrines</h5>
                    <div class="col-sm-12">
                      <div id="container_compost_pit_latrine"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr> 
                          <th style="text-align: center">Number of Compost Pit Latrine</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_compost_pit_latrine">
                          <td>{{item.name || 'Others'}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_compost_pit_latrine) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">Female Comfort Rooms</h5>
                    <div class="col-sm-12">
                      <div id="container_female_cr"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr> 
                          <th style="text-align: center">Number of Female Comfort Rooms</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_female_cr">
                          <td>{{item.name || 'Others'}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_female_cr) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">Male Comfort Rooms</h5>
                    <div class="col-sm-12">
                      <div id="container_male_cr"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr> 
                          <th style="text-align: center">Number of Male Comfort Rooms</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_male_cr">
                          <td>{{item.name || 'Others'}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_male_cr) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">Common Comfort Rooms</h5>
                    <div class="col-sm-12">
                      <div id="container_common_cr"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr> 
                          <th style="text-align: center">Number of Common Comfort Rooms</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_common_cr">
                          <td>{{item.name || 'Others'}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_common_cr) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">Source of Potable water</h5>
                    <div class="col-sm-12">
                      <div id="container_source_of_potable_water"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr> 
                          <th style="text-align: center">Source of Potable Water</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_source_of_potable_water">
                          <td>{{item.name || 'Others'}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_source_of_potable_water) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h5 class="txt-secondary">Source of Non Potable water</h5>
                    <div class="col-sm-12">
                      <div id="container_source_of_non_potable_water"></div>
                    </div>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr> 
                          <th style="text-align: center">Source of Non-Potable Water</th>
                          <th style="text-align: center">Frequency</th>
                          <th style="text-align: center">Percentage (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="item in data_source_of_non_potable_water">
                          <td>{{item.name || Others}}</td>
                          <td style="text-align: center">{{item.y}}</td>
                          <th style="text-align: center">{{calculateAve(item.y) | number:2}}</th>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <th style="text-align: center">{{getItemTotal(data_source_of_non_potable_water) | number}}</th>
                          <th style="text-align: center">100.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card"  ng-hide="hideDetails">
          <div class="card-header">
            <h5 class="txt-secondary">Evacuation Center Detail -> <span class="txt-primary">{{ecDetail.name_of_evacuation_center}}</span></h5>
            <button class="pull-right btn btn-danger" style="margin-top: -30px;" ng-click="hideList = false; hideDetails = true; hideEditDetails = true;">
              <span class="fa fa-times-circle"></span> Back to List
            </button>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Evacuation Center Location</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">Region</th>
                <td>{{ecDetail.region}}</td>
              </tr>
              <tr>
                <th>Province</th>
                <td>{{ecDetail.province}}</td>
              </tr>
              <tr>
                <th>City/Municipality</th>
                <td>{{ecDetail.city_municipality}}</td>
              </tr>
              <tr>
                <th>GPS Coordinates</th>
                <td>
                  Latitude (x°y): {{ecDetail._gps_coordinates_latitude}} <br>
                  Longitude (x°y): {{ecDetail._gps_coordinates_longitude}} <br>
                  Altitude (m): {{ecDetail._gps_coordinates_altitude}} <br>
                  Accuracy (m): {{ecDetail._gps_coordinates_precision}}
                </td>
              </tr>
              <tr>
                <th>Barangay</th>
                <td>{{ecDetail.barangay}}</td>
              </tr>
              <tr>
                <th>Sitio/Purok</th>
                <td>{{ecDetail.address}}</td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Evacuation Center Information</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">Evacuation Center Name</th>
                <td>{{ecDetail.name_of_evacuation_center}}</td>
              </tr>
              <tr>
                <th>Type of Building</th>
                <td>{{ecDetail.type_of_building}}</td>
              </tr>
              <tr>
                <th>Availability Status</th>
                <td>{{ecDetail.availability_status}}</td>
              </tr>
              <tr>
                <th>Building Status</th>
                <td>
                  {{ecDetail.building_status}} <br>
                </td>
              </tr>
              <tr>
                <th>Floor Area (sqm.)</th>
                <td>{{ecDetail.floor_area | number}}</td>
              </tr>
              <tr>
                <th>Capacity in terms of Families</th>
                <td>{{ecDetail.capacity_family | number}}</td>
              </tr>
              <tr>
                <th>Capacity in terms of Individuals</th>
                <td>{{ecDetail.capacity_individuals | number}}</td>
              </tr>
              <tr>
                <th>Available No. of Rooms</th>
                <td>{{ecDetail.no_of_rooms}}</td>
              </tr>
              <tr>
                <th>Availability of FFP Storage</th>
                <td>{{ecDetail.ffps_storage_availability}}</td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Solid Waste Management</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">Material Recycling Facility</th>
                <td>{{ecDetail.material_recycling_facility}}</td>
              </tr>
              <tr>
                <th>Compost Pit (Latrine)</th>
                <td>{{ecDetail.compost_pit_latrine}}</td>
              </tr>
              <tr>
                <th>Sealed Latrines</th>
                <td>{{ecDetail.sealed_latrines}}</td>
              </tr>
              <tr>
                <th>Female Comfort Room</th>
                <td>{{ecDetail.female_cr}}</td>
              </tr>
              <tr>
                <th>Male Comfort Room</th>
                <td>{{ecDetail.male_cr}}</td>
              </tr>
              <tr>
                <th>Common Comfort Room</th>
                <td>{{ecDetail.common_cr}}</td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Evacuation Center Facilities</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">name of Designated Camp Manager</th>
                <td>{{ecDetail.name_of_designated_camp_manager}}</td>
              </tr>
              <tr>
                <th>Material Recycling Facility</th>
                <td>{{ecDetail.material_recycling_facility}}</td>
              </tr>
              <tr>
                <th>Source of Potable Water</th>
                <td>{{ecDetail.source_of_potable_water}}</td>
              </tr>
              <tr>
                <th>Source of Non-Potable Water</th>
                <td>{{ecDetail.source_of_non_potable_water}}</td>
              </tr>
              <tr>
                <th>Child Friendly Spaces</th>
                <td>{{ecDetail.child_friendly_spaces}}</td>
              </tr>
              <tr>
                <th>Women Friendly Spaces</th>
                <td>{{ecDetail.women_friendly_spaces}}</td>
              </tr>
              <tr>
                <th>Couples Room</th>
                <td>{{ecDetail.couples_room}}</td>
              </tr>
              <tr>
                <th>Prayer Room</th>
                <td>{{ecDetail.prayer_room}}</td>
              </tr>
              <tr>
                <th>Community Kitchen</th>
                <td>{{ecDetail.community_kitchen}}</td>
              </tr>
              <tr>
                <th>Availability of WASH Facilities</th>
                <td>{{ecDetail.availability_of_wash_facilities}}</td>
              </tr>
              <tr>
                <th>Ramp (for PWDs)</th>
                <td>{{ecDetail.ramp_for_pwds}}</td>
              </tr>
              <tr>
                <th>Help Desk</th>
                <td>{{ecDetail.help_desk}}</td>
              </tr>
              <tr>
                <th>Info Boards</th>
                <td>{{ecDetail.info_boards}}</td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Evacuation Center Facilities</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">The LGU has established Camp Management Committee</th>
                <td>{{ecDetail.has_cccm_committee}}</td>
              </tr>
              <tr>
                <th>Number of trained personnel on Camp Coordination and Camp Management (CCCM)</th>
                <td>{{ecDetail.number_trained_cccm}}</td>
              </tr>
              <tr>
                <th>Number of trained personnel on management of Child-Friendly Spaces (CFS)</th>
                <td>{{ecDetail.number_trained_cfs}}</td>
              </tr>
              <tr>
                <th>Number of trained personnel on management of Women-Friendly Spaces (WFS)</th>
                <td>{{ecDetail.number_trained_wfs}}</td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th>Evacuation Center Photos</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 100%">
                  <img ng-repeat="photo in spec_photos track by $index"
                  class="img-thumbnail" 
                  alt="<?php echo base_url(); ?>{{'uploads_ecphotos/'+photo}}" 
                  src="<?php echo base_url(); ?>{{'uploads_ecphotos/'+photo}}" 
                  style="height: 400px; width: 400px; margin-left: 5px; margin-bottom: 5px; cursor: pointer">
                </th>
              </tr>
            </table>
          </div>
        </div>
        <div class="card" ng-hide="hideEditDetails">
          <div class="card-header">
            <h5>Edit Evacuation Centers Details</h5>
            <button class="pull-right btn btn-danger" style="margin-top: -30px;" ng-click="hideList = false; hideDetails = true; hideEditDetails = true">
              <span class="fa fa-chevron-left"></span> Back to List
            </button>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Evacuation Center Location</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">Region</th>
                <td>{{ecDetail.region}}</td>
              </tr>
              <tr>
                <th>Province</th>
                <td>{{ecDetail.province}}</td>
              </tr>
              <tr>
                <th>City/Municipality</th>
                <td>{{ecDetail.city_municipality}}</td>
              </tr>
              <tr>
                <th>GPS Coordinates</th>
                <td>
                  <table class="table table-condensed">
                    <tbody>
                      <tr>
                        <td>Latitude (x°y): </td>
                        <td><input type="text" class="form-control" ng-model="evacuation_center._gps_coordinates_latitude"></td>
                      </tr>
                      <tr>
                        <td>Longitude (x°y): </td>
                        <td><input type="text" class="form-control" ng-model="evacuation_center._gps_coordinates_longitude"></td>
                      </tr>
                      <tr>
                        <td>Altitude (m): </td>
                        <td><input type="text" class="form-control" ng-model="evacuation_center._gps_coordinates_altitude"></td>
                      </tr>
                      <tr>
                        <td>Accuracy (m): </td>
                        <td><input type="text" class="form-control" ng-model="evacuation_center._gps_coordinates_precision"></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <th>Barangay</th>
                <td>{{ecDetail.barangay}}</td>
              </tr>
              <tr>
                <th>Sitio/Purok</th>
                <td>{{ecDetail.address}}</td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Evacuation Center Information</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">Evacuation Center Name</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.name_of_evacuation_center"></td>
              </tr>
              <tr>
                <th>Type of Building</th>
                <td>
                  <select class="form-control" ng-options="x as x.lib_name for x in type_of_building track by x.id" ng-model="evacuation_center.type_of_building"></select>
                </td>
              </tr>
              <tr>
                <th>Availability Status</th>
                <td>
                  <select class="form-control" ng-options="x as x.lib_name for x in availability_status track by x.id" ng-model="evacuation_center.availability_status"></select>
                </td>
              </tr>
              <tr>
                <th>Building Status</th>
                <td>
                  <select class="form-control" ng-options="x as x.lib_name for x in building_status track by x.id" ng-model="evacuation_center.building_status"></select>
                </td>
              </tr>
              <tr>
                <th>Floor Area (sqm.)</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.floor_area"></td>
              </tr>
              <tr>
                <th>Capacity in terms of Families</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.capacity_family"></td>
              </tr>
              <tr>
                <th>Capacity in terms of Individuals</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.capacity_individuals"></td>
              </tr>
              <tr>
                <th>Available No. of Rooms</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.no_of_rooms"></td>
              </tr>
              <tr>
                <th>Availability of FFP Storage</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.ffps_storage_availability">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Solid Waste Management</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">Material Recycling Facility</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.material_recycling_facility"></td>
              </tr>
              <tr>
                <th>Compost Pit (Latrine)</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.compost_pit_latrine"></td>
              </tr>
              <tr>
                <th>Sealed Latrines</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.sealed_latrines"></td>
              </tr>
              <tr>
                <th>Female Comfort Room</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.female_cr"></td>
              </tr>
              <tr>
                <th>Male Comfort Room</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.male_cr"></td>
              </tr>
              <tr>
                <th>Common Comfort Room</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.common_cr"></td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Evacuation Center Facilities</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">Name of Designated Camp Manager</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.name_of_designated_camp_manager"></td>
              </tr>
              <tr>
                <th>Material Recycling Facility</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.material_recycling_facility"></td>
              </tr>
              <tr>
                <th>Source of Potable Water</th>
                <td>
                  <select class="form-control" ng-options="x as x.lib_name for x in source_of_water track by x.id" ng-model="evacuation_center.source_of_potable_water"></select>
                </td>
              </tr>
              <tr>
                <th>Source of Non-Potable Water</th>
                <td>
                  <select class="form-control" ng-options="x as x.lib_name for x in source_of_water track by x.id" ng-model="evacuation_center.source_of_non_potable_water"></select>
                </td>
              </tr>
              <tr>
                <th>Child Friendly Spaces</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.child_friendly_spaces">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Women Friendly Spaces</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.women_friendly_spaces">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Couples Room</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.couples_room">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Prayer Room</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.prayer_room">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Community Kitchen</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.community_kitchen">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Availability of WASH Facilities</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.availability_of_wash_facilities">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Ramp (for PWDs)</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.ramp_for_pwds">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Help Desk</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.help_desk">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Info Boards</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.info_boards">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th colspan="2">Evacuation Center Facilities</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 50%">The LGU has established Camp Management Committee</th>
                <td>
                  <select class="form-control"ng-model="evacuation_center.has_cccm_committee">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Number of trained personnel on Camp Coordination and Camp Management (CCCM)</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.number_trained_cccm"></td>
              </tr>
              <tr>
                <th>Number of trained personnel on management of Child-Friendly Spaces (CFS)</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.number_trained_cfs"></td>
              </tr>
              <tr>
                <th>Number of trained personnel on management of Women-Friendly Spaces (WFS)</th>
                <td><input type="text" class="form-control" ng-model="evacuation_center.number_trained_wfs"></td>
              </tr>
            </table>
            <br>
            <table class="table table-bordered">
              <thead class="bg-primary">
                <tr>
                  <th>Evacuation Center Photos</th>
                </tr>
              </thead>
              <tr>
                <th style="width: 100%">
                  <img ng-repeat="photo in spec_photos track by $index"
                  class="img-thumbnail" 
                  alt="<?php echo base_url(); ?>{{'uploads_ecphotos/'+photo.Photo}}" 
                  src="<?php echo base_url(); ?>{{'uploads_ecphotos/'+photo.Photo}}" 
                  style="height: 400px; width: 400px; margin-left: 5px; margin-bottom: 5px; cursor: pointer">
                  <button type="button" class="btn btn-light" style="width: 100px; height: 100px; border-radius: 100%" ng-click="viewEC();" data-toggle="modal" data-target="#exampleModalCenter">
                    <span style="font-size: 50px">+</span>
                  </button>
                </th>
              </tr>
            </table>
            <br/>
            <button type="button" class="btn btn-info pull-right" ng-click="saveECDetails();"><i class="fa fa-check"></i> Save Changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
        