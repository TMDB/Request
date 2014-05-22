<?php
namespace milankragujevic;
Class Request {
    public static function get($url, $options = array()) {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_URL, $url);
        $timeout = 180;
        if(isset($options['timeout'])) {
            $timeout = (int) $options['timeout'];   
        }
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        if(!in_array('noredirect', $options)) {
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        }
        $user_agent  = 'Opera/9.80 (Android; Opera Mini/7.5.33361/31.1350; U; en) Presto/2.8.119 Version/11.10';
        if(isset($options['useragent'])) {
            $user_agent = $options['useragent'];
        }
        curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent);

        if(!in_array('nofail', $options)) {
            curl_setopt ($ch, CURLOPT_FAILONERROR, 1);
        }

        if(in_array('header', $options)) { 
            curl_setopt ($ch, CURLOPT_HEADER, 1); 
            curl_setopt ($ch, CURLOPT_VERBOSE, 1);
        }
        if(in_array('nobody', $options)) {
            curl_setopt ($ch, CURLOPT_NOBODY, 1); 
        }
        if(isset($options['cookie'])) {
            if(!file_exists($options['cookie'])) {
                throw new Exception("The cookie file (" . $options['cookie'] . ") doesn't exist!");   
            }
            curl_setopt ($ch, CURLOPT_COOKIEFILE, $options['cookie']);   
            curl_setopt ($ch, CURLOPT_COOKIEJAR, $options['cookie']);   
        }

        if(isset($options['referer'])) {
            curl_setopt ($ch, CURLOPT_REFERER, $options['referer']);
        }

        $content = curl_exec($ch);
        if($content === false) {
            throw new Exception(curl_error($ch));   
        }
        curl_close($ch);
        return $content;
    }
    
    public static function post($url, $options = array(), $data = array()) {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_URL, $url);
        $timeout = 180;
        if(isset($options['timeout'])) {
            $timeout = (int) $options['timeout'];   
        }
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        if(!in_array('noredirect', $options)) {
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        }
        
        $user_agent  = 'Opera/9.80 (Android; Opera Mini/7.5.33361/31.1350; U; en) Presto/2.8.119 Version/11.10';
        if(isset($options['useragent'])) {
            $user_agent = $options['useragent'];
        }
        curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent);
        
        if(!in_array('nofail', $options)) {
            curl_setopt ($ch, CURLOPT_FAILONERROR, 1);
        }
        
        if(in_array('header', $options)) { 
            curl_setopt($ch, CURLOPT_HEADER, 1); 
            curl_setopt ($ch, CURLOPT_VERBOSE, 1);
        }
        if(in_array('nobody', $options)) {
            curl_setopt($ch, CURLOPT_NOBODY, 1); 
        }
        if(isset($options['cookie'])) {
            if(!file_exists($options['cookie'])) {
                throw new Exception("The cookie file (" . $options['cookie'] . ") doesn't exist!");   
            }
            curl_setopt ($ch, CURLOPT_COOKIEFILE, $options['cookie']);   
            curl_setopt ($ch, CURLOPT_COOKIEJAR, $options['cookie']);   
        }

        curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
        if(isset($options['referer'])) {
            curl_setopt ($ch, CURLOPT_REFERER, $options['referer']);
        }

        $content = curl_exec($ch);
        if($content === false) {
            throw new Exception(curl_error($ch));   
        }
        curl_close($ch);
        return $content;
    }
}