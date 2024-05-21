<?php

    class Cipher
    { 
        public $key, $method;
        function __construct($key, $method)
        {   
            $this->key = $key;
            $this->method = $method;
        }
        
        function encrypt($data)
        {
            // Generate a random initialization vector (IV)
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));

            // Encrypt the data
            $encrypted = openssl_encrypt($data, $this->method, $this->key, 0, $iv);

            // Concatenate the IV and the encrypted data
            $encrypted = base64_encode($iv.$encrypted);

            return $encrypted;
        }

        function decrypt($encrypted)
        {
            // Decode the encrypted data
            $encrypted = base64_decode($encrypted);

            // Extract the IV and the encrypted data
            $iv = substr($encrypted, 0, openssl_cipher_iv_length($this->method));
            $encrypted = substr($encrypted, openssl_cipher_iv_length($this->method));

            // Decrypt the data
            $decrypted = openssl_decrypt($encrypted, $this->method, $this->key, 0, $iv);

            return $decrypted;
        }
    }




