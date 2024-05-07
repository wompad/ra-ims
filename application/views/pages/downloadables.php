  <div class="page-body" id="downloadables">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>
               Downloadables</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard" data-bs-original-title="" title=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
              <li class="breadcrumb-item">Main</li>
              <li class="breadcrumb-item active"> Downloadables</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-3 box-col-6 pe-0">
          <div class="file-sidebar">
            <div class="card">
              <div class="card-body">
                <ul>
                  <li>    
                    <div class="btn btn-outline-dark" ng-click="searchFileID = ''" style="text-align: left"><i data-feather="home"></i>All Files</div>
                  </li>
                  <li>    
                    <div class="btn btn-primary" ng-click="searchFileID = '2'" style="text-align: left"><i data-feather="box"></i>Relief Operation</div>
                  </li>
                  <li>
                    <div class="btn btn-secondary" ng-click="searchFileID = '1'" style="text-align: left"><i data-feather="info"></i>DROMIC</div>
                  </li>
                  <li>
                    <div class="btn btn-info" ng-click="searchFileID = '5'" style="text-align: left"><i data-feather="alert-circle"></i>CCCM and IDP Protection PPTs</div>
                  </li>
                  <li>
                    <div class="btn btn-warning" ng-click="searchFileID = '3'" style="text-align: left"><i data-feather="star"></i>Memos and Guidelines</div>
                  </li>
                  <li>
                    <div class="btn btn-dark" ng-click="searchFileID = '4'" style="text-align: left"><i data-feather="alert-circle"></i>Miscellaneous</div>
                  </li>
                </ul>
                <hr>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-9 col-md-12 box-col-12">
          <div class="file-content">
            <div class="card">
              <div class="card-header">
                <!-- <div class="media">
                  <form class="form-inline" action="#" method="get">
                    <div class="form-group mb-0"><i class="fa fa-search"></i>
                      <input class="form-control-plaintext" type="text" placeholder="Search..." ng-model="searchFile">
                    </div>
                  </form>
                </div> -->
              </div>
              <div class="card-body file-manager">
                <h4 class="mb-3">List of Downloadable Files</h4>
                <ul class="files">
                  <li class="file-box filepreview" ng-class="file-box" ng-repeat="file in downloadablefiles | filter: {document_type_id: searchFileID}" style="margin-left: 15px; margin-bottom: 15px;" >
                    <div class="file-top" title="{{file.file_description}}" style="cursor:pointer">  <i ng-class="getfileClass(file.filename)"></i><i class="fa fa-ellipsis-v f-14 ellips"></i></div>
                    <div class="file-bottom" title="{{file.file_description}}">
                      <h6>{{sliceFile(file.file_description)}}</h6>
                    </div>
                    <hr>
                    <div class="file-bottom" style="margin-top: 10px; text-align: center" >
                      <a class="btn btn-secondary" href="pages/dl_file/{{file.filename}}" download> <i data-feather="download-cloud"></i> 
                      Download</a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>