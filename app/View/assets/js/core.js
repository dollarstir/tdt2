$(document).ready(function () {
    $("#openModalButton").click(function () {
        $("#carModal").modal("show");
    });

    // Submit form data to add a new car
    $("#addCarForm").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "actions",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                if (data.type == 'success') {
                    toastr.success(data.message);
                    $(".carlistgp").load('actions', { action: 'Displaycars' });
                    $(".btncollapseOne").click();

                }
                if (data.type == 'error') {
                    toastr.error(data.message);
                }


                // $("#carModal").modal("hide");
                // window.location.reload();
            },
            error: function () {
                alert("Error adding car");
            },
        });
    });


    // add credit card 
    $("#addcards").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "actions",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                if (data.type == 'success') {
                    toastr.success(data.message);
                    $(".creditcardlistgp").load('actions', { action: 'displaySavedCreditCards' });
                    $(".btnCardcollapseOne").click();
                }
                if (data.type == 'error') {
                    toastr.error(data.message);
                }
            },
            error: function () {
                alert("Error adding credit card");
            },

        });
    });

    // add  Id card
    $("#addidcard").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "actions",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                if (data.type == 'success') {
                    toastr.success(data.message);
                    $(".verification-message-box").attr('style', 'display: block !important;');
                    $('#addidcard').attr('style', 'display: none !important;');
                    localStorage.setItem('VerifcationData', 'sent');
                    
                }
                if (data.type == 'error') {
                    toastr.error(data.message);
                }
            },
            error: function () {
                alert("Error adding Id card");
            },

        });
    });

    // Customize input file label to show selected file name
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    // Load car models based on the selected brand

    $("#carBrand").change(function () {
        var brand = $(this).val(); // Get the selected brand
        $("#carModel").html('<option value="">Select Model</option>'); // Clear previous options

        if (brand) {
            $.ajax({
                url: "actions",
                type: "POST",
                data: {
                    brand: brand,
                    action: "getModels"
                },
                dataType: "json",
                success: function (response) {
                    $.each(response, function (index, model) {
                        $("#carModel").append(new Option(model.model, model.id));
                    });
                },
                error: function () {
                    alert("Error fetching data");
                },
            });
        }
    });

    // accrodion section 

    $('#accordion').on('shown.bs.collapse', function (e) {
        $(e.target).siblings('.card-header').find('.fa-plus').hide();
        $(e.target).siblings('.card-header').find('.fa-minus').show();
    });

    $('#accordion').on('hidden.bs.collapse', function (e) {
        $(e.target).siblings('.card-header').find('.fa-plus').show();
        $(e.target).siblings('.card-header').find('.fa-minus').hide();
    });

    //   // JavaScript to update the file input label upon selecting a file

    $('.custom-file-input').on('change', function () {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Initially hide the damage content
    $('.damageContent').hide();

    // Event handler for when the damage radio buttons change
    $('input[type="radio"][name="damage"]').change(function () {
        // Check the value of the selected radio button
        if ($('#damageYes').is(':checked')) {
            // If "Yes" is checked, show the damage content
            $('.damageContent').show();
        } else {
            // If "No" is checked, hide the damage content
            $('.damageContent').hide();
        }
    });

    // If "Yes" is already checked on page load (for example, when editing a form with pre-filled values), show the damage content
    if ($('#damageYes').is(':checked')) {
        $('.damageContent').show();
    }



    // for quest section

    // Initially hide the guestContent
    $('.guestContent').hide();

    // Event handler for when the requestFor radio buttons change
    $('input[type="radio"][name="is_for_guest"]').change(function () {
        // Check the value of the selected radio button
        if ($('#forGuest').is(':checked')) {
            // If "Guest" is checked, show the guest name input
            $('.guestContent').show();
        } else {
            // If "Me" is checked, hide the guest name input
            $('.guestContent').hide();
        }
    });

    // If "Guest" is already checked on page load (for example, when editing a form with pre-filled values), show the guest name input
    if ($('#forGuest').is(':checked')) {
        $('.guestContent').show();
    }



    // edit cleaning option

    $(document).on('click','.editcleaningoptions',function(){
        $('#servicePanel').show();

    });


    // saving all data to local storage


    // saving cleaningn option 

    $(document).on('click','.optcleaningoption',function(){
        var Cleaningoption =  $(this).find('p').text();
        localStorage.setItem('cleaningOption', Cleaningoption );


    });

    // Event handler for selecting a car
    $(document).on('click', '.carlistitem', function () {
        // Retrieve car details
        var carDetails = {
            id: $(this).data('carId'),
            brand: $(this).find('.car-details h5').text(),
            plateNumber: $(this).find('.car-details .platNmber').text(),
            vehicleType: $(this).find('.car-details .myvehicletype').text(),
            color: $(this).find('.color-indicator').css('background-color')
        };

        // Save car details to local storage
        localStorage.setItem('selectedCar', JSON.stringify(carDetails));
    });


    $(document).on('click', '.service-card .select-button', function () {
        // Retrieve wash package details
        var packageDetails = {
            name: $(this).parent().find('h5').text(),
            price: $(this).parent().find('.price').text(),
            duration: $(this).parent().find('.duration').text(),
        };

        // Save wash package details to local storage
        localStorage.setItem('selectedWashPackage', JSON.stringify(packageDetails));
        localStorage.setItem('requestTpe', 'Now');
    });


    // addon  package 

    $(document).on('click', '.service-Addoncard .select-button', function () {
        // Retrieve wash package details
        var packageDetails = {
            name: $(this).parent().find('h5').text(),
            price: $(this).parent().find('.price').text(),
            duration: $(this).parent().find('.duration').text(),
        };

        // Save wash package details to local storage
        localStorage.setItem('selectedAddonPackage', JSON.stringify(packageDetails));
        // localStorage.setItem('requestTpe', 'Now');
    });




    // Event handler for selecting a payment card
    $(document).on('click', '.creditcardlistgp .selectable', function () {
        // Retrieve payment card details
        var cardDetails = {
            id: $(this).data('cardId'),
            card_type :$(this).find('p').text(),
            lastDigits: $(this).find('span').first().text().trim().split(' ').pop()
        };

        // Save payment card details to local storage
        localStorage.setItem('selectedPaymentCard', JSON.stringify(cardDetails));
    });






    // working on Now and Later package 
    // let WaeshPackage = localStorage.getItem('selectedWashPackage');
    // Handle the 'Now' button click
    $(document).on('click', "#nowWashPackage", function () {
        // Check if a package is local storage

        let WashPackage = localStorage.getItem('selectedWashPackage');

        if (!WashPackage) {
            alert("Please choose a package.");
        } else {
            // var selectedPackage = $(".service-card .select-button").closest('.service-card').find('h5').text();
            // localStorage.setItem('selectedPackage', selectedPackage);
            localStorage.removeItem('scheduledDate');
            localStorage.removeItem('scheduledTime');
            localStorage.setItem('requestTpe', 'Now');
            let packagedata = JSON.parse(WashPackage);

            toastr.success("Your package " + packagedata.name + " is added ");
        }
    });

    // Handle the 'Later' button click
    $(document).on('click', "#laterWashPackage", function () {
        let WashPackage = localStorage.getItem('selectedWashPackage');

        if (!WashPackage) {
            toastr.info("Please choose a package before scheduling.");
        } else {
            $("#dateTimeSection").show();
        }
    });

    // Handle the 'Save' button for date and time
    $(document).on('click', "#saveDateTime", function () {
        let WashPackage = localStorage.getItem('selectedWashPackage');

        var selectedDate = $("#date").val();
        var selectedTime = $("#time").val();
        if (selectedDate && selectedTime) {
            localStorage.setItem('scheduledDate', selectedDate);
            localStorage.setItem('scheduledTime', selectedTime);
            localStorage.setItem('requestTpe', 'Schedule');
          let  packagedata = JSON.parse(WashPackage);
          toastr.success("Your package " + packagedata.name + " is scheduled for " + selectedDate + " at " + selectedTime + ".");
            // Hide the date time section again
            $("#dateTimeSection").hide();
        } else {
            toastr.info("Please select both date and time.");
        }
    });

});






