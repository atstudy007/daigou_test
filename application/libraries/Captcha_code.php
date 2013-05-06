<?php 
class Captcha_code
{       
        var $CI;
        var $fontPath;
        var $image;
        var $charLen            = 4; 
        var $arrChr             = array();
        var $width              = 83; 
        var $height             = 24; 
        
        var $bgcolor            = "#ffffff"; 
        var $showNoisePix       = true; 
        var $noiseNumPix        = 80; 
        var $showNoiseLine      = true; 
        var $noiseNumLine       = 2; 
        var $showBorder         = true; 
        var $borderColor        = "#000000";
 
        function __construct()
        {
                $this->CI = & get_instance();
                $this->fontPath = BASEPATH . 'fonts/';      
                $this->arrChr   = array_merge(range(1, 9) , range('A', 'Z'));
        }
 
        function show()
        {
                
                $this->image = imageCreate($this->width, $this->height);
                $this->back = $this->getColor($this->bgcolor);
                
                imageFilledRectangle($this->image, 0, 0, $this->width, $this->height, $this->back);
                
                $size = $this->width / $this->charLen - 4;
                if ($size > $this->height) {
                        $size = $this->height;
                }
                $left = ($this->width - $this->charLen * ($size + $size / 10)) / $size + 5;
                $code = '';
                for($i = 0; $i < $this->charLen; $i ++) {
                        $randKey = rand(0, count($this->arrChr) - 1);
                        $randText = $this->arrChr[$randKey];
                        $code .= $randText;
                        $textColor = imageColorAllocate($this->image, rand(0, 100), rand(0, 100), rand(0, 100));
                        $font = $this->fontPath . "arial.ttf";
                        $randsize = rand($size - $size / 10, $size + $size / 10);
                        $location = $left + ($i * $size + $size / 10);
                        @imagettftext($this->image, $randsize, rand(- 18, 18), $location, rand($size - $size / 10, $size + $size / 10) + 2, $textColor, $font, $randText);
                }
                
                if ($this->showNoisePix == true) {
                        $this->setNoisePix();
                }
                if ($this->showNoiseLine == true) {
                        $this->setNoiseLine();
                }
                if ($this->showBorder == true) {
                        $this->borderColor = $this->getColor($this->borderColor);
                        imageRectangle($this->image, 0, 0, $this->width - 1, $this->height - 1, $this->borderColor);
                }
                if(isset($this->CI->session))
				{
                	$this->CI->session->set_userdata('captcha', strtolower($code));
				}
				else if(isset($this->CI->nsession))
				{
					$this->CI->nsession->set_userdata('captcha', strtolower($code));	
				}
                header("Content-type: image/gif");
                imagejpeg($this->image);
                imagedestroy($this->image);
        }
        
 
        function show_javascript()
        {
                echo "var img_src = '".site_url('common/captcha/show')."?';";
				echo '$("#captcha_img").click(function(){this.src=img_src + Math.random();});';
        }
 
 
        function getColor($color)
        {
                $color = preg_replace("/^#/", "", $color);
                $r = $color[0] . $color[1];
                $r = hexdec($r);
                $b = $color[2] . $color[3];
                $b = hexdec($b);
                $g = $color[4] . $color[5];
                $g = hexdec($g);
                $color = imagecolorallocate($this->image, $r, $b, $g);
                return $color;
        }
 
        function setNoisePix()
        {
                for($i = 0; $i < $this->noiseNumPix; $i ++) {
                        $randColor = imageColorAllocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));
                        imageSetPixel($this->image, rand(0, $this->width), rand(0, $this->height), $randColor);
                }
        }
 
        function setNoiseLine()
        {
                for($i = 0; $i < $this->noiseNumLine; $i ++) {
                        $randColor = imageColorAllocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));
                        imageline($this->image, rand(1, $this->width), rand(1, $this->height), rand(1, $this->width), rand(1, $this->height), $randColor);
                }
        }
}
 