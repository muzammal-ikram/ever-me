<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Mail;
use Session;
use Illuminate\Support\Facades\URL;

class CommonUtils extends BaseUtility {
    /**
     * sendEmail method
     * @param type $template
     * @param type $data
     * @param type $attachment
     * @return boolean
     */
    public function sendEmail($template, $data, $attachment = null) {
              
        $support_email = config('mail.from.email');
        $site_title = config('mail.from.name');
        Mail::send($template, ['data' => $data], function($message) use ($support_email, $site_title, $data) {
            $message->from($support_email, $site_title);
            $message->subject($data['subject']);
            $message->to($data['email']);
            if (!empty($attachment)) {
                $message->attach($attachment);
            }
        });
        return true;
    }

    public function convertPngToJpg($images) {
        $jpegs = [];
        foreach ($images as $image) {
            $partitioned_name = explode('.', $image['image']);
            if ($partitioned_name[1] == 'PNG' || $partitioned_name[1] == 'png' || $partitioned_name[1] == 'jpeg') {
                $new_name = $partitioned_name[0] . '.jpg';
            } else {
                $new_name = $image['image'];
            }
            $jpegs[] = $new_name;
        }
        return $jpegs;
    }

    public function convertPngToJpgSingle($image) {
        $partitioned_name = explode('.', $image);
        if ($partitioned_name[1] == 'PNG' || $partitioned_name[1] == 'png' || $partitioned_name[1] == 'jpeg') {
            $new_name = $partitioned_name[0] . '.jpg';
        } else {
            $new_name = $image;
        }
        return $new_name;
    }


    public function referalUrls($url_name){
        
        $route = URL::previous();

        $referral_urls = Session::get($url_name);

        if($referral_urls == ""){
            Session::put($url_name, $route);
        }

    }


}
