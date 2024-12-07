<?php


return [

    'singular' => 'Subscription',
    'plural' => 'Subscriptions',
    'attributes' => [
        'name:en' => 'Name in English',
        'name:ar' => 'Name in Arabic',
        'description:en' => 'Description in English',
        'description:ar' => 'Description in Arabic',
        'is_active' => 'Status',
        'image' => 'Image',

        'country_id' => 'Country',
        'plan_category_id' => 'Plan Category',
        'price' => 'Price',
        'min_calories' => 'Minimum Calories',
        'max_calories' => 'Maximum Calories',

        'versions' => 'Versions',
        'versions.*.number_of_days' => 'Number of Days',
        'versions.*.meal_price_per_day' => 'Meal Price per Day',
        'versions.*.delivery_price_per_day' => 'Delivery Price per Day',
        'versions.*.discount' => 'Discount',
        'versions.*.subscription_type' => 'Subscription Type',

        'meals' => 'Meals',
        'meals.*.meal_category' => 'Meal Category',
        'meals.*.quantity' => 'Quantity',
    ],
];

