<?php
class Utils {
    public static function showSavedcarsAccordion($client_id): array {
        $cars = CarModel::getCars($client_id);
        return (empty($cars))? ['','']: ['true','show'];
    }
    public static function showAddCarAccordion($client_id): array {
        $cars = CarModel::getCars($client_id);
        return (empty($cars))? ['true','show']: ['',''];
    }


    public static function showSavedcardAccordion($client_id): array {
        $cards = PaymentModel::getSavedCreditCards($client_id);
        return (empty($cards))? ['','']: ['true','show'];
    }

    public static function showAddCardAccordion($client_id): array {
        $cards = PaymentModel::getSavedCreditCards($client_id);
        return (empty($cards))? ['true','show']: ['',''];
    }

    // function to resize and save image to file system
    // you have to enable Gd extension in php.ini file  from ;extension=gd to extension=gd and restart the server
    /**
     *  @param string $originalImagePath
     * @param string $outputImagePath
     * @param int $maxWidth
     * @param int $maxHeight
     * @return bool
     */
    public static function resizeAndSaveImage($originalImagePath, $outputImagePath, $maxWidth=320, $maxHeight=200) {
        // Ensure the output directory exists
        ExceptionHandler::setUpErrorHandler();
      try{
        $outputDir = dirname($outputImagePath);
        // echo $originalImagePath;
        if (!is_dir($outputDir)) {
            // Attempt to create the directory with the right permissions
            if (!mkdir($outputDir, 0755, true)) {
                return ['type' => 'error', 'message' => 'Failed to create directory for the resized image.'];
            }
        }
    
        // Get the original image dimensions and type
        list($originalWidth, $originalHeight, $imageType) = getimagesize($originalImagePath);
        $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);
        $newWidth = round($originalWidth * $ratio);
        $newHeight = round($originalHeight * $ratio);
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
    
        // Load the original image
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $originalImage = imagecreatefromjpeg($originalImagePath);
                break;
            case IMAGETYPE_PNG:
                $originalImage = imagecreatefrompng($originalImagePath);
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
                break;
            case IMAGETYPE_GIF:
                $originalImage = imagecreatefromgif($originalImagePath);
                break;
            default:
                throw new Exception('Unsupported image type.');
        }
        
        // Resample the original image into the new image
        imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
    
        // Save the resized image
        $saveFunction = match ($imageType) {
            IMAGETYPE_JPEG => fn() => imagejpeg($newImage, $outputImagePath, 90),
            IMAGETYPE_PNG => fn() => imagepng($newImage, $outputImagePath),
            IMAGETYPE_GIF => fn() => imagegif($newImage, $outputImagePath),
            default => throw new Exception('Unsupported image type.')
        };
        $saveFunction();
    
        // Free up memory
        imagedestroy($originalImage);
        imagedestroy($newImage);
    
        return true;
      }
      catch(Throwable $th){
        ExceptionHandler::handleException($th);

      }
    }
    

public static function checkGDEnabled(): bool {
    if (extension_loaded('gd') && function_exists('gd_info')) {
        return true;
    } else {
        return false;
    }
}


// function to validate image file
/**
 * @param array $image
 * @param array $allowedTypes
 * @param int $maxSize in bytes
 * @return mixed
 */ 
public static function validateImageFile($image, $allowedTypes, $maxSize = 15728640):mixed {

    if (empty($file['name'])) {
        return ['type'=>'error', 'message'=>'File is empty.'];
    }
    // Check if the file is an image
    $check = getimagesize($image["tmp_name"]);
    if($check === false) {
        return ['type'=>'error', 'message'=>'File is not an image.'];
    }
    // Check file size
    if ($image["size"] > $maxSize) {
        return ['type'=>'error', 'message'=>'Sorry, your file is too large.'];
    }
    // Check if image file type is allowed
    $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $allowedTypes)) {
        $stringtypes = implode(', ', $allowedTypes);
        return ['type'=>'error', 'message'=>"Sorry, only  $stringtypes files are allowed."];
    }
    // If all checks pass
    return true;
}

public static function  validatemultipleImagefiles($images, $allowedTypes, $maxSize = 15728640):mixed {
// return $images['imgCar'];
    foreach ($images as  $image) {

       
        // Check if the file is empty
        if (empty($image['name'])) {
            return ['type'=>'error', 'message'=>" Some Image File  is empty."];
        }
        $check = getimagesize($image["tmp_name"]);
        if($check === false) {
            return ['type'=>'error', 'message'=>"File is not an image."];
        }
        // Check file size
        if ($image["size"] > $maxSize) {
            return ['type'=>'error', 'message'=>"Sorry, your file  is too large."];
        }
        // Check if image file type is allowed
        $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
        if (!in_array($imageFileType, $allowedTypes)) {
            $stringtypes = implode(', ', $allowedTypes);
            return ['type'=>'error', 'message'=>"Sorry, only  $stringtypes files are allowed. $imageFileType is not allowed."];
        }
    }
    // If all checks pass
    return ['type'=>'success'];
   
}

public static  function validateRequiredData($postData) {
    foreach ($postData as $key => $value) {
        if (empty(trim($value))) {
           return  ['type'=>'error', 'message'=>ucfirst($key) . ' is required.']; 
        }
    }
    return ['type'=>'success'];
}

