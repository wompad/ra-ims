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
            <li class="breadcrumb-item">Evacuation Centers</li>
            <li class="breadcrumb-item active"> View EC Map</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card" ng-hide="hideList">
          <div class="card-header">
            <h5 class="text-primary">Geotagged Location of Profiled Evacuation Centers</h5>
            <span>This evacuation centers list is based on the profiled evacuation centers using the <a href="https://kc.humanitarianresponse.info" target="_blank">KOBO Collect App</a>. Kindly continue on using the application when profiling our evacuation centers so that we can update this list base on your submissions. </span> 
          </div>
          <div class="card-body" id="map" style="height: 1000px; z-index: 1">
          </div>
        </div>
        <div class="card"  ng-hide="hideDetails">
          <div class="card-header">
            <h5 class="txt-secondary">Evacuation Center Detail -> <span class="txt-primary">{{ecDetail.name_of_evacuation_center}}</span></h5>
            <button class="pull-right btn btn-danger" style="margin-top: -30px;" ng-click="hideList = false; hideDetails = true">
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
                <td>{{ecDetail.floor_area}}</td>
              </tr>
              <tr>
                <th>Capacity in terms of Families</th>
                <td>{{ecDetail.capacity_family}}</td>
              </tr>
              <tr>
                <th>Capacity in terms of Individuals</th>
                <td>{{ecDetail.capacity_individuals}}</td>
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
                  alt="{{'../uploads_ecphotos/'+photo}}" 
                  src="{{'../uploads_ecphotos/'+photo}}" 
                  style="height: 400px; width: 400px; margin-left: 5px; margin-bottom: 5px; cursor: pointer">
                </th>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      