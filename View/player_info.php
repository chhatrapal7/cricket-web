
<?php
$slug = $_GET['slug'];
?>

<script>
  var slug = "<?php echo $slug; ?>";
</script>

<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/player_info.js"></script>

<div class="content-page" style="background-color: #fff;" ng-controller="playerallinformation">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f2f5f9;
      /* padding:20px; */
      font-family: Arial, Helvetica, sans-serif;
    }

    .player-card {
      max-width: 900px;
      /* margin:auto; */
      margin: auto;
      margin-top: 20px;


      border-radius: 16px;
      overflow: hidden;
      background: #ffffff;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .top-section {
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      color: #fff;
      padding: 25px;
    }

    .player-img {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #fff;
    }

    .badge-role {
      background: #ffc107;
      color: #000;
      font-weight: 600;
    }

    .info-box {
      background: #f8f9fc;
      border-radius: 10px;
      padding: 12px 15px;
      font-size: 14px;
      color: #0f172a;
      /* value */
    }

    .info-box b {
      color: #475569;
      /* label */
    }



    .stat-box {
      background: #eef2f7;
      border-radius: 12px;
      padding: 15px;
      text-align: center;
    }

    .stat-box h4 {
      margin: 0;
      font-weight: 700;
      color: #1e3c72;
    }

    .stat-box span {
      font-size: 13px;
      color: #555;
    }
  </style>

  <body>

    <div class="player-card">

      <!-- Player Basic Detail -->
      <div class="top-section">
        <div class="row align-items-center g-3">
          <div class="col-md-3 text-center">
            <img src="../images/{{info.imgname}}" class="player-img" alt="Player">
          </div>
          <div class="col-md-9" >
            <h2 class="mb-1">{{info.pl_name}}</h2>
            <span class="badge badge-role">{{info.pl_status}}</span>
            <div class="row mt-3 g-2">
              <div class="col-sm-4">
                <div class="info-box"><b>Age:</b> {{info.pl_age}} Years</div>
              </div>
              <div class="col-sm-4">
                <div class="info-box"><b>Mobile:</b> {{info.pl_number}}</div>
              </div>
              <div class="col-sm-4">
                <div class="info-box"><b>Address:</b> {{info.pl_city}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Performance Section -->
      <div class="p-4">
        <div class="row g-3">
          <div class="col-6 col-md-3">
            <div class="stat-box">
              <h4>8450</h4><span>Total Runs</span>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="stat-box">
              <h4>120</h4><span>Total Wickets</span>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="stat-box">
              <h4>210</h4><span>Total 4s</span>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="stat-box">
              <h4>145</h4><span>Total 6s</span>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="stat-box">
              <h4>46.8</h4><span>Average</span>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="stat-box">
              <h4>138.5</h4><span>Strike Rate</span>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="stat-box">
              <h4>6.2</h4><span>Economy</span>
            </div>
          </div>
        </div>
      </div>

    </div>

  </body>

</div>