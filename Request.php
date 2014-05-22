<?php
/*
Request by Milan Kragujevic
http://milankragujevic.com/
https://github.com/milankragujevic/Request
==============================================================================
Copyright (c) 2014 Milan Kragujevic

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
==============================================================================
*/
namespace milankragujevic;
Class Request {
    public static function get($url, $options = array()) {
		$version = curl_version();
		$version = $version['version'];
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
        $user_agent  = 'Mozilla/5.0 (compatible; cURL/'.$version.'; Request/1.1; Bot)';
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
                throw new \Exception("The cookie file (" . $options['cookie'] . ") doesn't exist!");   
            }
            curl_setopt ($ch, CURLOPT_COOKIEFILE, $options['cookie']);   
            curl_setopt ($ch, CURLOPT_COOKIEJAR, $options['cookie']);   
        }

        if(isset($options['referer'])) {
            curl_setopt ($ch, CURLOPT_REFERER, $options['referer']);
        }

        $content = curl_exec($ch);
        if($content === false) {
            throw new \Exception(curl_error($ch));   
        }
        curl_close($ch);
        return $content;
    }
    
    public static function post($url, $options = array(), $data = array()) {
		$version = curl_version();
		$version = $version['version'];
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
        
        $user_agent  = 'Mozilla/5.0 (compatible; cURL/'.$version.'; Request/1.1; Bot)';
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
                throw new \Exception("The cookie file (" . $options['cookie'] . ") doesn't exist!");   
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
            throw new \Exception(curl_error($ch));   
        }
        curl_close($ch);
        return $content;
    }
}