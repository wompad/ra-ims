<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h3>
             User Pofile</h3>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard" data-bs-original-title="" title=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
            <li class="breadcrumb-item">Main</li>
            <li class="breadcrumb-item active"> User Profile</li>
            <li class="breadcrumb-item active"> About</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">

      <div class="row">
        <div class="col-sm-12">
          <div class="user-profile">
            <div class="row">
              <!-- user profile first-style start-->
              <div class="col-sm-12">
                <div class="card hovercard text-center">
                  <div class="cardheader" style="background:url(uploads_banner/{{tmp_banner}})">
                    <input class="form-control" type="file" style="display: none" id="file_banner" ng-file="user.profile_banner" accept="image/x-png,image/jpeg" custom-on-change="uploadFileBanner">
                    <div class="icon-wrapper pull-right" ng-click="selectProfileBanner();" style="cursor: pointer; margin-top: 15px; margin-right: 10px">
                      <i data-feather="camera"></i>
                    </div>
                  </div>
                  <div class="user-image">
                    <div class="avatar"><img alt="" src="uploads_profile/{{tmp_profile}}"></div>
                    <input class="form-control" type="file" style="display: none" id="file_profile" ng-file="user.profile_pic" accept="image/x-png,image/jpeg" custom-on-change="uploadFile">
                    <div class="icon-wrapper" ng-click="selectProfile();"><i data-feather="camera"></i></div>
                  </div>
                  <div class="info">
                    <div class="row">
                      <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="ttl-info text-start">
                              <h6><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;Agency/LGU</h6><span>{{office_name}}</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="ttl-info text-start">
                              <h6></h6><span> {{municipality_name}}, {{province_name}}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                        <div class="user-designation">
                          <div class="title txt-info">{{tmpfirstname}} {{tmplastname}}</div>
                          <div class="desc txt-info">{{user.position}}</div>
                        </div>
                        <div class="desc txt-primary">"{{tmp_bio}}"</div>
                      </div>
                      <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="ttl-info text-start">
                              <h6><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;Contact Number</h6><span>{{user.contact_number}}</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="ttl-info text-start">
                              <h6><i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;Email</h6><span> {{user.email_address}}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="social-media">
                      <ul class="list-inline">
                        <li class="list-inline-item"><a href="https://{{user.fb}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="https://{{user.instagram}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="https://{{user.twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>

  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title mb-0">My Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <form novalidate>
                <div class="row mb-2">
                  <div class="profile-title">
                    <div class="media">                        <img class="rounded-circle" alt="" src="uploads_profile/{{tmp_profile}}" style="width: 100px; height: 100px">
                      <div class="media-body">
                        <h5 class="mb-1">{{tmpfirstname}} {{tmplastname}}</h5>
                        <p>{{user.position}}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <h6 class="form-label">Bio</h6>
                  <textarea class="form-control" rows="5" ng-model="user.bio" placeholder="Enter your profile bio">On the other hand, we denounce with righteous indignation</textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Position/Designation <code class="text-danger">*</code></label>
                  <input class="form-control" placeholder="your-email@domain.com" ng-model="user.position">
                </div>
                <div class="mb-3">
                  <label class="form-label">Social Media Accounts</label>
                  <input class="form-control" placeholder="e.g. www.facebook.com/profile-name/" ng-model="user.fb">
                </div>
                <div class="mb-3">
                  <input class="form-control" placeholder="e.g. www.instagram.com/account-name/" ng-model="user.instagram">
                </div>
                <div class="mb-3">
                  <input class="form-control" placeholder="e.g. www.twitter.com/feed/" ng-model="user.twitter">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <form class="card" novalidate>
            <div class="card-header">
              <h4 class="card-title mb-0">Edit Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group" ng-show="user.invalidUserinputv2().length > 0">
                  <label class="text-danger">
                    Kindly review your entries and fill-out the required fields
                  </label>
                  <ul class="text-danger">
                    <li ng-repeat="error in user.invalidUserinputv2()"><code class="text-danger">*</code> {{error}}</li>
                  </ul>
                </div>
              </div>

              <div class="row" style="margin-top: 15px">
                <div class="form-group">
                  <label class="col-form-label pt-0">Agency/Local Government Unit <code class="text-danger">*</code></label>
                  <div class="row g-2">
                    <div class="mb-2 col-sm-6">
                      <select class="js-example-basic-single" required="" name="province" ng-options="x as x.province_name for x in provinces track by x.psgc_code" ng-model="user.province" ng-change="insertSelectMunicipality();" ng-disabled="1">
                      </select>
                    </div>
                    <div class="mb-2 col-sm-6">
                      <select class="js-example-basic-single" name="municipality" ng-options="x as x.municipality_name for x in municipalities | filter: {province_psgc : user.province.psgc_code }: true track by x.psgc_code" ng-model="user.municipality" disabled>
                      </select>
                      <span ng-show="user.municipality.psgc_code == 0 && userForm.municipality.$touched" class="text-danger">City/Municipality is required</span>
                    </div>
                  </div>
                </div>
                <div class="form-group" style="margin-top: 5px">
                  <label class="col-form-label pt-0">Your Name <code class="text-danger">*</code></label>
                  <div class="row g-2">
                    <div class="col-4">
                      <input class="form-control" type="text" required placeholder="First name" name="firstname" ng-model="user.firstname">
                    </div>
                    <div class="col-4">
                      <input class="form-control" type="text" name="middlename" placeholder="Middle name" ng-model="user.middlename">
                    </div>
                    <div class="col-4">
                      <input class="form-control" type="text" required name="lastname" placeholder="Last name" ng-model="user.lastname">
                    </div>
                  </div>
                </div>
                <div class="form-group" style="margin-top: 10px">
                  <label class="col-form-label pt-0">Your Address and Contact Number <code class="text-danger">*</code></label>
                  <div class="row g-2">
                    <div class="col-6">
                      <input class="form-control" type="text" required placeholder="Address" ng-model="user.address">
                    </div>
                    <div class="col-6">
                      <input class="form-control" type="text" required placeholder="Contact Number" ng-model="user.contact_number">
                    </div>
                  </div>
                </div>
                </div>
                <div class="form-group" style="margin-top: 10px">
                  <div class="col-md-12">
                    <div>
                      <label class="form-label">About Me</label>
                      <textarea class="form-control" rows="5" placeholder="Enter About your description" ng-model="user.description">
                      </textarea>
                    </div>
                  </div>
                   <button class="btn btn-primary pull-right" type="submit" style="margin-top: 15px" ng-click="confirmChanges();">Save Changes</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
        