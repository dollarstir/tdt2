
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request</title>
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="app/View/assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" /> -->
    <link rel="stylesheet" href="app/View/assets/css/fontawesome.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" /> -->
    <link rel="stylesheet" href="app/View/assets/css/toastr.min.css">
    <link rel="stylesheet" href="app/View/assets/css/core.css">
</head>

<body>

    <div id="map"></div>

    <div class="overlay">
        <div class="service-request">
            <div class="input-group">
                <input type="text" id="autocomplete" class="form-control" placeholder="Enter Service Location">
                <input type="hidden" id="latitude" name="latitude" />
                <input type="hidden" id="longitude" name="longitude" />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <button class="btn" id="locate-me-btn">
                            <img  src="app/View/assets/images/location.png" style="width:20px;height:20px;"/>
                        </button>
                    </span>
                </div>
            </div>
            <button class="btn btn-success" id="serviceRequestButton">Select Cleaning Options</button>
        </div>
        <div class="card">
            <h3>Summary</h3>
            <div class="SummaryResutlcont">
                
            </div>

        </div>
    </div>

    <div id="servicePanel">
        <!--  service options here -->
        <div class="service-option">
            <div class="option optcleaningoption" onclick="selectOption(this)">
                <img src="app/View/assets/images/carselect.png" alt="Car Only" style="width:70px;height:70px;">
                <p>Car Only</p>
            </div>
            <div class="option optcleaningoption" onclick="selectOption(this)">
                <img src="app/View/assets/images/trash.png" alt="Trash Bin Only" style="width:70px;height:70px;">
                <p>Trash Bin Only</p>
            </div>
            <div class="option optcleaningoption" onclick="selectOption(this)">
                <img src="app/View/assets/images/carbin.png" alt="Car & Trash Bin" style="width:70px;height:70px;">
                <p>Car & Trash Bin</p>
            </div>
        </div>
    </div>


    <!-- modal -->
    <div class="modal fade" id="carModal" tabindex="-1" aria-labelledby="carModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg car-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carModalLabel">Select Cleaning Option</h5>
                    <button type="button" class="close closemymodal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="carModalBodyContent">
                    <div class="container-fluid">

                        <!-- ****************************first step for  Cars  -->
                        <div id="step-1" class="step active">
                            <h2>Car Details</h2>
                            <div id="accordion">
                                <!-- Saved Cars Accordion -->
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link btncollapseOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="<?= Utils::showSavedcarsAccordion(1)[0]; ?>" aria-controls="collapseOne">
                                                Saved Cars
                                                <i class="fas fa-plus"></i>
                                                <i class="fas fa-minus" style="display:none;"></i>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse <?= Utils::showSavedcarsAccordion(1)[1]; ?>" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="list-group carlistgp">
                                                <?= CarModel::Displaycars(1); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add New Car Accordion -->
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="<?= Utils::showAddCarAccordion(
                                                                                                                                                        1
                                                                                                                                                    )[0]; ?>" aria-controls="collapseTwo">
                                                Add New Car
                                                <i class="fas fa-plus"></i>
                                                <i class="fas fa-minus" style="display:none;"></i>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse <?= Utils::showAddCarAccordion(1)[1]; ?>" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <form id="addCarForm">
                                                <div class="form-group">
                                                    <label for="carBrand">Car Brand *</label>
                                                    <select class="form-control" id="carBrand" name="brand_name">
                                                        <option value="">Select Brand *</option>
                                                        <?php
                                                        $carBrands = CarModel::getCarBrands();
                                                        foreach ($carBrands as $brand) {
                                                            echo "<option value='{$brand['id']}'>{$brand['brand_name']}</option>";
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="carModel">Car Model</label>
                                                    <select class="form-control" id="carModel" name="model">
                                                        <option value="">Select Model</option>
                                                        <!-- Options will be added here based on the brand selected -->
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label for="carYear">Car Year</label>
                                                    <input type="text" class="form-control" id="carPlateNumber" placeholder="Enter Car  Year *" required name="year">
                                                    <!-- hidden input to add car -->
                                                    <input type="hidden" name="action" value="addCar">
                                                </div>
                                                <div class="form-group">
                                                    <label for="carColor">Car Color</label>
                                                    <select class="form-control" id="carColor" name="color">
                                                        <option value="">Select Color</option>
                                                        <?php
                                                        $colors = CarModel::getColors();
                                                        foreach ($colors as $color) {
                                                            echo "<option value='{$color['id']}'>{$color['Name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="carPlateNumber">Plate Number</label>
                                                    <input type="text" class="form-control" id="carPlateNumber" placeholder="Enter Plate Number" name="license_plate">
                                                </div>


                                                <div class="form-group">
                                                    <label for="maincarimg">Browse Image of car (png)</label>
                                                    <div class="image-upload-container">
                                                        <input type="file" class="form-control-file d-none" id="maincarimg" accept="image/*" onchange="readURL(this, 'MaincThumbnail');" name="image">
                                                        <label for="maincarimg" class="image-upload-label">
                                                            <img id="MaincThumbnail" src="app/View/assets/images/thumb.png" alt="Front view" class="img-thumbnail" />
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- <button type="submit" class="btn btn-primary">Add Car</button> -->

                                        </div>
                                    </div>
                                </div>


                                <!-- Upload Current State of Your Vehicle Accordion Item -->
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Upload Current State of Your Vehicle
                                                <i class="fas fa-plus"></i>
                                                <i class="fas fa-minus" style="display:none;"></i>
                                            </button>
                                        </h2>
                                    </div>
                                    <!-- ...other accordion items... -->
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <h5 class="card-title">Upload current state of your vehicle</h5>
                                            <div class="vehicle-images-upload">
                                                <!-- VEHICLE IMAGE UPLOAD -->
                                                <div class="damage-image-upload mt-3">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-3 mb-3">
                                                            <div class="form-group">
                                                                <label for="dSFront">Driver Side Front (png)</label>
                                                                <div class="image-upload-container">
                                                                    <input type="file" class="form-control-file d-none" id="dSFront" accept="image/*" onchange="readURL(this, 'dSfrontThumbnail');" name="driver_side_front">
                                                                    <label for="dSFront" class="image-upload-label">
                                                                        <img id="dSfrontThumbnail" src="app/View/assets/images/thumb.png" alt="Driver side" class="img-thumbnail" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Repeat for the other views -->

                                                        <div class="col-md-6 col-lg-3 mb-3">
                                                            <div class="form-group">
                                                                <label for="pSfront">Passenger Side Front (png)</label>
                                                                <div class="image-upload-container">
                                                                    <input type="file" class="form-control-file d-none" id="pSfront" accept="image/*" onchange="readURL(this, 'psFrontThumbnail');" name="passenger_side_front">
                                                                    <label for="pSfront" class="image-upload-label">
                                                                        <img id="psFrontThumbnail" src="app/View/assets/images/thumb.png" alt="Front view" class="img-thumbnail" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6 col-lg-3 mb-3">
                                                            <div class="form-group">
                                                                <label for="dSrear">Driver Side Rear (png)</label>
                                                                <div class="image-upload-container">
                                                                    <input type="file" class="form-control-file d-none" id="dSrear" accept="image/*" onchange="readURL(this, 'dSrearThumbnail');" name="driver_side_rear">
                                                                    <label for="dSrear" class="image-upload-label">
                                                                        <img id="dSrearThumbnail" src="app/View/assets/images/thumb.png" alt="Front view" class="img-thumbnail" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-3 mb-3">
                                                            <div class="form-group">
                                                                <label for="psRear">Passenger Side Rear (png)</label>
                                                                <div class="image-upload-container">
                                                                    <input type="file" class="form-control-file d-none" id="psRear" accept="image/*" onchange="readURL(this, 'psRearThumbnail');" name="passenger_side_rear">
                                                                    <label for="psRear" class="image-upload-label">
                                                                        <img id="psRearThumbnail" src="app/View/assets/images/thumb.png" alt="Front view" class="img-thumbnail" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="vehicle-upload-instructions">
                                                <ul>
                                                    <li>Should be visible as above images.</li>
                                                    <li>Should have visible registration number.</li>
                                                </ul>
                                            </div>

                                            <div class="vehicle-condition">
                                                <label>
                                                    <input type="checkbox" checked>
                                                    By checking box you agree that this is the current state of your vehicle.
                                                </label>
                                            </div>
                                            <div class="vehicle-damage">
                                                <label>Any damages or scratches?</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="damage" id="damageYes" value="yes">
                                                    <label class="form-check-label" for="damageYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="damage" id="damageNo" value="no" checked>
                                                    <label class="form-check-label" for="damageNo">No</label>
                                                </div>
                                                <div class="damageContent">
                                                    <div class="damage-image-upload mt-3">
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-3 mb-3">
                                                                <div class="form-group">
                                                                    <!-- <label for="damageFront">Front view</label> -->
                                                                    <div class="image-upload-container">
                                                                        <input type="file" class="form-control-file d-none" id="dm1" accept="image/*" onchange="readURL(this, 'dmthum1');" name="damage_image1">
                                                                        <label for="dm1" class="image-upload-label">
                                                                            <img id="dmthum1" src="app/View/assets/images/thumb.png" alt="Front view" class="img-thumbnail" />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Repeat for the other views -->

                                                            <div class="col-md-6 col-lg-3 mb-3">
                                                                <div class="form-group">
                                                                    <!-- <label for="dm2">Front view</label> -->
                                                                    <div class="image-upload-container">
                                                                        <input type="file" class="form-control-file d-none" id="dm2" accept="image/*" onchange="readURL(this, 'dmthum2');" name="damage_image2">
                                                                        <label for="dm2" class="image-upload-label">
                                                                            <img id="dmthum2" src="app/View/assets/images/thumb.png" alt="Front view" class="img-thumbnail" />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 col-lg-3 mb-3">
                                                                <div class="form-group">
                                                                    <!-- <label for="dm3">Front view</label> -->
                                                                    <div class="image-upload-container">
                                                                        <input type="file" class="form-control-file d-none" id="dm3" accept="image/*" onchange="readURL(this, 'dmthum3');" name="damage_image3">
                                                                        <label for="dm3" class="image-upload-label">
                                                                            <img id="dmthum3" src="app/View/assets/images/thumb.png" alt="Front view" class="img-thumbnail" />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-3 mb-3">
                                                                <div class="form-group">
                                                                    <!-- <label for="otheSide4">Front view</label> -->
                                                                    <div class="image-upload-container">
                                                                        <input type="file" class="form-control-file d-none" id="dm4" accept="image/*" onchange="readURL(this, 'dmthumb4');" name="damage_image4">
                                                                        <label for="dm4" class="image-upload-label">
                                                                            <img id="dmthumb4" src="app/View/assets/images/thumb.png" alt="Front view" class="img-thumbnail" />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <label for="damageComments">Additional comments on damage</label>
                                                        <textarea class="form-control" id="damageComments" rows="3" placeholder="Describe the damage" name="damage_detail"></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="vehicle-request-for">
                                                <p>This request is for</p>
                                                <div>
                                                    <input type="radio" id="forMe" name="is_for_guest" value="0" checked>
                                                    <label for="forMe">Me</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="forGuest" name="is_for_guest" value="1">
                                                    <label for="forGuest">Guest</label>
                                                    <div class="guestContent">
                                                        <input type="text" placeholder="Please state Guest Name" class="form-control" name="guest_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>


                                            <button type="submit" class="btn btn-primary">Add your car to proceed</button>
                                        </div>

                                        <!-- form ends here -->
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- *********End Car step1  *****************************************************-->


                        <!-- ********************Step 2 Wash packages   *******************-->
                        <div id="step-2" class="step">
                            <h2>Wash Packages</h2>
                            <!-- add two buttons now and later -->
                            <div class="card mb-5">
                                <button class="btn btn-primary float-left" id="nowWashPackage">Now</button>
                                <button class="btn btn-dark float-right" id="laterWashPackage">Later</button>
                            </div>

                            <div class="container cbs-main">
                                <div class="card mb-3" id="dateTimeSection" style="display:none;">
                                    <h2>Select Date and Time</h2>
                                    <div class="date-time-container">
                                        <div class="date-selector">
                                            <label for="date">Day</label>
                                            <input type="date" id="date" name="date">
                                        </div>
                                        <div class="time-selector">
                                            <label for="time">Time</label>
                                            <input type="time" id="time" name="time">
                                        </div>
                                    </div>
                                    <button id="saveDateTime" class="btn btn-primary">Save</button>
                                </div>



                                <div class="cbs-main-list-item-section-content cbs-clear-fix loadPackageData">
                                    <!-- Each .service-card represents a package -->
                                    <!-- load packaged here -->


                                </div>
                                <br>
                                <h3>ADDONS</h3>

                                <div class="cbs-main-list-item-section-content cbs-clear-fix loadAddonPackageData">
                                    <!-- Each .service-card represents a package -->
                                    <!-- load Addon packaged here -->


                                </div>


                            </div>

                        </div>
                        <!-- end step 2 ******************************************** -->

                        <!-- ***********************step3 ************************ -->
                        <!-- Step 3 -->
                        <div id="step-3" class="step">
                            <div class="verification-container">
                                <div class="verification-header">
                                    <span>Identity Verification</span>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="container  verifycont">
                                    <form id="addidcard" style="display:<?= Utils::canshowAddIDDocuments(1); ?>">
                                        <div class="upload-area" id="idUploadArea">
                                            <div class="upload-icon">
                                                <i class="fa fa-cloud-upload-alt"></i>
                                            </div>
                                            <div class="upload-instructions">
                                                FRONT OF ID
                                            </div>
                                            <div class="upload-action">
                                                <label for="frontOfID">Upload <i class="fa fa-camera"></i></label>
                                                <img id="idPreview" src="app/View/assets/images/id.png" alt="Front of ID" class="img-thumbnail" style="display: none;" />
                                                <input type="file" id="frontOfID" name="idfront" accept="image/*">
                                                <input type="hidden" name="action" value="addID">
                                            </div>
                                        </div>
                                        <div class="upload-area profile-pic" id="profilePicUploadArea">
                                            <div class="upload-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="upload-instructions">
                                                PROFILE PICTURE
                                            </div>
                                            <div class="upload-action">
                                                <label for="profilePicture">Upload <i class="fa fa-camera"></i></label>
                                                <img id="profilePicPreview" src="" alt="Profile Picture" class="img-thumbnail" style="display: none;" />
                                                <input type="file" id="profilePicture" name="profilepicture" accept="image/*">
                                            </div>
                                            <span class="icon-badge">
                                                <i class="fa fa-info"></i>
                                            </span>
                                        </div>
                                        <button type="submit" class="submit-btn">Submit</button>
                                    </form>


                                    <!-- succcess message -->
                                    <div class="verification-message-box" style="display: <?= Utils::canShowdocsMessage(1); ?>;">
                                        <p>Verification Details Submitted</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- end step 3 ******************************************** -->


                        <!-- ***************************Step 4    payment Step  ****************************************************  -->
                        <div id="step-4" class="step">
                            <h2>Payment</h2>
                            <div id="accordion1">
                                <!-- Saved Cards Accordion -->
                                <div class="card">
                                    <div class="card-header" id="headingPayOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link btnCardcollapseOne" data-toggle="collapse" data-target="#collapsePayOne" aria-expanded="<?= Utils::showSavedcardAccordion(1)[0]; ?>" aria-controls="collapsePayOne">
                                                Saved Cards
                                                <i class="fas fa-plus"></i>
                                                <i class="fas fa-minus" style="display:none;"></i>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapsePayOne" class="collapse <?= Utils::showSavedcardAccordion(1)[1]; ?>" aria-labelledby="headingPayOne" data-parent="#accordion1">
                                        <div class="card-body">
                                            <div class="pcardselection">
                                                <ul class="list-group list-group-flush creditcardlistgp">
                                                    <?= PaymentModel::displaySavedCreditCards(1); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add New Card Accordion -->
                                <div class="card">
                                    <div class="card-header" id="headingPayTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsePayTwo" aria-expanded="<?= Utils::showAddCardAccordion(
                                                                                                                                                            1
                                                                                                                                                        )[0]; ?>" aria-controls="collapsePayTwo">
                                                Add New Card
                                                <i class="fas fa-plus"></i>
                                                <i class="fas fa-minus" style="display:none;"></i>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapsePayTwo" class="collapse <?= Utils::showAddCardAccordion(1)[1]; ?>" aria-labelledby="headingPayTwo" data-parent="#accordion1">
                                        <div class="card-body">
                                            <form id="addcards">
                                                <!-- Name on Card -->
                                                <div class="form-group">
                                                    <label for="nameOnCard">Name on Card</label>
                                                    <input type="text" class="form-control" id="nameOnCard" placeholder="Name on Card" name="card_holder_name">
                                                </div>

                                                <!-- Card Number -->
                                                <div class="form-group">
                                                    <label for="cardNumber">Card Number</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="cardImageContainer">
                                                                <img src="app/View/assets/images/nocard.png" id="cardTypeImage" alt="Card Type" style="height: 30px; display: none;" />
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" id="cardNumber" placeholder="Card Number" aria-label="Card Number" aria-describedby="cardImageContainer" name="card_number">
                                                        <input type="hidden" id="cardTypeHiddenInput" name="card_type">
                                                    </div>
                                                </div>



                                                <!-- Expiry Date and CVV -->
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="expDate">Exp. Date</label>
                                                        <input type="text" class="form-control" id="expDate" placeholder="MM/YY" name="exp_date">
                                                    </div>
                                                    <div class="col">
                                                        <label for="cvv">CVV</label>
                                                        <input type="text" class="form-control" id="cvv" placeholder="CVV" name="cvv">
                                                        <input type="hidden" name="action" value="addCard">
                                                    </div>
                                                </div>

                                                <!-- Country and Zip Code -->
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <label for="country">Country</label>
                                                        <select class="form-control" id="country" name="country">
                                                            <option>Greece</option>
                                                            <!-- Add other countries as needed -->
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="zip">Zip Code</label>
                                                        <input type="text" class="form-control" id="zip" placeholder="Zip Code" name="zip_code1">
                                                    </div>
                                                </div>

                                                <!-- Billing Address -->
                                                <div class="form-check mt-3">
                                                    <input type="checkbox" class="form-check-input" id="sameAsResidential" name="residence">
                                                    <label class="form-check-label" for="sameAsResidential">Same as residential address</label>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="addressLine1">Address Line 1</label>
                                                    <input type="text" class="form-control" id="addressLine1" placeholder="Address Line 1" name="address_line_1">
                                                </div>

                                                <div class="form-group">
                                                    <label for="addressLine2">Apartment, Suite or Other</label>
                                                    <input type="text" class="form-control" id="addressLine2" placeholder="Apartment, Suite or Other" name="address_line_2">
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="state">State</label>
                                                        <input type="text" class="form-control" id="state" placeholder="State" name="state">
                                                    </div>
                                                    <div class="col">
                                                        <label for="city">City</label>
                                                        <input type="text" class="form-control" id="city" placeholder="City" name="city">
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="billingZip">Zip code</label>
                                                    <input type="text" class="form-control" id="billingZip" placeholder="Zip code" name="zip_code">
                                                </div>

                                                <!-- Set as default payment method -->
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="defaultPaymentMethod" name="set_default">
                                                    <label class="form-check-label" for="defaultPaymentMethod">Set as default payment method.</label>
                                                </div>

                                                <!-- Form navigation buttons -->
                                                <div class="mt-4">

                                                    <button type="submit" class="btn btn-primary float-right">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>

                        <!-- ******************** end step 3 **************************************** -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="navigation-buttons">
                        <button id="prev-btn" class="btn btn-primary" style="display: none;">Previous</button>
                        <button id="next-btn" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal -->




    <script src="app/View/assets/js/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9xR_ioh6A7CZdMDsSaVm0xkaBhTaMU8&libraries=places,marker&loading=async&callback=initMap" async defer></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 -->
    <script src="app/View/assets/js/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
    <script src="app/View/assets/js/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="app/View/assets/js/bootstrap.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <script src="app/View/assets/js/toastr.min.js"></script>
    <script src="app/View/assets/js/core.js"></script>
    <script src="app/View/assets/js/formwizard.js"></script>


</body>

</html>