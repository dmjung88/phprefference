<?php

    function html_escape(string $string) : string {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false);
    }
    function format_date(string $string): string {
        $date = date_create_from_format('Y-m-d H:i:s', $string); 
        return $date->format('F d, Y'); 
    }
    function pdo($pdo, $sql, array $arguments = null) {
        if(!$arguments) {
            return $pdo->query($sql);
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arguments);
        return $stmt;
    }
 
