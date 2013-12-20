<?php

class Paypal {

    private $user = "ivanokulichev_api1.gmail.com";
    private $password = "1387277645";
    private $signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31A.egghqKl.E205I4sUQ58HZ70p.G";
    private $endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
    public  $errors = array();

    public function __construct($user = FALSE, $password = FALSE, $signature = FALSE, $prod = FALSE) {
        if ($user) {
            $this->user = $user;
        }
        if ($password) {
            $this->password = $password;
        }
        if ($signature) {
            $this->signature = $signature;
        }
        if ($prod) {
            $this->endpoint = str_replace('sandbox', '', $this->endpoint);
        }
    }

    public function request($method, $params) {
        //on remplit l'array avec les parametres pour la transaction
        //on combine les parametres par défaut avec les params qui vont etre passés
        $params = array_merge($params, array(
            'METHOD' => $method,
            'VERSION' => '74.0',
            'USER' => $this->user,
            'SIGNATURE' => $this->signature,
            'PWD' => $this->password,
        ));
    
        //convertir le tab en str pour eviter les erreurs de paypal
        //pcq paypal attends de nous une chaine de char et non un tab
        $params = http_build_query($params);

        //pour demander un url on utilise curl_init() + fo le parametrer
        //curl_init() --> params --> curl_exec()
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint, //indiquer l'url à request
            CURLOPT_POST => 1,              //envoyer via POST
            CURLOPT_POSTFIELDS => $params,  //params
            CURLOPT_RETURNTRANSFER => 1,    //envoyer une rep
            CURLOPT_SSL_VERIFYPEER => FALSE,//off ssl coté hote distant
            CURLOPT_SSL_VERIFYHOST => FALSE,//off ssl coté localhost
            CURLOPT_VERBOSE => 1            // -v(linux)
        ));
        //on recup la reponse de la requette
        $response = curl_exec($curl);
        
        $responseArray = array();
        parse_str($response, $responseArray);
        
        
        

        //*********************************************************
        //***          A FAIRE SAUTER A LA FIN DES TEST         ***
        //*********************************************************
            //afficher le contenu du retour du paypal(token communiqué)
        /*
            foreach ($responseArray as $item => $value) {
                print_r($item . " : " . $value . "<br>");
            }
            print_r('<br>*********************************************<br>');
         * 
         */
        //**********************************************************
        //**********************************************************
            
            
            

        //avant de fermer fo check s'il n'ya pas de problems
        if (curl_errno($curl)) {
            $this->errors = curl_error($curl);
            curl_close($curl);
            return false;
        } else {
            if ($responseArray['ACK'] == 'Success') {
                return $responseArray;
            } else {
                $this->errors = $responseArray;
                curl_close($curl);
                return false;
            }
        }
    }
}
?>

