<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/ping",
     *     operationId="ping",
     *     summary="Ping API",
     *     description="Проверка доступности API",
     *     tags={"System"},
     *     @OA\Response(
     *         response=200,
     *         description="API доступен",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="pong",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="timestamp",
     *                 type="string",
     *                 example="2025-12-30T00:00:00.000000Z"
     *             )
     *         )
     *     )
     * )
     */
    public function ping(): JsonResponse
    {
        return response()->json([
            'pong' => true,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    /**
     * @OA\Get(
     *     path="/products",
     *     operationId="getProducts",
     *     summary="Список продуктів з фільтрами, пагінацією",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Номер сторінки",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Кількість елементів на сторінці",
     *         required=false,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         description="Фільтр по категорії",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список продуктів",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="iPhone 15 Pro"),
     *                 @OA\Property(property="slug", type="string", example="iphone-15-pro"),
     *                 @OA\Property(property="description", type="string", example="Latest iPhone with advanced features"),
     *                 @OA\Property(property="price", type="number", format="float", example=999.99),
     *                 @OA\Property(property="category_id", type="integer", example=1),
     *                 @OA\Property(property="category_name", type="string", example="Smartphones"),
     *                 @OA\Property(property="image", type="string", example="https://example.com/images/iphone15pro.jpg"),
     *                 @OA\Property(property="stock", type="integer", example=25),
     *                 @OA\Property(property="rating", type="number", format="float", example=4.8),
     *                 @OA\Property(property="reviews_count", type="integer", example=156)
     *             )),
     *             @OA\Property(property="meta", type="object", 
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="last_page", type="integer", example=5),
     *                 @OA\Property(property="per_page", type="integer", example=10),
     *                 @OA\Property(property="total", type="integer", example=50)
     *             )
     *         )
     *     )
     * )
     */
    public function getProducts(Request $request): JsonResponse
    {
        $mockProducts = [
            [
                'id' => 1,
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro',
                'description' => 'Latest iPhone with advanced features',
                'price' => 999.99,
                'category_id' => 1,
                'category_name' => 'Smartphones',
                'image' => 'https://example.com/images/iphone15pro.jpg',
                'stock' => 25,
                'rating' => 4.8,
                'reviews_count' => 156,
                'created_at' => '2025-12-30T00:00:00.000000Z',
                'updated_at' => '2025-12-30T00:00:00.000000Z'
            ],
            [
                'id' => 2,
                'name' => 'MacBook Pro 14"',
                'slug' => 'macbook-pro-14',
                'description' => 'Professional laptop with M3 chip',
                'price' => 1999.99,
                'category_id' => 2,
                'category_name' => 'Laptops',
                'image' => 'https://example.com/images/macbookpro14.jpg',
                'stock' => 15,
                'rating' => 4.9,
                'reviews_count' => 89,
                'created_at' => '2025-12-30T00:00:00.000000Z',
                'updated_at' => '2025-12-30T00:00:00.000000Z'
            ],
            [
                'id' => 3,
                'name' => 'AirPods Pro',
                'slug' => 'airpods-pro',
                'description' => 'Wireless earbuds with noise cancellation',
                'price' => 249.99,
                'category_id' => 3,
                'category_name' => 'Audio',
                'image' => 'https://example.com/images/airpodspro.jpg',
                'stock' => 50,
                'rating' => 4.6,
                'reviews_count' => 234,
                'created_at' => '2025-12-30T00:00:00.000000Z',
                'updated_at' => '2025-12-30T00:00:00.000000Z'
            ]
        ];

        return response()->json([
            'data' => $mockProducts,
            'meta' => [
                'current_page' => 1,
                'last_page' => 5,
                'per_page' => 10,
                'total' => 50
            ]
        ]);
    }

    /**
     * @OA\Get(
     *     path="/products/{id}",
     *     operationId="getProduct",
     *     summary="Деталі окремого продукту",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID продукту",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Деталі продукту",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="iPhone 15 Pro"),
     *             @OA\Property(property="slug", type="string", example="iphone-15-pro"),
     *             @OA\Property(property="description", type="string", example="Latest iPhone with advanced features, A17 Pro chip, titanium design"),
     *             @OA\Property(property="short_description", type="string", example="Premium smartphone with professional features"),
     *             @OA\Property(property="price", type="number", format="float", example=999.99),
     *             @OA\Property(property="old_price", type="number", format="float", example=1099.99),
     *             @OA\Property(property="category_id", type="integer", example=1),
     *             @OA\Property(property="category_name", type="string", example="Smartphones"),
     *             @OA\Property(property="brand", type="string", example="Apple"),
     *             @OA\Property(property="sku", type="string", example="IP15P256BT"),
     *             @OA\Property(property="images", type="array", @OA\Items(type="string")),
     *             @OA\Property(property="attributes", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="name", type="string", example="Color"),
     *                 @OA\Property(property="value", type="string", example="Space Black")
     *             )),
     *             @OA\Property(property="stock", type="integer", example=25),
     *             @OA\Property(property="rating", type="number", format="float", example=4.8),
     *             @OA\Property(property="reviews_count", type="integer", example=156),
     *             @OA\Property(property="is_featured", type="boolean", example=true),
     *             @OA\Property(property="is_available", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Продукт не знайдено"
     *     )
     * )
     */
    public function getProduct(int $id): JsonResponse
    {
        $mockProduct = [
            'id' => $id,
            'name' => 'iPhone 15 Pro',
            'slug' => 'iphone-15-pro',
            'description' => 'Latest iPhone with advanced features, A17 Pro chip, titanium design',
            'short_description' => 'Premium smartphone with professional features',
            'price' => 999.99,
            'old_price' => 1099.99,
            'category_id' => 1,
            'category_name' => 'Smartphones',
            'brand' => 'Apple',
            'sku' => 'IP15P256BT',
            'images' => [
                'https://example.com/images/iphone15pro-1.jpg',
                'https://example.com/images/iphone15pro-2.jpg',
                'https://example.com/images/iphone15pro-3.jpg'
            ],
            'attributes' => [
                ['name' => 'Color', 'value' => 'Space Black'],
                ['name' => 'Storage', 'value' => '256GB'],
                ['name' => 'Display', 'value' => '6.1" Super Retina XDR'],
                ['name' => 'Processor', 'value' => 'A17 Pro']
            ],
            'stock' => 25,
            'rating' => 4.8,
            'reviews_count' => 156,
            'is_featured' => true,
            'is_available' => true,
            'created_at' => '2025-12-30T00:00:00.000000Z',
            'updated_at' => '2025-12-30T00:00:00.000000Z'
        ];

        return response()->json($mockProduct);
    }

    /**
     * @OA\Get(
     *     path="/categories",
     *     operationId="getCategories",
     *     summary="Дерево категорій",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="Дерево категорій",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Electronics"),
     *                 @OA\Property(property="slug", type="string", example="electronics"),
     *                 @OA\Property(property="description", type="string", example="Electronic devices and accessories"),
     *                 @OA\Property(property="image", type="string", example="https://example.com/images/electronics.jpg"),
     *                 @OA\Property(property="product_count", type="integer", example=156),
     *                 @OA\Property(property="children", type="array", @OA\Items(type="object"))
     *             )
     *         )
     *     )
     * )
     */
    public function getCategories(): JsonResponse
    {
        $mockCategories = [
            [
                'id' => 1,
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronic devices and accessories',
                'image' => 'https://example.com/images/electronics.jpg',
                'product_count' => 156,
                'children' => [
                    [
                        'id' => 11,
                        'name' => 'Smartphones',
                        'slug' => 'smartphones',
                        'description' => 'Mobile phones and accessories',
                        'image' => 'https://example.com/images/smartphones.jpg',
                        'product_count' => 45,
                        'children' => []
                    ],
                    [
                        'id' => 12,
                        'name' => 'Laptops',
                        'slug' => 'laptops',
                        'description' => 'Portable computers',
                        'image' => 'https://example.com/images/laptops.jpg',
                        'product_count' => 28,
                        'children' => []
                    ]
                ]
            ],
            [
                'id' => 2,
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Fashion and apparel',
                'image' => 'https://example.com/images/clothing.jpg',
                'product_count' => 234,
                'children' => [
                    [
                        'id' => 21,
                        'name' => 'Men\'s Clothing',
                        'slug' => 'mens-clothing',
                        'description' => 'Clothing for men',
                        'image' => 'https://example.com/images/mens-clothing.jpg',
                        'product_count' => 112,
                        'children' => []
                    ],
                    [
                        'id' => 22,
                        'name' => 'Women\'s Clothing',
                        'slug' => 'womens-clothing',
                        'description' => 'Clothing for women',
                        'image' => 'https://example.com/images/womens-clothing.jpg',
                        'product_count' => 122,
                        'children' => []
                    ]
                ]
            ]
        ];

        return response()->json($mockCategories);
    }

    /**
     * @OA\Post(
     *     path="/cart",
     *     operationId="cartOperations",
     *     summary="Операції з кошиком (додати, оновити, видалити)",
     *     tags={"Cart"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="action", type="string", enum={"add", "update", "remove", "clear"}),
     *             @OA\Property(property="product_id", type="integer"),
     *             @OA\Property(property="quantity", type="integer"),
     *             @OA\Property(property="variant_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Стан кошика",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="items", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="product_id", type="integer", example=1),
     *                 @OA\Property(property="product_name", type="string", example="iPhone 15 Pro"),
     *                 @OA\Property(property="product_slug", type="string", example="iphone-15-pro"),
     *                 @OA\Property(property="image", type="string", example="https://example.com/images/iphone15pro.jpg"),
     *                 @OA\Property(property="price", type="number", format="float", example=999.99),
     *                 @OA\Property(property="quantity", type="integer", example=1),
     *                 @OA\Property(property="total", type="number", format="float", example=999.99)
     *             )),
     *             @OA\Property(property="summary", type="object",
     *                 @OA\Property(property="items_count", type="integer", example=3),
     *                 @OA\Property(property="subtotal", type="number", format="float", example=1499.97),
     *                 @OA\Property(property="tax", type="number", format="float", example=299.99),
     *                 @OA\Property(property="shipping", type="number", format="float", example=0),
     *                 @OA\Property(property="discount", type="number", format="float", example=50),
     *                 @OA\Property(property="total", type="number", format="float", example=1749.96)
     *             )
     *         )
     *     )
     * )
     */
    public function cartOperations(Request $request): JsonResponse
    {
        $mockCart = [
            'items' => [
                [
                    'id' => 1,
                    'product_id' => 1,
                    'product_name' => 'iPhone 15 Pro',
                    'product_slug' => 'iphone-15-pro',
                    'image' => 'https://example.com/images/iphone15pro.jpg',
                    'price' => 999.99,
                    'quantity' => 1,
                    'total' => 999.99,
                    'variant' => ['name' => 'Color', 'value' => 'Space Black']
                ],
                [
                    'id' => 2,
                    'product_id' => 3,
                    'product_name' => 'AirPods Pro',
                    'product_slug' => 'airpods-pro',
                    'image' => 'https://example.com/images/airpodspro.jpg',
                    'price' => 249.99,
                    'quantity' => 2,
                    'total' => 499.98,
                    'variant' => null
                ]
            ],
            'summary' => [
                'items_count' => 3,
                'subtotal' => 1499.97,
                'tax' => 299.99,
                'shipping' => 0,
                'discount' => 50,
                'total' => 1749.96
            ]
        ];

        return response()->json($mockCart);
    }

    /**
     * @OA\Post(
     *     path="/orders",
     *     operationId="orderOperations",
     *     summary="Створення замовлення, отримання історії",
     *     tags={"Orders"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="action", type="string", enum={"create", "list"}),
     *             @OA\Property(property="items", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="shipping_address", type="object"),
     *             @OA\Property(property="billing_address", type="object"),
     *             @OA\Property(property="payment_method", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Результат операції з замовленням",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=12345),
     *                     @OA\Property(property="order_number", type="string", example="ORD-2025-12345"),
     *                     @OA\Property(property="status", type="string", example="pending"),
     *                     @OA\Property(property="status_name", type="string", example="Pending Payment"),
     *                     @OA\Property(property="total", type="number", format="float", example=1214.98),
     *                     @OA\Property(property="created_at", type="string", example="2025-12-30T00:00:00.000000Z")
     *                 ),
     *                 @OA\Schema(
     *                     type="array",
     *                     @OA\Items(type="object")
     *                 )
     *             }
     *         )
     *     )
     * )
     */
    public function orderOperations(Request $request): JsonResponse
    {
        $action = $request->input('action', 'list');

        if ($action === 'create') {
            $mockOrder = [
                'id' => 12345,
                'order_number' => 'ORD-2025-12345',
                'status' => 'pending',
                'status_name' => 'Pending Payment',
                'items' => [
                    [
                        'product_id' => 1,
                        'product_name' => 'iPhone 15 Pro',
                        'price' => 999.99,
                        'quantity' => 1,
                        'total' => 999.99
                    ]
                ],
                'subtotal' => 999.99,
                'tax' => 199.99,
                'shipping' => 15.00,
                'discount' => 0,
                'total' => 1214.98,
                'shipping_address' => [
                    'name' => 'John Doe',
                    'address' => '123 Main St',
                    'city' => 'New York',
                    'country' => 'USA',
                    'postal_code' => '10001'
                ],
                'payment_method' => 'credit_card',
                'created_at' => '2025-12-30T00:00:00.000000Z',
                'updated_at' => '2025-12-30T00:00:00.000000Z'
            ];
        } else {
            $mockOrder = [
                [
                    'id' => 12345,
                    'order_number' => 'ORD-2025-12345',
                    'status' => 'completed',
                    'status_name' => 'Completed',
                    'total' => 1214.98,
                    'created_at' => '2025-12-28T00:00:00.000000Z'
                ],
                [
                    'id' => 12344,
                    'order_number' => 'ORD-2025-12344',
                    'status' => 'processing',
                    'status_name' => 'Processing',
                    'total' => 599.99,
                    'created_at' => '2025-12-25T00:00:00.000000Z'
                ]
            ];
        }

        return response()->json($mockOrder);
    }

    /**
     * @OA\Get(
     *     path="/user",
     *     operationId="getUserProfile",
     *     summary="Профіль користувача, адреси",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="Дані профілю користувача",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="first_name", type="string", example="John"),
     *             @OA\Property(property="last_name", type="string", example="Doe"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *             @OA\Property(property="phone", type="string", example="+1234567890"),
     *             @OA\Property(property="avatar", type="string", example="https://example.com/avatars/user1.jpg"),
     *             @OA\Property(property="date_of_birth", type="string", example="1990-01-15"),
     *             @OA\Property(property="gender", type="string", example="male"),
     *             @OA\Property(property="addresses", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="preferences", type="object"),
     *             @OA\Property(property="created_at", type="string", example="2025-01-01T00:00:00.000000Z"),
     *             @OA\Property(property="updated_at", type="string", example="2025-12-30T00:00:00.000000Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизовано"
     *     )
     * )
     */
    public function getUserProfile(): JsonResponse
    {
        $mockUser = [
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '+1234567890',
            'avatar' => 'https://example.com/avatars/user1.jpg',
            'date_of_birth' => '1990-01-15',
            'gender' => 'male',
            'addresses' => [
                [
                    'id' => 1,
                    'type' => 'shipping',
                    'name' => 'John Doe',
                    'address' => '123 Main St',
                    'city' => 'New York',
                    'state' => 'NY',
                    'country' => 'USA',
                    'postal_code' => '10001',
                    'phone' => '+1234567890',
                    'is_default' => true
                ],
                [
                    'id' => 2,
                    'type' => 'billing',
                    'name' => 'John Doe',
                    'address' => '123 Main St',
                    'city' => 'New York',
                    'state' => 'NY',
                    'country' => 'USA',
                    'postal_code' => '10001',
                    'phone' => '+1234567890',
                    'is_default' => true
                ]
            ],
            'preferences' => [
                'language' => 'en',
                'currency' => 'USD',
                'newsletter' => true
            ],
            'created_at' => '2025-01-01T00:00:00.000000Z',
            'updated_at' => '2025-12-30T00:00:00.000000Z'
        ];

        return response()->json($mockUser);
    }

    /**
     * @OA\Put(
     *     path="/user",
     *     operationId="updateUserProfile",
     *     summary="Оновлення профілю користувача",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="date_of_birth", type="string", format="date"),
     *             @OA\Property(property="gender", type="string", enum={"male", "female", "other"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Профіль оновлено",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="first_name", type="string", example="John"),
     *             @OA\Property(property="last_name", type="string", example="Doe"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *             @OA\Property(property="phone", type="string", example="+1234567890"),
     *             @OA\Property(property="avatar", type="string", example="https://example.com/avatars/user1.jpg"),
     *             @OA\Property(property="date_of_birth", type="string", example="1990-01-15"),
     *             @OA\Property(property="gender", type="string", example="male"),
     *             @OA\Property(property="addresses", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="preferences", type="object"),
     *             @OA\Property(property="created_at", type="string", example="2025-01-01T00:00:00.000000Z"),
     *             @OA\Property(property="updated_at", type="string", example="2025-12-30T00:00:00.000000Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизовано"
     *     )
     * )
     */
    public function updateUserProfile(Request $request): JsonResponse
    {
        return $this->getUserProfile();
    }

    /**
     * @OA\Get(
     *     path="/config",
     *     operationId="getConfig",
     *     summary="Налаштування магазину, функції, валюти",
     *     tags={"Config"},
     *     @OA\Response(
     *         response=200,
     *         description="Конфігурація магазину",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="shop", type="object"),
     *             @OA\Property(property="features", type="object"),
     *             @OA\Property(property="currencies", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="languages", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="payment_methods", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="shipping_methods", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     */
    public function getConfig(): JsonResponse
    {
        $mockConfig = [
            'shop' => [
                'name' => 'TechStore',
                'description' => 'Your trusted electronics store',
                'logo' => 'https://example.com/logo.png',
                'favicon' => 'https://example.com/favicon.ico',
                'contact_email' => 'support@techstore.com',
                'contact_phone' => '+1234567890',
                'address' => '456 Commerce St, Tech City, TC 12345'
            ],
            'features' => [
                'guest_checkout' => true,
                'user_reviews' => true,
                'wishlist' => true,
                'compare_products' => true,
                'multi_currency' => true,
                'multi_language' => true,
                'tax_calculation' => true,
                'shipping_calculation' => true
            ],
            'currencies' => [
                [
                    'code' => 'USD',
                    'name' => 'US Dollar',
                    'symbol' => '$',
                    'rate' => 1.0,
                    'is_default' => true
                ],
                [
                    'code' => 'EUR',
                    'name' => 'Euro',
                    'symbol' => '€',
                    'rate' => 0.85,
                    'is_default' => false
                ],
                [
                    'code' => 'UAH',
                    'name' => 'Ukrainian Hryvnia',
                    'symbol' => '₴',
                    'rate' => 39.5,
                    'is_default' => false
                ]
            ],
            'languages' => [
                [
                    'code' => 'en',
                    'name' => 'English',
                    'is_default' => true
                ],
                [
                    'code' => 'uk',
                    'name' => 'Українська',
                    'is_default' => false
                ]
            ],
            'payment_methods' => [
                ['code' => 'credit_card', 'name' => 'Credit Card', 'enabled' => true],
                ['code' => 'paypal', 'name' => 'PayPal', 'enabled' => true],
                ['code' => 'stripe', 'name' => 'Stripe', 'enabled' => true],
                ['code' => 'cash_on_delivery', 'name' => 'Cash on Delivery', 'enabled' => false]
            ],
            'shipping_methods' => [
                ['code' => 'standard', 'name' => 'Standard Shipping', 'price' => 10.00, 'enabled' => true],
                ['code' => 'express', 'name' => 'Express Shipping', 'price' => 25.00, 'enabled' => true],
                ['code' => 'free', 'name' => 'Free Shipping', 'price' => 0.00, 'enabled' => true]
            ]
        ];

        return response()->json($mockConfig);
    }
}