//  function to display the selected image as a thumbnail:

document.addEventListener('DOMContentLoaded', function () {
    window.readURL = function (input, thumbnailId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById(thumbnailId).src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]); // Convert image to base64 string
        }
    };
});

function selectCar(element, carId) {
    // Remove 'selected' class from all other list items
    document.querySelectorAll('.carlistitem').forEach(function (carElement) {
        carElement.classList.remove('selected');
        carElement.querySelector('.check-icon').style.display = 'none';
    });

    // Add 'selected' class to the clicked list item
    element.classList.add('selected');
    element.querySelector('.check-icon').style.display = 'block';

    // You may want to store the selected car ID in a hidden input if you need it for form submission
    // document.getElementById('selectedCarId').value = carId;
}


// Attach the click event listener to the document or a static parent element
document.addEventListener('click', function (e) {
    // Check if the clicked element or its parents have the '.selectable' class
    var selectableItem = e.target.closest('.selectable');
    if (selectableItem) {
        // Remove 'selected' class from all items
        document.querySelectorAll('.selectable').forEach(el => {
            el.classList.remove('selected');
        });

        // Add 'selected' class to the clicked item
        selectableItem.classList.add('selected');

        // Use `selectableItem.dataset.cardId` to know which card was selected
        console.log('Selected card ID:', selectableItem.dataset.cardId);
    }
});


