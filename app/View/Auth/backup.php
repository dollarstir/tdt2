<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<link rel="stylesheet" href="<?=Utils::assetPath();?>/css/register.css">
<link rel="stylesheet" href="<?=Utils::assetPath();?>/css/bootstrap.min.css">

</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center">
          <h2>Register Details</h2>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="first-name">First name</label>
              <input type="text" class="form-control" id="first-name" required>
            </div>
            <div class="form-group">
              <label for="last-name">Last name</label>
              <input type="text" class="form-control" id="last-name" required>
            </div>
            <div class="form-group">
              <label for="email">Enter email</label>
              <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
              <label for="phone">Enter phone number</label>
              <input type="tel" class="form-control" id="phone" required>
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="consent" required>
              <label class="form-check-label" for="consent">By checking this box you agree and consent to receiving automated messages, email and calls from Tur detail on the number provided.</label>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="address-1">Address Line 1</label>
                <input type="text" class="form-control" id="address-1" required>
              </div>
              <div class="form-group col-md-6">
                <label for="address-2">Address Line 2</label>
                <input type="text" class="form-control" id="address-2">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" required>
              </div>
              <div class="form-group col-md-4">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" required>
              </div>
              <div class="form-group col-md-2">
                <label for="postal-code">Postal code</label>
                <input type="text" class="form-control" id="postal-code" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Proceed</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 -->
    <script src="<?=Utils::assetPath();?>/js/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
    <script src="<?=Utils::assetPath();?>/js/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="<?=Utils::assetPath();?>/js/bootstrap.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <script src="<?=Utils::assetPath();?>/js/toastr.min.js"></script>
    <script src="<?=Utils::assetPath();?>/js/core.js"></script>
    <script src="<?=Utils::assetPath();?>/js/formwizard.js"></script>


</body>
</html>
