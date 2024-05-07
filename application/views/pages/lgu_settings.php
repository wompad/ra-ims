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
            <li class="breadcrumb-item active"> Settings</li>
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

  <div class="container-fluid" style="margin-top: -40px">
    <div class="row">
      <div class="col-sm-12 col-xl-6">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Security Settings</h5><span>Change your <a href="#">Firebase<span>&#174;</span> </a> password to manage your account.</span>
              </div>
              <div class="card-body">
                <form class="theme-form">
                  <div class="mb-3 row" style="display: none">
                    <label class="col-sm-3 col-form-label" for="email_address">Email</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="email_address" type="email" placeholder="Email" value="<?=$_SESSION['email_address'] ?>" ng-disabled="1">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="password">Current Password</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="password" type="password" placeholder="Current Password">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="newPassword">New Password</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="newPassword" type="password" placeholder="New Password">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="confirmPassword">Confirm New Password</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm New Password">
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer text-end">
                <button class="btn btn-primary" id="save_changes_password">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        