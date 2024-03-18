<?php
class ClientModel
{

    // upload ID  documents for Client
    public static  function uploadID($data): array
    {
        ExceptionHandler::setUpErrorHandler();
        try {
            $ImagedtoValidate = [
                'idfront' =>$_FILES['idfront'], 
                'profilepicture' =>$_FILES['profilepicture'],
                
            ];
            if (Utils::validatemultipleImagefiles($ImagedtoValidate,['png','jpg'])['type'] == 'error') {
                return Utils::validatemultipleImagefiles($ImagedtoValidate,['png','jpg']);
            } else {
                // check if residence  & set_default is checked or not
                $client_id = 1 ;
                $idcardpath = 'assets/images/idcards/'.$client_id.'/'.$_FILES['idfront']['name'];
                $profilepicturepath = 'assets/images/profilepictures/'.$client_id.'/'.$_FILES['profilepicture']['name'];
                // insert data or update if exists
                $sql1 = "INSERT INTO id_verification(client_id, state_id, profile_picture,status) VALUES (?, ?, ?,?)";
                $sql2 = "UPDATE id_verification SET state_id = ?, profile_picture = ?, status= ? WHERE client_id = ?";
                // check if client details exists
                $clientDetails = (new Query())->fetchOne('SELECT * FROM id_verification WHERE client_id = ?', [$client_id]);
                $query = new Query();

                if ($clientDetails == false) {
                   $IsdataSent = $query->insert($sql1, [$client_id, $idcardpath, $profilepicturepath,'pending']);
                } else {
                    $IsdataSent = $query->update($sql2, [$idcardpath, $profilepicturepath,'pending', $client_id]);
                }
                if ($IsdataSent) {
                   
                    $idcardInitialPath= $_FILES['idfront']['tmp_name'];
                    $profilepictureInitialPath= $_FILES['profilepicture']['tmp_name'];
                    $idcardFinalPath = '../assets/images/idcards/'.$client_id.'/'.$_FILES['idfront']['name'];
                    $profilepictureFinalPath = '../assets/images/profilepictures/'.$client_id.'/'.$_FILES['profilepicture']['name'];
                   
                    Utils::resizeAndSaveImage($idcardInitialPath, $idcardFinalPath);
                    Utils::resizeAndSaveImage($profilepictureInitialPath, $profilepictureFinalPath);
                    return ['type' => 'success', 'message' => 'ID documents uploaded successfully.'];
                    // var_dump($IsdataSent);
                    // exit;
                   
                } else {
                    return ['type' => 'error', 'message' => 'Failed to upload ID documents.'];
                }
    
            }
        } catch (Throwable $e) {
            ExceptionHandler::handleException($e);
            return ['type' => 'error', 'message' => $e->getMessage()];
        }
    }
    
}