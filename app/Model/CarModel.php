<?php
class CarModel
{

    // function to get car models by brand
    public static function getCarModels($brandId): array
    {
        ExceptionHandler::setUpErrorHandler();
        try {
            $sql = "SELECT id, model FROM car_models WHERE brand_name = ?";
            return (new Query())->fetchAll($sql, [$brandId]);
        } catch (Throwable $th) {
            ExceptionHandler::handleException($th);
        }
    }

    // function to get all car brands
    public static function getCarBrands(): array
    {
        ExceptionHandler::setUpErrorHandler();
        try {
            $sql = "SELECT * FROM car_brands";
            return (new Query())->fetchAll($sql);
        } catch (Throwable $th) {
            ExceptionHandler::handleException($th);
        }
    }

    // function to  get all colors
    public static function getColors(): array
    {
        ExceptionHandler::setUpErrorHandler();
        try {
            $sql = "SELECT * FROM colors";
            return (new Query())->fetchAll($sql);
        } catch (Throwable $th) {
            ExceptionHandler::handleException($th);
        }
    }


    // function to get vehicle type givem model 
    public static function getVehicleType($modelId): array
    {
        ExceptionHandler::setUpErrorHandler();
        try {
            $sql = "SELECT vehicle_type FROM car_models WHERE id = ?";
            return (new Query())->fetchOne($sql, [$modelId]);
        } catch (Throwable $th) {
            ExceptionHandler::handleException($th);
        }
    }

    // function to add a new car

    public static function Displaycars($client_id)
    {

        $cars = self::getCars($client_id);
        if (empty($cars)) {
            echo '<div class="alert alert-info" role="alert">No saved cars found.</div>';
        } else {
            foreach ($cars as $car) {
                $selectedClass = ''; // Add a condition to set this if the car is selected
                echo '<div class="list-group-item carlistitem list-group-item-action ' . $selectedClass . '" onclick="selectCar(this, ' . htmlspecialchars($car['id']) . ');">';

                if (!empty($car['image'])) {
                    $imagePath = $car['image'];
                    echo '<img src="' . $imagePath . '" alt="Car Image" class="car-image float-left mr-3">';
                }
                echo '<div class="car-details">';
                echo '<h5 class="mb-1">'. htmlspecialchars($car['model']) . '</h5>';
                echo '<p class="mb-1 platNmber">Plate Number: ' . htmlspecialchars($car['license_plate']) . '</p>';
                echo '<p class="mb-1 myvehicletype" style="display:none" >' . htmlspecialchars($car['vehicle_type']) . '</p>';
                echo '<small>Color: <span class="color-indicator" style="background-color: #' . htmlspecialchars($car['color_hex']) . ';"></span> ' . htmlspecialchars($car['color_name']) . '</small>';
                echo '<br><small>Vehicle Type: ' . htmlspecialchars($car['vehicle_type']) . '</small>';
                echo '</div>';
                echo '<i class="fas fa-check-circle check-icon ml-auto" style="color:green;"></i>'; // Icon to indicate selected
                echo '</div>'; // Close the list-group-item div
            }
        }
    }
    public static function addCar($data)
    {

        ExceptionHandler::setUpErrorHandler();
        try {
            extract($data);
            $requiredFields = [
                'carBrand' => $brand_name,
                'carModel' => $model,
                'carYear' => $year,
                'carColor' => $color,
                'carPlate' => $license_plate
            ];
            $imagesToValidate = [
                'imgCar' => $_FILES['image'],
                'driver_side_front' => $_FILES['driver_side_front'],
                'passenger_side_front' => $_FILES['passenger_side_front'],
                'driver_side_rear' => $_FILES['driver_side_rear'],
                'passenger_side_rear' => $_FILES['passenger_side_rear']
            ];
            if (!Utils::checkGDEnabled()) {
                return ['type' => 'error', 'message' => 'The GD library is not enabled. Please enable it to proceed.'];
            }
            // validate the required input field
            $validationResult = Utils::validateRequiredData($requiredFields);
            if ($validationResult['type'] == 'error') {
                return $validationResult;
            }
            // validate the image file
            $imageValidationResult = Utils::validateMultipleImageFiles($imagesToValidate, ['png'], '15728640');
            if ($imageValidationResult['type'] == 'error') {
                return $imageValidationResult;
            }
            //      check if the carhas damages
            if ($damage == 'yes') {
                $damageImagesToValidate = ['damage_image1' => $_FILES['damage_image1']];
                $damageValidationResult = Utils::validateMultipleImageFiles($damageImagesToValidate, ['png'], '15728640');
                if ($damageValidationResult['type'] == 'error') {
                    return $damageValidationResult;
                }
            }
            // check if the car is for guest
            if ($is_for_guest == '1') {
                $guestRequiredFields = ['guest_name' => $guest_name];
                $guestValidationResult = Utils::validateRequiredData($guestRequiredFields);
                if ($guestValidationResult['type'] == 'error') {
                    return $guestValidationResult;
                }
            }

            $client_id = 1; // Example client ID

            extract($_FILES);

            $sql = "INSERT INTO client_cars (client_id, brand_name, model, vehicle_type, year, color, license_plate, image, driver_side_front, passenger_side_front, driver_side_rear, passenger_side_rear, damage_detail, damage_image1, damage_image2, damage_image3, damage_image4, is_for_guest, guest_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $params = [$client_id, $brand_name, $model, self::getVehicleType($model)['vehicle_type'], $year, $color, $license_plate, $image['name'], $driver_side_front['name'], $passenger_side_front['name'], $driver_side_rear['name'], $passenger_side_rear['name'], $damage_detail, $damage_image1['name'], $damage_image2['name'], $damage_image3['name'], $damage_image4['name'], $is_for_guest, $guest_name];

            $lastId = (new Query())->insertwithLastId($sql, $params);
            if ($lastId > 0) {
                $carId = $lastId;

                $sidesimages = [
                    $driver_side_front,
                    $passenger_side_front,
                    $driver_side_rear,
                    $passenger_side_rear
                ];
                $damagedinages = [
                    $damage_image1,
                    $damage_image2,
                    $damage_image3,
                    $damage_image4
                ];
                $sidePath = "../assets/images/client_cars/$client_id/$carId/sides/";
                $damagedPath = "../assets/images/client_cars/$client_id/$carId/damages/";
                // Example of processing one image, expand as needed
                $MainCarPath = "../assets/images/client_cars/$client_id/$carId/" . $image['name'];
                Utils::processAllImages($sidesimages, $client_id, $carId, $sidePath);
                Utils::processAllImages($damagedinages, $client_id, $carId, $damagedPath);
                Utils::resizeAndSaveImage($image['tmp_name'], $MainCarPath, 320, 200);

                // images path to be updated in the database the keys will be the column names in the database and the values will be the path to the images
                $driver_side_frontPath = "assets/images/client_cars/$client_id/$carId/sides/" . $driver_side_front['name'];
                $passenger_side_frontPath = "assets/images/client_cars/$client_id/$carId/sides/" . $passenger_side_front['name'];
                $driver_side_rearPath = "assets/images/client_cars/$client_id/$carId/sides/" . $driver_side_rear['name'];
                $passenger_side_rearPath = "assets/images/client_cars/$client_id/$carId/sides/" . $passenger_side_rear['name'];
                $damaged_image1Path = "assets/images/client_cars/$client_id/$carId/damages/" . $damage_image1['name'];
                $damaged_image2Path = "assets/images/client_cars/$client_id/$carId/damages/" . $damage_image2['name'];
                $damaged_image3Path = "assets/images/client_cars/$client_id/$carId/damages/" . $damage_image3['name'];
                $damaged_image4Path = "assets/images/client_cars/$client_id/$carId/damages/" . $damage_image4['name'];
                $MainCarPathRealpath = "assets/images/client_cars/$client_id/$carId/" . $image['name'];

                $InsertionData = [
                    'driver_side_front' => $driver_side_frontPath,
                    'passenger_side_front' => $passenger_side_frontPath,
                    'driver_side_rear' => $driver_side_rearPath,
                    'passenger_side_rear' => $passenger_side_rearPath,
                    'image' => $MainCarPathRealpath,
                ];

                // check if the car has damages and add the damaged images to the insertion data
                if ($damage == 'yes') {
                    $InsertionData['damage_image1'] = $damaged_image1Path;
                    // check if the car has more than one damage image since the user can upload more than one image
                    if (!empty($damage_image2['name'])) {
                        $InsertionData['damage_image2'] = $damaged_image2Path;
                    }
                    if (!empty($damage_image3['name'])) {
                        $InsertionData['damage_image3'] = $damaged_image3Path;
                    }
                    if (!empty($damage_image4['name'])) {
                        $InsertionData['damage_image4'] = $damaged_image4Path;
                    }
                }

                // save the images to the database
                self::saveCarImages($carId, $InsertionData);
                return ['type' => 'success', 'message' => 'Car added successfully'];
            } else {
                return ['type' => 'error', 'message' => 'Error adding car'];
            }
           
        } catch (Throwable $th) {
            ExceptionHandler::handleException($th);
            return ['type' => 'error', 'message' => 'Something wrong check logs'];
        }
    }