// function to resize and  save multiple images to file system
/**
 * @param array $images
 * 
 * @param int $maxWidth
 * @param int $maxHeight
 * @return bool
 */
public static function resizeAndSaveMultipleImages($images, $maxWidth=320, $maxHeight=200) {
    $allSuccessful = true; // Assume all operations are successful initially

    foreach ($images as $image) {
        // Assuming $image is an array with 'originalPath' and 'outputPath' keys
        $originalPath = $image['originalPath'];
        $outputPath = $image['outputPath'];

        // Resize and save the image
        $success = self::resizeAndSaveImage($originalPath, $outputPath, $maxWidth, $maxHeight);

        // If any operation fails, set $allSuccessful to false
        if (!$success) {
            $allSuccessful = false;
            break; // Optionally break out of the loop at the first failure
        }
    }

    // Return true if all operations were successful, false otherwise
    return $allSuccessful;
}


public static function processAllImages($images, $client_id, $car_id,$outputDir): string {
    // Define the output directory for the images
    $allSuccessful = true; // Assume all operations are successful initially
    $count = 0;
    // Process each image
    foreach ($images as  $imageInfo) {
        $tempPath = $imageInfo['tmp_name']; // Temporary path of the uploaded image
        $originalName = $imageInfo['name']; // Original file name
        $outputPath = $outputDir . basename($originalName); // Construct the output path
        // Resize and save the image
        $resizeSuccess = self::resizeAndSaveImage($tempPath, $outputPath, 800, 600); // Example maxWidth and maxHeight
        // Check if the resize operation was successful
        if ($resizeSuccess) {
           $count++;
        } else {
            // If an operation fails, set $allSuccessful to false
            $allSuccessful = false;
        }
    }
   return  ($count == count($images))? $message = "All $count images processed successfully": $message = "Some images failed to process";
}


// check if users has uploaded id documents
public static function canshowAddIDDocuments($client_id): void {
    $clientDetails = (new Query())->fetchOne('SELECT * FROM id_verification WHERE client_id = ?', [$client_id]);
    echo (($clientDetails) == false)? 'block': 'none';
}

public static function canShowdocsMessage($client_id): void {
    $clientDetails = (new Query())->fetchOne('SELECT * FROM id_verification WHERE client_id = ?', [$client_id]);
    echo ($clientDetails)? 'block': 'none';
}

// show summary resutls

public static function showSummaryResutls($data) 
{
    extract($data);
    $car = json_decode($selectedCar);
    $card = json_decode($selectedPaymentCard);

    $addon = (isset($selectedAddonPackage)) ? json_decode($selectedAddonPackage,true) :['name'=>'','price'=>''];
    $package = (isset($selectedWashPackage)) ? json_decode($selectedWashPackage,true) :['name'=>'','price'=>''];
    if($requestType == 'Schedule'){
        $request = "Request Type : Schedule<br>
        <small>Date :$scheduledDate </small><br>
        <small>Time :$scheduledTime </small>
        ";
    }
    else{
        $request = "Request Type : Now";
    }

    $pricelist = ($addon['name']!='') ?'<div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">'.$package['price'].'</div><div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">'.$addon['price'].'
    </div>

': '<div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
'.$package['price'].'
</div>' ;
    $pricingfor  = ($addon['name']=='')? "<strong>Pricing </strong> : $car->brand" : "<strong>Pricing </strong> : $car->brand + ".$addon['name']."";


    // sum total 
    $total = ($addon['price'] != '')? floatval(str_replace('$','',$package['price']) + str_replace('$','',$addon['price'])) : str_replace('$','',$package['price']);
    echo '<button class="btn btn-dark btn-sm editcleaningoptions">Edit Cleaning Options</button>
    <div class="row">
        <div class="col-6">

            <div class="smuItemcont" style="Padding:10px;">
                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    Cleaning Option : '.$cleaningOptions.'
                </div>
                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    <strong>Wash Packages </strong>
                </div>
                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    Car : '.$car->brand.'
                </div>

                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    Addon : '.$addon['name'].'
                </div>
                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    '.$request.'

                </div>

                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    Car Details <br>
                    <small>'.$car->brand.' </small><br>
                    <small>Color : <span class="color-indicator" style="background-color: '.$car->color.';"></span> </small><br>
                    <small>'.$car->plateNumber.' </small><br>



                </div>


            </div>

        </div>
        <!-- pricing detials  -->
        <div class="col-6">

            <div class="smuItemcont" style="Padding:10px;">
                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    '.$pricingfor.'
                </div>
                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    <strong>Total: </strong>including charges
                </div>

                

               
                    '.$pricelist.'
               

                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    <strong>Payment:</strong> $'. $total.'
                </div>

                <div class="sumitem" style="width:300px;border:2px solid green;Padding:10px;">
                    <img src="app/View/assets/images/'.$card->card_type.'.png" style="width: 30px;height:30px;" /> **** **** **** '.$card->lastDigits.'
                </div>




            </div>

        </div>
    </div>';
}




// gett path to assets folder
public static function  assetPath(): string {
    return 'app/View/assets';
}


}