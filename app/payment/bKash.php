<?php

class bKashPaymentGateway {
    private $apiUrl;
    private $appKey;
    private $appSecret;
  
    public function __construct($apiUrl, $appKey, $appSecret) {
      $this->apiUrl = $apiUrl;
      $this->appKey = $appKey;
      $this->appSecret = $appSecret;
    }
  
    public function makePayment($clientId, $amount) {
      // Build the request data
      $data = array(
        'amount' => $amount,
        'reference' => $clientId
      );
  
      // Encode the data as JSON
      $dataJson = json_encode($data);
  
      // Set up the request headers
      $headers = array(
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($this->appKey . ':' . $this->appSecret)
      );
  
      // Initialize the cURL request
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
      // Execute the request and decode the response
      $response = json_decode(curl_exec($ch), true);
  
      // Check for errors
      if (curl_error($ch)) {
        throw new Exception(curl_error($ch));
      }
  
      // Close the cURL request
      curl_close($ch);
  
      // Return the response
      return $response;
    }
  
    public function checkPaymentStatus($clientId) {
      // Set up the request headers
      $headers = array(
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($this->appKey . ':' . $this->appSecret)
      );
  
      // Initialize the cURL request
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->apiUrl . '/' . $clientId);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
      // Execute the request and decode the response
      $response = json_decode(curl_exec($ch), true);
  
      // Check for errors
      if (curl_error($ch)) {
        throw new Exception(curl_error($ch));
      }
  
      // Close the cURL request
      curl_close($ch);
  
      // Return the response
      return $response;
    }

    public function updateDatabase($clientId, $paymentStatus) {
        // Connect to the database
        $db = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');
    
        // Build the update query
        $query = "UPDATE clients SET payment_status = :paymentStatus WHERE id = :clientId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':paymentStatus', $paymentStatus);
        $stmt->bindParam(':clientId', $clientId);
    
        // Execute the query
        $stmt->execute();
      }
    
      public function processPayment($clientId) {
        // Check the payment status for the client
        $paymentStatus = $this->checkPaymentStatus($clientId);
    
        // Update the database with the payment status
        $this->updateDatabase($clientId, $paymentStatus);
      }
    }