<?php
error_reporting(E_ALL);

$client_id =1;
$action = $_POST['action'];

switch($action){
    case  'getModels':
        extract($_POST);
        echo json_encode(CarModel::getCarModels($brand));
        break;

    case 'addCar':
        // echo 'add car action here...';
        $data = $_POST;
        // echo 'hi';
        echo json_encode(CarModel::addCar($data));
        break;
    case 'Displaycars':
        CarModel::Displaycars($client_id);

        break;

    case 'addCard':
        $data = $_POST;
        echo json_encode(PaymentModel::addCard($data));
        break;

    case 'displaySavedCreditCards':
        PaymentModel::displaySavedCreditCards($client_id);
        break;

    case 'displayWashPackages':
        extract($_POST);
        PackagesModel::displayPackages($vehicleTpe);
        break;

    case 'displayAddonPackages':
        extract($_POST);
        PackagesModel::displayAddonPackages($vehicleTpe);
        break;
        

    case 'addID':
        $data = $_POST;
        
        echo json_encode(ClientModel::uploadID($data));
        break;


    case 'showsummary':
        // extract($_POST);
        Utils::showSummaryResutls($_POST);
        break;

}