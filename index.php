<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kayo Express</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
  <link rel="manifest" href="./favicon/site.webmanifest">
  <link rel="mask-icon" href="./favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- Include the JS for AG Grid -->
  <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>
  <!-- Include the core CSS, this is needed by the grid -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community/styles/ag-grid.css"/>
  <!-- Include the theme CSS, only need to import the theme you are going to use -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community/styles/ag-theme-alpine.css"/>
  <link rel="stylesheet" href="./custom.css" />
  <script src="./custom.js"></script>
</head>
<body>

<div class="container-fluid p-3 bg-primary text-white text-center">
  <div class="row">
    <div class="col-12">
      <div class="d-flex align-items-center">
        <div>
          <img src="./KayoExpressFINAL.png" class="img float-start" id="img-logo" alt="Kayo Express Logo" />
        </div>
        <div class="flex-grow-1">
          <h1>Track a package</h1>
        </div>
      </div>
    </div>
  </div>
</div>
  
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-12 my-3">
      <div class="d-flex">
        <input type="text" class="form-control me-3" placeholder="Enter tracking number here" id="trackingNumber" value="" />
        <button type="button" class="btn btn-primary" id="btnSearch">Search</button>
      </div>
      <div class="trackNumberMsgContainer">
        <span id="trackNumberMsg"></span>
      </div>
    </div>
    <div class="col-sm-12" id="resultContainer">
      <div class="row">
        <div class="col-sm-12 my-3" id="detailsContainer">
          <div class="row mb-2">
            <div class="col-3">
                <span class="fw-bold">From: </span>
                <span class="shipperStateCity"></span>
            </div>
            <div class="col-3">
              <span class="fw-bold">Destination: </span>
              <span class="consigneeStateCity"></span>
            </div>
            <div class="col-3">
              <span class="fw-bold">Service: </span>
              <span class="service"></span>
            </div>
            <div class="col-3">
              <span class="fw-bold">Created on: </span>
              <span class="createDate"></span>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-3">
              <span class="fw-bold">Reference 1: </span>
              <span class="reference1"></span>
            </div>
            <div class="col-3">
              <span class="fw-bold">Reference 2: </span>
              <span class="reference2"></span>
            </div>
            <div class="col-3">
              <span class="fw-bold">Reference 3: </span>
              <span class="reference3"></span>
            </div>
            <div class="col-3">
              <span class="fw-bold">Reference 4: </span>
              <span class="reference4"></span>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-3">
              <span class="fw-bold">Total Pieces: </span>
              <span class="totalPieces"></span>
            </div>
            <div class="col-3">
              <span class="fw-bold">Weight: </span>
              <span class="weight"></span>
            </div>
          </div>
        </div>
        <div class="col-sm-12 my-3">
          <div id="myGrid" class="ag-theme-alpine" style="height: 500px"></div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 my-3" id="errorContainer">
      <div class="msgContainer">
        <span id="errorMsg"></span>
        <div class="spinner-border text-primary" id="spinner" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
