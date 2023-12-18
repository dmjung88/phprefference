<?php 
	function connection(){
        $conn = mysqli_connect('localhost', 'kuzuro', '1111', 'test','3306');
        if(!$conn){
            die("DB연결실패! : ". mysqli_connect_error());
        }
        return $conn;      
    }

    function esc($form_data) {
        $form_data = trim( stripslashes( htmlspecialchars( $form_data ) ) );
        $form_data = mysqli_real_escape_string(connection(), trim(strip_tags($form_data)));
        return $form_data;
    }
    function html_escape(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
    }
    
    function clean($string): string
    {
        $string = trim($string);
        $string = stripcslashes($string);
        $string = htmlentities($string);
    
        return $string;
    }