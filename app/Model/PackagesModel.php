<?php
class  PackagesModel {
    // get all packages
    public static function getPackages(): array {
        $query = new Query();
        $packages = $query->fetchAll('SELECT * FROM wash_packages');
        return $packages;
    }

    // display all packages
    public static function displayPackages($vehicleTpe): void {
        $packages = self::getPackages();
        if (empty($packages)) {
            echo '<div class="alert alert-info" role="alert">No packages found.</div>';
        } else {
            foreach ($packages as $package) {
                extract($package);
                $price = self::getCarPrice($package,$vehicleTpe);
                echo ' <div class="service-card">
                <h5>'.$package.'</h5>
                <div class="price">
                    <span class="currency">$</span>'.$price.'
                </div>
                <div class="duration">
                    '.$time_in_minutes.'mins
                </div>
                <ul class="service-list">
                    '.self::washPageDetails($id).'
                </ul>
                <button class="select-button" onclick="selectPackage(this)">Select</button>
            </div>';
            }
        }
    }



    // get wash package details 
    public  static function washPageDetails($package_id): String 
    {
        $data = (new Query())->fetchAll("SELECT detail FROM wash_package_detail WHERE package_id = ? ",[$package_id]);
        $response  = "";
        foreach($data as $data){
            extract($data);
            $response .= "<li>$detail</li>";
        }
        return $response;

    }

    // get car price based on vehicle type

    public static function getCarPrice($wash_package,$vehicleTpe): mixed
    {
        $data = (new Query())->fetchOne("SELECT price FROM cleaning_prices WHERE wash_package =? AND vehicle_type = ?",[$wash_package,$vehicleTpe]);
        return $data['price'];
    }



    // ***********************Addons ****************************************************************************************************************

    public static function getAddonPackages(): array {
        $query = new Query();
        $packages = $query->fetchAll('SELECT * FROM  wash_package_addons');
        return $packages;
    }

    // display all packages
    public static function displayAddonPackages($vehicleTpe): void {
        $packages = self::getAddonPackages();
        if (empty($packages)) {
            echo '<div class="alert alert-info" role="alert">No Addons found.</div>';
        } else {
            foreach ($packages as $package) {
                extract($package);
                $price = self::getAddonCarPrice($package,$vehicleTpe);
                echo ' <div class="service-Addoncard">
                <h5>'.$package.'</h5>
                <div class="price">
                    <span class="currency">$</span>'.$price.'
                </div>
                <div class="duration">
                    '.$time_in_minutes.'mins
                </div>
                <ul class="service-list">
                    '.self::washAddonPageDetails($id).'
                </ul>
                <button class="select-button" onclick="selectAddonPackage(this)">Select</button>
            </div>';
            }
        }
    }



    // get wash package details 
    public  static function washAddonPageDetails($package_id): String 
    {
        $data = (new Query())->fetchAll("SELECT detail FROM wash_package_addon_detail WHERE addon_id = ? ",[$package_id]);
        $response  = "";
        foreach($data as $data){
            extract($data);
            $response .= "<li>$detail</li>";
        }
        return $response;

    }

    // get car price based on vehicle type

    public static function getAddonCarPrice($wash_package,$vehicleTpe): mixed
    {
        $data = (new Query())->fetchOne("SELECT price FROM addon_prices WHERE wash_package =? AND vehicle_type = ?",[$wash_package,$vehicleTpe]);
        return $data['price'];
    }

}