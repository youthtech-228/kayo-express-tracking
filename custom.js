
jQuery(function() {
  // Function to demonstrate calling grid's API
  function deselect(){
    gridOptions.api.deselectAll()
  }

  // Grid Options are properties passed to the grid
  const gridOptions = {

    // each entry here represents one column
    columnDefs: [
      { field: "Category" },
      { field: "Name" },
      { field: "EventDateTime", headerName: 'Date', sort: 'desc' },
      { field: "Description", tooltipField: 'Description', autoSize: true },
    ],

    // default col def properties get applied to all columns
    defaultColDef: {sortable: true, filter: true},

    rowSelection: 'multiple', // allow rows to be selected
    animateRows: true, // have rows animate to new positions when sorted
    pagination: true,

    // example event handler
    onCellClicked: params => {
      console.log('cell was clicked', params)
    },
    onFirstDataRendered: onFirstDataRendered,
  };

  function onFirstDataRendered(params) {
    params.api.sizeColumnsToFit();
  }
  function autoSizeAll(params) {
    const allColumnIds = [];
    params.columnApi.getColumns().forEach((column) => {
      allColumnIds.push(column.getId());
    });
  
    params.columnApi.autoSizeColumns(allColumnIds, false);
  }
  

  // get div to host the grid
  const eGridDiv = document.getElementById("myGrid");
  // new grid instance, passing in the hosting DIV and Grid Options
  new agGrid.Grid(eGridDiv, gridOptions);

  init();

  $('#btnSearch').on('click', function() {
    const trackNumber = $('#trackingNumber').val();
    if (trackNumber && trackNumber.trim().length > 0) {
      // Fetch data from server
      $('#trackNumberMsg').html('');
      $('#trackNumberMsgContainer').hide();

      //spinner
      $('#resultContainer').hide();
      $('#errorContainer').show();
      $('#spinner').show();
      $('#errorMsg').hide();
      onSearch(trackNumber);
    } else {
      $('#trackNumberMsgContainer').show();
      $('#trackNumberMsg').html('Tracking Number is required!');
    }
  });

  function onSearch(trackNumber = 'GRZ01245VH40KRXHKK4') {
    $.ajax({
      url: './track.php',
      type: 'POST',
      data: { trackNumber },
    })
    .done(function(result) {
      console.log(result);
      const jsonObj = JSON.parse(result);
      const data = jsonObj?.Data || [];
      console.log(jsonObj);
      if (jsonObj?.IsSuccess) {
        if (data.length > 0) {
          generateTableData(data);
          setTrackDetails(data);
          $('#resultContainer').show();
          $('#errorContainer').hide();
        } else {
          $('#resultContainer').hide();
          $('#spinner').hide();
          $('#errorContainer').show();
          $('#errorMsg').html('No Result');
          $('#errorMsg').show();
        }
      } else {
        $('#resultContainer').hide();
        $('#spinner').hide();
        $('#errorContainer').show();
        $('#errorMsg').html(jsonObj?.ErrorMessage);
        $('#errorMsg').show();
      }
      // gridOptions.api.setRowData(data);
    }).fail(function(error) {
      console.log(error);
    });
  }

  function generateTableData(data) {
    const result = [];
    if (data.length > 0 && data[0].Events) {
      data[0].Events.forEach((item) => {
        result.push({
          Category: item.Category,
          Name: item.Name,
          EventDateTime: item.EventDateTime,
          Description: item.Description,
        });
      });
    }
    gridOptions.api.setRowData(result);
  }

  function setTrackDetails(data) {
    if (data.length > 0) {
      const shipperStateCity = `${data[0]?.ShipperCity || ''} ${data[0]?.ShipperProvince || ''}`; 
      $('.shipperStateCity').html(shipperStateCity);
      const consigneeStateCity = `${data[0]?.ConsigneeCity || ''} ${data[0]?.ConsigneeProvince || ''}`; 
      $('.consigneeStateCity').html(consigneeStateCity);
      const service = data[0]?.Service || ''; 
      $('.service').html(service);
      const createDate = data[0]?.CreateDate || ''; 
      $('.createDate').html(createDate);
      const reference1 = data[0]?.Reference1 || ''; 
      $('.reference1').html(reference1);
      const reference2 = data[0]?.Reference2 || ''; 
      $('.reference2').html(reference2);
      const reference3 = data[0]?.Reference3 || ''; 
      $('.reference3').html(reference3);
      const reference4 = data[0]?.Reference4 || ''; 
      $('.reference4').html(reference4);
      const totalPieces = data[0]?.TotalPieces || ''; 
      $('.totalPieces').html(totalPieces);
      const weight = `${data[0]?.Weight || ''} ${data[0]?.UOMWeight}`; 
      $('.weight').html(weight);
    }
  }

  function init() {
    $('#resultContainer').hide();
    $('.shipperStateCity').html('');
    $('.consigneeStateCity').html('');
    $('.service').html('');
    $('.createDate').html('');
    $('.reference1').html('');
    $('.reference2').html('');
    $('.reference3').html('');
    $('.reference4').html('');
    $('.totalPieces').html('');
    $('.weight').html('');

    $('#errorContainer').hide();
    $('#errorMsg').html('');
  }
});