    // function to get all cars
    public static function getCars($client_id): array
    {
        ExceptionHandler::setUpErrorHandler();
        try {
            $sql = "SELECT cc.id, cb.brand_name, cm.model, cm.vehicle_type, cc.year, c.Name AS color_name, c.Hex AS color_hex, cc.license_plate, cc.image
            FROM client_cars cc
            JOIN car_brands cb ON cc.brand_name = cb.id
            JOIN car_models cm ON cc.model = cm.id
            JOIN colors c ON cc.color = c.id
            WHERE cc.client_id = ?  order by cc.id desc";
            return (new Query())->fetchAll($sql, [$client_id]);
        } catch (Throwable $th) {
            ExceptionHandler::handleException($th);
        }
    }


    // save car images to db 
    public static function saveCarImages($carId, $InsertionData): bool
    {
        ExceptionHandler::setUpErrorHandler();
        try {
            // Start the SQL with the initial part.
            $sql = "UPDATE client_cars SET ";
            $sqlParts = [];
            $params = [];
            foreach ($InsertionData as $column => $path) {
                // Add the column placeholder to the SQL parts array.
                $sqlParts[] = "$column = ?";
                // Add the path to the params array.
                $params[] = $path;
            }
            $sql .= implode(', ', $sqlParts);
            // Add the WHERE clause to the SQL.
            $sql .= " WHERE id = ?";
            // Add the carId to the params array.
            $params[] = $carId;

            // Execute the SQL.
            (new Query())->insert($sql, $params);

            return true;
        } catch (Throwable $th) {
            ExceptionHandler::handleException($th);
            return false;
        }
    }
}