// credit card detection  function 
function getCreditCardType(cardNumber) {
    const regexPatterns = {
        visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
        mastercard: /^5[1-5][0-9]{14}$/,
        amex: /^3[47][0-9]{13}$/,
        discover: /^6(?:011|5[0-9]{2})[0-9]{12}$/,
    };

    for (const cardType in regexPatterns) {
        if (regexPatterns[cardType].test(cardNumber)) {
            return cardType;
        }
    }

    return 'unknown'; // or null if you prefer
}

// Update UI function
function updateCardTypeUI(cardType) {
    const cardTypeImage = document.getElementById('cardTypeImage');
    const cardTypeHiddenInput = document.getElementById('cardTypeHiddenInput');
    const imagePath = 'assets/images/'; // Update this path to where your images are stored

    cardTypeHiddenInput.value = cardType;

    switch (cardType) {
        case 'visa':
            cardTypeImage.src = `${imagePath}visa.png`;
            break;
        case 'mastercard':
            cardTypeImage.src = `${imagePath}mastercard.png`;
            break;
        case 'amex':
            cardTypeImage.src = `${imagePath}amex.png`;
            break;
        case 'discover':
            cardTypeImage.src = `${imagePath}discover.png`;
            break;
        default:
            cardTypeImage.src = `${imagePath}nocard.png`;
            cardTypeHiddenInput.value = '';
    }

    if (cardTypeImage.src) {
        cardTypeImage.style.display = 'inline';
    } else {
        cardTypeImage.style.display = 'none';
    }
}

// Event listener for card number input
document.getElementById('cardNumber').addEventListener('input', function () {
    const cardType = getCreditCardType(this.value);
    updateCardTypeUI(cardType);
});


// upload ID photo  function 

document.getElementById('frontOfID').addEventListener('change', function () {
    var file = this.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('idPreview').src = e.target.result;
            document.getElementById('idPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('profilePicture').addEventListener('change', function () {
    var file = this.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('profilePicPreview').src = e.target.result;
            document.getElementById('profilePicPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});


// country 

document.addEventListener('DOMContentLoaded', function () {
    const countries = [
        "Afghanistan", "Albania", "Algeria", "Andorra", "Angola",
        "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria",
        "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados",
        "Belarus", "Belgium", "Belize", "Benin", "Bhutan",
        "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei",
        "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia",
        "Cameroon", "Canada", "Central African Republic", "Chad", "Chile",
        "China", "Colombia", "Comoros", "Congo (Congo-Brazzaville)", "Costa Rica",
        "Croatia", "Cuba", "Cyprus", "Czechia (Czech Republic)", "Democratic Republic of the Congo",
        "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador",
        "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia",
        "Eswatini (fmr. \"Swaziland\")", "Ethiopia", "Fiji", "Finland", "France",
        "Gabon", "Gambia", "Georgia", "Germany", "Ghana",
        "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau",
        "Guyana", "Haiti", "Holy See", "Honduras", "Hungary",
        "Iceland", "India", "Indonesia", "Iran", "Iraq",
        "Ireland", "Israel", "Italy", "Jamaica", "Japan",
        "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait",
        "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho",
        "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg",
        "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali",
        "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico",
        "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro",
        "Morocco", "Mozambique", "Myanmar (formerly Burma)", "Namibia", "Nauru",
        "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger",
        "Nigeria", "North Korea", "North Macedonia (formerly Macedonia)", "Norway", "Oman",
        "Pakistan", "Palau", "Palestine State", "Panama", "Papua New Guinea",
        "Paraguay", "Peru", "Philippines", "Poland", "Portugal",
        "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis",
        "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe",
        "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone",
        "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia",
        "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka",
        "Sudan", "Suriname", "Sweden", "Switzerland", "Syria",
        "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo",
        "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan",
        "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom",
        "United States of America", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela",
        "Vietnam", "Yemen", "Zambia", "Zimbabwe"
    ];

    const countrySelect = document.getElementById('country');
    countries.forEach(function (country) {
        const option = document.createElement('option');
        option.value = country;
        option.textContent = country;
        countrySelect.appendChild(option);
    });
});


