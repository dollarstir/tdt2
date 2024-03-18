<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="<?= Utils::assetPath(); ?>/css/register.css">
    <link rel="stylesheet" href="<?= Utils::assetPath(); ?>/css/bootstrap.min.css">

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <!-- Step 1 -->
                <div id="step-1" class="step active">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h2>Login</h2>
                                    </div>
                                    <div class="card-body">
                                        <form>

                                            <div class="form-group">
                                                <label for="phone">Enter phone number & Email</label>
                                                <input type="tel" class="form-control" id="phone" required>
                                            </div>


                                            <button type="submit" class="btn btn-primary btn-block">Proceed</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-custom btn-block" onclick="showStep(2)">Next</button> -->
                </div>

                <!-- Step 2 -->
                <div id="step-2" class="step">
                    <h2 class="text-center mb-4">Step 2: Contact Information</h2>
                    <!-- Contact Information Form -->
                    <div class="form-group">
                        <label for="email">Enter email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Enter phone number</label>
                        <input type="tel" class="form-control" id="phone" required>
                    </div>
                    <button type="button" class="btn btn-custom btn-block" onclick="showStep(3)">Next</button>
                </div>

                <!-- Step 3 -->
                <div id="step-3" class="step">
                    <h2 class="text-center mb-4">Step 3: Address</h2>
                    <!-- Address Form -->
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </div>

            </div>
        </div>
    </div>




    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 -->
    <script src="<?= Utils::assetPath(); ?>/js/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
    <script src="<?= Utils::assetPath(); ?>/js/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="<?= Utils::assetPath(); ?>/js/bootstrap.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <script src="<?= Utils::assetPath(); ?>/js/toastr.min.js"></script>
    <script src="<?= Utils::assetPath(); ?>/js/core.js"></script>
    <script src="<?= Utils::assetPath(); ?>/js/formwizard.js"></script>
    <script>
        function showStep(step) {
            $('.step').removeClass('active').hide();
            $('#step-' + step).addClass('active').show();
        }
    </script>


</body>

</html>