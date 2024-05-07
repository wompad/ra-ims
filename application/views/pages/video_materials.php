<div class="page-body" id="video_materials">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h3>
             CCCM and IDP Protection Video Materials
           </h3>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard" data-bs-original-title="" title=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
            <li class="breadcrumb-item">Main</li>
            <li class="breadcrumb-item"> Video Materials</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-4 box-col-6 pe-0">
        <div class="file-sidebar">
          <div class="card">
            <div class="card-header">
                <h5 class="mb-3">Playlist</h5>
            </div>
            <div class="card-body">
              <ul>
                <li ng-repeat="video in video_materials">    
                  <div class="btn btn-outline-dark" id="{{'video' + $index}}" ng-class="($index == 0 ? 'active' : '')" ng-click="playVideo(video, $index)" ng-model="description" style="text-align: justify">{{video.file_description}}</div>
                </li>
              </ul>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-8 col-md-12 box-col-12">
        <div class="file-content">
          <div class="card">
            <div class="card-body">
              <div id="video_container">
                <video style="width: 100%;" controls>
                  <source src="{{video_file}}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
              <h5>Playing >>> {{file_description}}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>