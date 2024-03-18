$(document).ready(function() {
    var currentStep = 1;
    var totalSteps = 4;
    
    function showStep(step) {
      $('.step').removeClass('active').hide();
      $('#step-' + step).addClass('active').show();
      if (step === 1) {
        $('#prev-btn').hide();
      } else {
        $('#prev-btn').show();
      }
      if (step === totalSteps) {
        $('#next-btn').text('Submit').removeClass('btn-primary').addClass('btn-success');
      } else {
        $('#next-btn').text('Next').removeClass('btn-success').addClass('btn-primary');
      }
    }
    
    $('#next-btn').click(function() {
      if (currentStep < totalSteps) {

        if(currentStep == 1){
          let selectedCar = localStorage.getItem('selectedCar');
          if(!selectedCar){
           toastr.info('please select a car to continue');
          }
          else{
            selectedCar = JSON.parse(selectedCar);
            let vehicleType = selectedCar.vehicleType;
            console.log(vehicleType);

            $(".loadPackageData").load('actions',{vehicleTpe:vehicleType,action:'displayWashPackages'});
            $(".loadAddonPackageData").load('actions',{vehicleTpe:vehicleType,action:'displayAddonPackages'});
            // loadAddonPackageData
            currentStep++;
            showStep(currentStep);
          }

        }
        else if(currentStep == 2){
          let WashPackage = localStorage.getItem('selectedWashPackage');
          if(!WashPackage){
            toastr.info("please select a Package to continue");
          }
          else{
            currentStep++;
            showStep(currentStep);
          }

        }

        else if(currentStep == 3){
          let VerifcationData = localStorage.getItem('VerifcationData');
          if(!VerifcationData){
            toastr.info("please Id Document to continue to continue");
          }
          else{
            currentStep++;
            showStep(currentStep);
          }

        }

        // else if(currentStep == 4){
        //   let paymentCard = localStorage.getItem('selectedPaymentCard');
        //   if(!paymentCard){
        //     alert("please select a Payment card to continue");
        //   }
        //   else{
        //     currentStep++;
        //     showStep(currentStep);
        //   }

        // }
        
        
      } else {
        // Submit the form or finalize the wizard
        let paymentCard = localStorage.getItem('selectedPaymentCard');
          if(!paymentCard){
            toastr.info("please select a Payment card to continue");
          }
          else{

          //  load Sumary data to main page
            var cleaningOptions = localStorage.getItem('cleaningOption');
            var selectedCar = localStorage.getItem('selectedCar');
            var selectedWashPackage = localStorage.getItem('selectedWashPackage');
            var requestType = localStorage.getItem('requestTpe');
            var  selectedAddonPackage = localStorage.getItem('selectedAddonPackage');
            var selectedPaymentCard = localStorage.getItem('selectedPaymentCard');
            var scheduledDate = localStorage.getItem('scheduledDate');
            var scheduledTime = localStorage.getItem('scheduledTime');

            var data = {
              action:'showsummary',
              cleaningOptions:cleaningOptions,
              selectedCar:selectedCar,
              selectedWashPackage:selectedWashPackage,
              requestType:requestType,
              selectedAddonPackage: selectedAddonPackage,
              selectedPaymentCard:selectedPaymentCard,
              scheduledDate:scheduledDate,
              scheduledTime:scheduledTime

            };
          $('.closemymodal').click();
          $('#servicePanel').hide();
          $('.SummaryResutlcont').load('actions',data);

          }
      }
    });
    
    $('#prev-btn').click(function() {
      if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
      }
    });
    
    function init() {
      showStep(currentStep);
    }
    
    init();

    //payment card radio lable 
    // $('.card-radio-label').click(function() {
    //     $('.list-group-itempaycarditem"').removeClass('active'); // Remove 'active' class from all items
    //     $(this).closest('.list-group-itempaycarditem"').addClass('active'); // Add 'active' class to selected item
    //   });
  });

// select a package
  function selectPackage(buttonElement) {
    // Remove 'active' class from all service cards
    document.querySelectorAll('.service-card').forEach(card => {
      card.classList.remove('active');
    });

    // Add 'active' class to the selected package
    buttonElement.closest('.service-card').classList.add('active');
  }

  // slect addons package 

  function selectAddonPackage(buttonElement) {
    // Remove 'active' class from all service cards
    document.querySelectorAll('.service-Addoncard').forEach(card => {
      card.classList.remove('active');
    });

    // Add 'active' class to the selected package
    buttonElement.closest('.service-Addoncard').classList.add('active');
  }