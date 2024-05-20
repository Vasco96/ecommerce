<?php

/** Create unique slug */

use PhpParser\Node\Stmt\TryCatch;

if (!function_exists('generateUniqueSlug')) {
    function generateUniqueSlug($model, $name): string
    {
        $modelClass = "App\\Models\\$model";

        if (!class_exists($modelClass)) {
            throw new \InvalidArgumentException("Model $model not found.");
        }

        $slug = \Str::slug($name);
        $count = 2;

        while ($modelClass::where('slug', $slug)->exists()) {
            $slug = \Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
/**
if (!function_exists('currencyPosition')) {
    function currencyPosition($price): string
    {
        if (config('settings.site_currency_icon_position') === 'left') {
            return config('settings.site_currency_icon') . $price;
        } else {
            return $price . config('settings.site_currency_icon');
        }
    }
}*/

/** Calculate cart total price */

/**if (!function_exists('cartTotal')) {
    function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $item) {
            $productPrice = $item->price;
            $sizePrice = $item->options?->product_size['price'] ?? 0;
            $optionsPrice = 0;
            foreach ($item->options->product_options as $option) {
                $optionsPrice += $option['price'];
            }

            $total += ($productPrice + $sizePrice + $optionsPrice) * $item->qty;
        }

        return $total;
    }
}*/

/** Calculate product total price */

/**if (!function_exists('productTotal')) {
    function productTotal($rowId)
    {
        $total = 0;
        $product = Cart::get($rowId);
        $productPrice = $product->price;
        $sizePrice = $product->options?->product_size['price'] ?? 0;
        $optionsPrice = 0;

        foreach ($product->options->product_options as $option) {
            $optionsPrice += $option['price'];
        }

        $total += ($productPrice + $sizePrice + $optionsPrice) * $product->qty;


        return $total;
    }
}*/

/** Grand cart total price */

/**if (!function_exists('grandCartTotal')) {
    function grandCartTotal($deliveryFee = 0)
    {
        $total = 0;
        $cartTotal = cartTotal();

        if (session()->has('coupon')) {
            $discount = session()->get('coupon')['discount'];
            $total = ($cartTotal + $deliveryFee) - $discount;
            return $total;
        } else {
            $total = $cartTotal + $deliveryFee;
            return $total;
        }


        return $total;
    }
}*/

/** Generate invoice id */

/**if (!function_exists('generateInvoiceId')) {
    function generateInvoiceId()
    {
        $randomNumber = rand(1, 9999);
        $currentDateTime = now();

        $invoiceId = $randomNumber . $currentDateTime->format('yd') . $currentDateTime->format('s');
        return $invoiceId;
    }
}*/

/** Get product discount in percent */

/**if (!function_exists('discountInPercent')) {
    function discountInPercent($originalPrice, $discountPrice)
    {
        $result =  (($originalPrice - $discountPrice) / $originalPrice) * 100;
        return round($result, 2);
    }
}*/

/** Truncate the string */

/**if (!function_exists('truncate')) {
    function truncate($string, int $limit = 100)
    {
        return \Str::limit($string, $limit, '...');
    }
}*/

/** getYtThumbnail the string */

/**if (!function_exists('getYtThumbnail')) {
    function getYtThumbnail($link, $size = 'medium')
    {
        try {
            $videoId = explode("?v=", $link);
            $videoId = $videoId[1];
            $finalSize = match ($size) {
                'low' => 'sddefault',
                'medium' => 'mqdefault',
                'high' => 'hqdefault',
                'max' => 'maxresdefault'
            };

            return "https://img.youtube.com/vi/$videoId/$finalSize.jpg";
        } catch (\Exception $e) {
            logger($e);
            return null;
        }
    }
}*/

/** set Sidebar Active */

if (!function_exists('setSidebarActive')) {
    function setSidebarActive(array $routes)
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
        return '';
    }
}

/** check Product have discount */

if (!function_exists('checkDiscount')) {
    function checkDiscount($product)
    {
        $currentDate = date('Y-m-d');

        if (($product->offer_price > 0) && ($currentDate >= $product->offer_start_date) && ($currentDate <= $product->offer_end_date)) {

            return true;
        }
        return false;
    }
}

/** calculate discount percent*/

if (!function_exists('calculateDiscountPercent')) {
    function calculateDiscountPercent($originalPrice, $discountPrice)
    {
        $result = (($originalPrice - $discountPrice) / $originalPrice) * 100;
        return round($result, 0);
    }
}

/** Check the product type*/

if (!function_exists('productType')) {
    function productType(string $type): string
    {
        switch ($type) {
            case 'new_arrival':
                return 'New';
                break;
            case 'featured_product':
                return 'Featured';
                break;
            case 'top_product':
                return 'Top';
                break;
            case 'best_product':
                return 'Best';
                break;
            default:
                return '';
                break;
        }
    }
}
