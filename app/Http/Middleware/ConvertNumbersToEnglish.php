<?php

namespace App\Http\Middleware;

use Closure;

class ConvertNumbersToEnglish
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Convert Arabic and Persian numbers to English numbers in the response content
        $response->setContent($this->convertNumbersToEnglish($response->getContent()));

        return $response;
    }

    private function convertNumbersToEnglish($content)
    {
        // Define the mapping of Arabic and Persian numbers to English numbers
        $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        // Replace Arabic and Persian numbers with English numbers in the content
        $content = str_replace($arabicNumbers, $englishNumbers, $content);
        $content = str_replace($persianNumbers, $englishNumbers, $content);

        return $content;
    }
}
