<?php

class Query extends DbModel{


    public function fetchAll($query, $params=[]){
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function fetchOne($query, $params=[]){
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        // var_dump($query);
     
        // var_dump()
        return $stmt->fetch();
    }

    public function insert($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $success = $stmt->execute($params);
        if ($success) {
            return true; // Insertion was successful
        } else {
            return false; // Insertion failed
        }
    }


    // insert with lastid

    public function insertwithLastId($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $success = $stmt->execute($params);
        if ($success) {
            $lastInsertId = $this->conn->lastInsertId();
            return $lastInsertId; // Return the last insert ID if insertion was successful
        } else {
            return false; // Insertion failed
        }
    }
    



    public  function lastInsertId() {
        return $this->conn->lastInsertId();
    }



    public function delete($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $success = $stmt->execute($params);
        if ($success) {
            // Check if any rows were affected by the delete operation
            if ($stmt->rowCount() > 0) {
                return true; // Deletion was successful
            } else {
                return false; // No rows were affected, so deletion failed
            }
        } else {
            return false; // Deletion failed
        }
    }
    
    public function update($query, $params = [],$rowsAffected = false) {
        $stmt = $this->conn->prepare($query);
        $success = $stmt->execute($params);
    
        if ($success) {
            // Check if any rows were affected by the update operation

          return true;
        } else {
            return false; // Update failed
        }
    }
    
    

    public function executeSql($query, $params=[])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
       
    }

    public function runQueriesInTransaction($queries)
    {
        // Connect to your database here 


        try {

            $pdo = $this->conn;

            // echo "Connected successfully";


            // Begin a transaction 
            $pdo->beginTransaction();
            // Prepare each query and execute it with any parameters 
            foreach ($queries as $query) {

                // print_r($query);
                $stmt = $pdo->prepare($query['sql']);
                $stmt->execute($query['params']);
            }

            // Commit the transaction 
            $pdo->commit();

            $msg = ["type"=>"success"];
        } catch (PDOException $e) {
            // If any queries fail, roll back the transaction and throw an error 
            $pdo->rollBack();

            $err = "Transaction failed: " . $e->getMessage();
            $msg = ["type"=>"error", "message"=>$err, "error_code"=>"TRANS110"];
        }

        // Close the database connection 
        $pdo = null;

        return $msg;
    }








    public function paginateQuery($query, $params, $limit, $page, $url)
        {
            $page = $page??1;
    
            $changeModeSql = "SET sql_mode = '';";
            $offSet = ($page - 1) * $limit;
            $queryRunner = new Query();
            $queryRunner->executeSql($changeModeSql);
            $offSetString = "";
            $countQuery = "SELECT count(*) AS count FROM ($query) AS subquery";
            $countParams = $params;
            $query = trim($query);
            $hasOrderBy = stripos($query, 'ORDER BY');
            if ($hasOrderBy === false) {
                $query .= " ORDER BY (SELECT 0)";
            }
            
            if ($page > 1) {
                $offSetString = "OFFSET $offSet";
            }
            
            $nextPage = $page + 1;
            $prevPage = $page - 1;
            
            
            $countResult = $queryRunner->fetchOne($countQuery, $countParams);
            // print_r([$countQuery, $countParams]);die;
 
            $count = $countResult['count'];
            // echo "hi";die;
            
            $possibleNext = $page * $limit < $count ? true : false;
            $totalPages = ceil($count / $limit);
            
            $paginatedQuery = "$query LIMIT $limit $offSetString";
            
            $result = $queryRunner->fetchAll($paginatedQuery, $params);

            $prevUrl = ($page == 1 ? '' : str_replace("page=$page", "page=$prevPage", $url));
            $nextUrl = (!$possibleNext ? '' : str_replace("page=$page", "page=$nextPage", $url));

            $response = array(
                'totalPages' => $totalPages,
                'res' => count($result),
                'startCount' => $offSet + 1,
                'count' => $count,
                'prev' => $prevUrl,
                'next' => $nextUrl,
                'requestUrl'=>$url,
                'results' => $result
            );
            return $response;
        }
}