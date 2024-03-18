<?php
class PaymentModel
{


    //Get saved Credit cards for Client
    public static  function getSavedCreditCards($clientId): array
    {
        $sql = "SELECT * FROM client_cards WHERE client_id = ?";
        return (new Query())->fetchAll($sql, [$clientId]);
    }

    //Display saved Credit cards for Client
    public static  function displaySavedCreditCards($clientId): void
    {
        $cards = self::getSavedCreditCards($clientId);
        if (empty($cards)) {
            echo '<div class="alert alert-info" role="alert">No saved cards found.</div>';
        } else {

            foreach ($cards as $card) {
                extract($card);
                echo '
               <li class="list-group-item selectable" data-card-id="'.$id.'">
                   <div class="d-flex justify-content-between align-items-center">
                       <p style="display:none;">'.$card_type.'</p>
                       <span>**** **** **** '.substr($card_number,-4).'</span>
                       <img src="assets/images/'.$card_type.'.png" alt="'.$card_type.'" style="height: 24px;">
                   </div>
               </li>
              
          ';
            }
        }
    }

    //Add Credit card for Client
    public static  function addCard($data): array
    {
        ExceptionHandler::setUpErrorHandler();
        try {
            // validate data
            // required fields
            extract($data);
            $requiredFields = [
                'card_number' => $card_number,
                'card_holder_name' => $card_holder_name,
                'card_type' => $card_type,
                'expiry_date' => $exp_date,
                'cvv' => $cvv,
                'address_line_1' => $address_line_1,
                'state' => $state,
                'city' => $city,
                'zip_code' => $zip_code,
            ];
            if (Utils::validateRequiredData($requiredFields)['type'] == 'error') {
                return Utils::validateRequiredData($requiredFields);
            } else {
                // check if residence  & set_default is checked or not
                $residence = isset($residence) ? $address_line_1 : '';
                $set_default = isset($set_default) ? 1 : 0;
                // insert data
                $client_id = 1;
                $sql = "INSERT INTO client_cards (client_id, card_number, card_holder_name, card_type, exp_date, cvv) VALUES (?, ?, ?, ?, ?, ?)";
                if ((new Query())->insert($sql, [$client_id, $card_number, $card_holder_name, $card_type, $exp_date, $cvv])) {
                    // insert address
                    $sql = "INSERT INTO billing_address (client_id, address_line_1,address_line_2,residence, state, city, zip_code,set_default) VALUES (?, ?,?, ?, ?, ?, ?, ?)";
                    (new Query())->insert($sql, [$client_id, $address_line_1, $address_line_2, $residence, $state, $city, $zip_code, 1]);
                    return ['type' => 'success', 'message' => 'Card added successfully.'];
                } else {
                    return ['type' => 'error', 'message' => 'Failed to add card.'];
                }
            }
        } catch (Throwable $e) {
            ExceptionHandler::handleException($e);
            return ['type' => 'error', 'message' => 'something is wrong.'];
        }
    }
}
