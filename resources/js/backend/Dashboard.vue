<template>
  <div>
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-5 mb-4 mb-xl-0">
            <h4 class="font-weight-bold">Hi, {{ welcome }}!</h4>
            <h4 class="font-weight-normal mb-0">{{ company }},</h4>
          </div>
          <div class="col-12 col-xl-7">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
              <div class="border-right pr-4 mb-3 mb-xl-0">
                <p class="text-muted">Daily Quiz</p>
                <h4 class="mb-0 font-weight-bold">2550 Q</h4>
              </div>
              <div class="border-right pr-4 mb-3 mb-xl-0">
                <p class="text-muted">Player</p>
                <h4 class="mb-0 font-weight-bold">35 K</h4>
              </div>
              <div class="border-right pr-4 mb-3 mb-xl-0">
                <p class="text-muted">Predicts</p>
                <h4 class="mb-0 font-weight-bold">4006</h4>
              </div>
              <div class="pr-3 mb-3 mb-xl-0">
                <p class="text-muted">Winners</p>
                <h4 class="mb-0 font-weight-bold">2560</h4>
              </div>
              <div class="mb-3 mb-xl-0">
                <button class="btn btn-warning rounded-0 text-white">Refresh</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">Number of Answers</p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">34040</h3>
              <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>  
            <p class="mb-0 mt-2 text-warning">2.00% <span class="text-black ml-1"><small>(30 days)</small></span></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">Number of Users</p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">47033</h3>
              <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>  
            <p class="mb-0 mt-2 text-danger">0.22% <span class="text-black ml-1"><small>(30 days)</small></span></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">Today’s Prediction</p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">40016</h3>
              <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>  
            <p class="mb-0 mt-2 text-success">10.00%<span class="text-black ml-1"><small>(30 days)</small></span></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">Total Enagagement</p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">61344</h3>
              <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>  
            <p class="mb-0 mt-2 text-success">22.00%<span class="text-black ml-1"><small>(30 days)</small></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title mb-0">Top Prediction and Quiz</p>
            <div class="table-responsive">
              <table class="table table-striped table-borderless">
                <thead>
                  <tr>
                    <th>Question</th>
                    <th>Answers</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>  
                </thead>
                <tbody>
                  <tr>
                    <td>Winner of SAAF Championship</td>
                    <td class="font-weight-bold">147181</td>
                    <td>20 Oct 2021</td>
                    <td class="font-weight-medium text-warning">Pending</td>
                  </tr>
                  <tr>
                    <td>Height of Mt. Everest</td>
                    <td class="font-weight-bold">3620</td>
                    <td>21 Sep 2021</td>
                    <td class="font-weight-medium text-success">Completed</td>
                  </tr>
                  <tr>
                    <td>Capital of Nepal</td>
                    <td class="font-weight-bold">11116</td>
                    <td>13 Jun 2021</td>
                    <td class="font-weight-medium text-success">Completed</td>
                  </tr>
                  <tr>
                    <td>National flower of Japan</td>
                    <td class="font-weight-bold">5551</td>
                    <td>28 Sep 2021</td>
                    <td class="font-weight-medium text-warning">Pending</td>
                  </tr>
                  <tr>
                    <td>UCL 2020 Winner </td>
                    <td class="font-weight-bold">55523</td>
                    <td>23 Aug 2020</td>
                    <td class="font-weight-medium text-success">Completed</td>
                  </tr>
                  <tr>
                    <td>PM of Nepal</td>
                    <td class="font-weight-bold">2</td>
                    <td>01 Nov 2020</td>
                    <td class="font-weight-medium text-danger">Cancelled</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="font-weight-bold">$897</td>
                    <td>26 Oct 2018</td>
                    <td class="font-weight-medium text-success">Completed</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 stretch-card">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Charts</p>
                <div class="charts-data">
                  <div class="mt-3">
                    <p class="text-muted mb-0">Engagements</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="progress progress-md flex-grow-1 mr-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <p class="text-muted mb-0">5k</p>
                    </div>
                  </div>
                  <div class="mt-3">
                    <p class="text-muted mb-0">Users</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="progress progress-md flex-grow-1 mr-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <p class="text-muted mb-0">3k</p>
                    </div>
                  </div>
                  <div class="mt-3">
                    <p class="text-muted mb-0">Downloads</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="progress progress-md flex-grow-1 mr-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <p class="text-muted mb-0">992</p>
                    </div>
                  </div>
                  <div class="mt-3">
                    <p class="text-muted mb-0">Visitors</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="progress progress-md flex-grow-1 mr-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <p class="text-muted mb-0">687</p>
                    </div>
                  </div>
                </div>  
              </div>
            </div>
          </div>
          <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
            <div class="card data-icon-card-primary">
              <div class="card-body">
                <p class="card-title text-white">Today top Answering</p>                      
                <div class="row">
                  <div class="col-8 text-white">
                    <h3>3404</h3>
                    <p class="text-white font-weight-light mb-0">The highest number of goal scored by a player in a single season.</p>
                  </div>
                  <div class="col-4 background-icon">
                    <i class="ti-calendar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

  export default {
    components: {
      
    },
    data() {
      return {
        welcome: 'Welcome to Dashboard',
        company: 'Predict and Win'
      };
    },
    methods: {
      
    },
    mounted() {

    },
    created() {
      
    },
  };
</script>
<style>
.el-table .cell{
  padding-left: 0px;
  padding-right: 0px;
}
</style>

