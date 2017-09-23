var CONFIG = {
    ENVIRONMENT : 'ENV',
    API_HOST : 'http://88.198.58.113',

    LOGIN_ENDPOINT : '/login',

    PARKING_SPOTS_ENDPOINT : '/api/v1/parkings',

    SEARCH_PAGE : '/view/search.html',
    SEARCH_AVAILABLE_SPOTS_ENDPOINT : '/api/v1/parking/slots',

    BOOKING_PAGE : '/view/available-slots.html',
    BOOK_SPOT_ENDPOINT : '/api/v1/reservations',

    LET_ME_IN_PAGE: '/view/unlock.html',
    LET_ME_IN_ENDPOINT: '/unlock'
};

$(document).ready(function() {
   getParkingHubs();
});

var availableSpots;
var priceForSelectedSpot;
var checkInDate;
var checkOutDate;
var selectedParkingId;
var allParkingHubs = [];

var login = function() {
    var email = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        url: CONFIG.API_HOST + CONFIG.LOGIN_ENDPOINT,
        method: 'POST',
        data: {
            email : email,
            password : password
        },
        beforeSend : function(xhr,opts) {
            console.log('Sending email: ' +email + ' pass: ' + password);
            if(CONFIG.ENVIRONMENT == 'DEV') {
                xhr.abort();
                window.location.href = CONFIG.SEARCH_PAGE;
            }
        },
        success : function(data) {
            console.log(data);
            var resp = $.parseJSON(data)
            if(resp.success) {
                window.location.href = CONFIG.SEARCH_PAGE
            }
        }
    })
};


var getParkingHubs = function() {
    $.ajax({
        url: CONFIG.API_HOST + CONFIG.PARKING_SPOTS_ENDPOINT,
        method: 'GET',
        beforeSend : function(xhr, opts) {
            if(CONFIG.ENVIRONMENT == 'DEV') {
                allParkingHubs = [
                    {
                        id: 0,
                        name : 'Piata Victoriei'
                    },
                    {
                        id: 1,
                        name : 'Rahova'
                    },
                    {
                        id : 2,
                        name : 'Piata Sudului'
                    }
                ];
                populateParkingHubs();
                xhr.abort();
            }
            // show spinner
        },
        success : function(data) {
            // hide spinner
            allParkingHubs = data;
            populateParkingHubs();
        }
    })
};


var getFreeSpots = function() {

    checkInDate = $('#checkIn').val();
    checkOutDate = $('#checkOut').val();
    selectedParkingId = $('#parkingHub').find(":selected").val();

  $.ajax({
      url: CONFIG.API_HOST + CONFIG.SEARCH_AVAILABLE_SPOTS_ENDPOINT,
      method: 'GET',
      data: {
          startDate : checkInDate,
          endDate : checkOutDate,
          parkingId : selectedParkingId
      },
      dataType:'json',
      beforeSend : function(xhr,opts) {
          if(CONFIG.ENVIRONMENT == 'DEV') {
              availableSpots = 15;
              priceForSelectedSpot = 30;
              window.location.href = CONFIG.BOOKING_PAGE;
              setAvailableSpots();
              xhr.abort();
              // show spinner
          }
      },
      success : function(data) {
          // hide spinner
          console.log(data);
          availableSpots = data.availableSpots;
          priceForSelectedSpot = data.priceForSelectedSpot;
          setAvailableSpots();
          window.location.href = CONFIG.BOOKING_PAGE
      }
  })
};

var bookParkingSpot = function() {
    $.ajax({
        url: CONFIG.API_HOST + CONFIG.BOOK_SPOT_ENDPOINT,
        method : 'POST',
        data: {
            start_time : checkInDate,
            end_time : checkOutDate,
            parking_id : 4
        },
        beforeSend : function(xhr,opts) {
            if(CONFIG.ENVIRONMENT == 'DEV'){
                xhr.abort();
                window.location.href = CONFIG.LET_ME_IN_PAGE;
            }
            // show spinner + hide Booking btn
        },
        success : function(data) {
            // hide spinner
            if(data) {
                window.location.href = CONFIG.LET_ME_IN_PAGE;
            }
        }
    })
};

var letMeIn = function() {
    $.ajax({
        url: CONFIG.API_HOST + CONFIG.LET_ME_IN_ENDPOINT,
        method: 'POST',
        beforeSend : function(xhr,opts) {
            if(CONFIG.ENVIRONMENT == 'DEV'){
                console.log('ACCESS GRANTED!');
                xhr.abort()
            }
        },
        success : function(data) {
            // hide spinner
            if(data.success) {
                // window.location.href = CONFIG.LET_ME_IN_PAGE;
            }
        }
    })
};

var setAvailableSpots = function () {
    $('#available-spots').text(availableSpots);
};

var populateParkingHubs = function() {
    allParkingHubs.map(function (hub) {
        var option = $('<option/>').val(hub.id).text(hub.name);
        $('.allParkingHubs').append(option);
    })
};



